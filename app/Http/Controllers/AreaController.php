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
public function show($slug)
{
    // Normalize the slug by removing spaces and converting to lowercase
    $normalizedSlug = str_replace(' ', '', strtolower($slug));

    // Find the area by the normalized area_name (remove spaces and convert to lowercase)
    $area = Area::whereRaw('LOWER(REPLACE(area_name, " ", "")) = ?', [$normalizedSlug])->first();

    // If no area is found, return a 404 response
    if (!$area) {
        return response()->json([
            'message' => 'Area not found',
        ], 404);
    }

    // Return the area data as a JSON response
    return response()->json([
        'data' => $area,
    ], 200);
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

    // Initialize imageUrl variable
    $imageUrl = null;

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

            // Define the path where you want to save the image (specific to area_name)
            $path = 'assets/Local_Location/' . $request->area_name;

            // Ensure the directory exists
            $directoryPath = public_path($path);
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Save the image to the specific directory
            $imagePath = $directoryPath . '/' . $imageName;
            file_put_contents($imagePath, $imageData);

            // Get the full URL of the saved image
            $imageUrl = asset($path . '/' . $imageName);  // This will generate the full URL
        }
    }

    // Save the data to the database
    Area::create([
        'area_name' => $request->area_name,
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageUrl,  // Store the full image URL
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
