<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAll()
    {
        $data = Area::all();
        return response()->json($data, 200);
    }

    public function get()
    {
        $data = Area::all()->map(function ($item) {
            $item->area_name = strtolower(str_replace(' ', '', $item->area_name)); 
            return $item;
        });

        return response()->json($data, 200); // Return the transformed data
    }

public function store(Request $request)
{
    $request->validate([
        'area_name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|string',  // Handle base64 string instead of file
    ]);

    // Initialize imageName variable
    $imageName = null;

    if ($request->has('image')) {
        // Extract base64 image data from the input
        $imageData = $request->image;

        // Check if the image is in a valid base64 format
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            // Get the base64 part of the image string
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $imageData = base64_decode($imageData);

            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $type[1]; // e.g., image.jpg

            // Save the image to the 'images' directory
            file_put_contents(public_path('images/' . $imageName), $imageData);
        }
    }

    // Save the data to the database
    Area::create([
        'area_name' => $request->area_name,
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName,  // Store the image file name
    ]);

    // Return a successful response
    return response()->json(['message' => 'Added successfully'], 201);
}
public function delete($id)
{
    // Find the location by ID
    $location = Area::find($id);

    // Debugging: check if the location is found
    if (!$location) {
        // Log the ID to check if the correct ID is being passed
        Log::error("Location not found with ID: " . $id);
        return response()->json(['message' => 'Location not found'], 404);
    }

    // Delete the location
    $location->delete();

    // Return a success response
    return response()->json(['message' => 'Location deleted successfully'], 200);
}

}
