<?php

namespace App\Http\Controllers;

use App\Mail\SubmittedPropertiesAccepted;
use App\Mail\SubmittedPropertiesDeclined;
use App\Models\SubmitProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubmitPropertyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:15',
            'property_name' => 'required|string|max:255',
            'unit_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/submitted_properties'), $filename);
                $imagePaths[] = 'images/submitted_properties/' . $filename;
            }
        }

        // Create the property record
        SubmitProperty::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'number' => $request->number,
            'property_name' => $request->property_name,
            'unit_type' => $request->unit_type,
            'price' => $request->price,
            'location' => $request->location,
            'images' => json_encode($imagePaths),
        ]);

        return response()->json([
            'message' => 'Propery submitted successfully!',
        ], 200);
    }

    public function getAll()
    {
        $properties = SubmitProperty::all();

        // Decode the images field if necessary (in case it's stored as a JSON string)
        foreach ($properties as $property) {
            $property->images = json_decode($property->images, true);  // Decode JSON string to array
        }

        return response()->json($properties, 200);
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string|in:ACCEPTED,DECLINED',
            'price' => 'nullable|numeric', // Add more fields as needed
            'location' => 'nullable|string', // Add more fields as needed
        ]);

        $id = $request->id;  // Get the ID from the request body
        $status = $request->status; // Get the status from the request
        $price = $request->price;   // Get the updated price if provided
        $location = $request->location; // Get the updated location if provided

        Log::info($request->all()); // Log the request for debugging

        // Find the property with the specified ID
        $property = SubmitProperty::find($id);

        if ($property) {
            // Check if the status is 'ACCEPTED' or 'DECLINED'
            if ($status === 'ACCEPTED') {
                if ($property->status !== 'PENDING') {
                    return response()->json([
                        'message' => 'Property must be in PENDING status to accept.',
                    ], 400); // If the property is not PENDING, reject the action
                }

                $property->status = 'ACCEPTED'; // Update the status to ACCEPTED

                // Optionally update other fields like price or location if provided
                if ($price) {
                    $property->price = $price;
                }
                if ($location) {
                    $property->location = $location;
                }

                $property->save(); // Save the updated property

                // Send an email to the user after updating the property
                Mail::to($property->email)->send(new SubmittedPropertiesAccepted($property));

                return response()->json([
                    'message' => 'Property accepted and updated successfully!',
                ], 200);
            }

            if ($status === 'DECLINED') {
                if ($property->status !== 'PENDING') {
                    return response()->json([
                        'message' => 'Property must be in PENDING status to decline.',
                    ], 400); // If the property is not PENDING, reject the action
                }

                $property->status = 'DECLINED'; // Update the status to DECLINED

                // Optionally update other fields like price or location if provided
                if ($price) {
                    $property->price = $price;
                }
                if ($location) {
                    $property->location = $location;
                }

                $property->save(); // Save the updated property

                // Send an email to the user after updating the property
                Mail::to($property->email)->send(new SubmittedPropertiesDeclined($property));

                return response()->json([
                    'message' => 'Property declined and updated successfully!',
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Property not found.',
        ], 404);
    }
}
