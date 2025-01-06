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
    // Validate incoming request data
    $validatedData = $request->validate([
        'personalInformation.firstName' => 'required|string',
        'personalInformation.lastName' => 'required|string',
        'personalInformation.email' => 'required|email',
        'personalInformation.phone' => 'required|string',
        'propertyInformation.name' => 'required|string',
        'propertyInformation.location' => 'required|string',
        'propertyInformation.price' => 'required|string',
        'propertyInformation.status' => 'required|string',
        'propertyInformation.description' => 'required|string',
        'propertyInformation.files' => 'required|array', // Validate that files are provided
        'propertyInformation.files.*' => 'file|mimes:jpeg,png,jpg', // Validate that each is a valid image
    ]);

    // Extract personal and property information
    $personalInfo = $request->input('personalInformation');
    $propertyInfo = $request->input('propertyInformation');

    // Initialize an array to hold file paths
    $filePaths = [];

    // Create a custom folder name based on the property and personal information
    $folderName = $propertyInfo['name'] . '_' . $personalInfo['lastName'];

    // Define the base path in the public directory
    $basePath = public_path('submitted_property' . DIRECTORY_SEPARATOR . $folderName);

    // Create the folder if it does not exist
    if (!file_exists($basePath)) {
        mkdir($basePath, 0777, true);
    }

    // Check if files were uploaded
    if ($request->hasFile('propertyInformation.files')) {
        // Loop through each uploaded file
        foreach ($request->file('propertyInformation.files') as $file) {
            // Generate a unique file name
            $fileName = uniqid('property_') . '.' . $file->getClientOriginalExtension();

            // Store the file in the custom folder within the public path
            $file->move($basePath, $fileName);

            // Add the file path to the array (no extra slashes)
            $filePaths[] = 'submitted_property' . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR . $fileName;
        }
    }

    // Create the SubmitProperty record with file paths
    $submittedProperty = SubmitProperty::create([
        'first_name' => $personalInfo['firstName'],
        'last_name' => $personalInfo['lastName'],
        'email' => $personalInfo['email'],
        'phone' => $personalInfo['phone'],
        'property_name' => $propertyInfo['name'],
        'location' => $propertyInfo['location'],
        'price' => $propertyInfo['price'],
        'status' => $propertyInfo['status'],
        'description' => $propertyInfo['description'],
        'files' => json_encode($filePaths), // Save file paths in JSON format
    ]);

    // Return a response
    return response()->json(['message' => 'Property submitted successfully!'], 200);
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
