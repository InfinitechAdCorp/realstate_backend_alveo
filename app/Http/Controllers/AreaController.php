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
    $normalizedSlug = strtolower(preg_replace('/\s+/', '', $slug));

    // Find the area by the normalized name (remove spaces and convert to lowercase)
    $area = Area::whereRaw('LOWER(REPLACE(area_name, " ", "")) = ?', [$normalizedSlug])->get();

    // If no area is found, return a 404 response
    if ($area->isEmpty()) {
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
    // Validate the incoming request data
    $request->validate([
        'area_name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5012', // Handle file upload validation
    ]);

    // Initialize imageUrl variable to null in case no image is uploaded
    $imageUrl = null;

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Handle file upload
        try {
            $image = $request->file('image');

            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Define the path to save the image inside 'public/assets/Local_Location/{area_name}'
            $path = 'assets/Local_Location/' . $request->area_name;

            // Ensure the directory exists, create it if not
            $directoryPath = public_path($path);
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Move the uploaded file to the public directory
            $image->move($directoryPath, $imageName);

            // Get the full URL of the saved image
            $imageUrl = asset($path . '/' . $imageName);  // This will generate the full URL
        } catch (\Exception $e) {
            return response()->json(['error' => 'Image upload failed: ' . $e->getMessage()], 500);
        }
    }

    // Save the data to the database
    try {
        Area::create([
            'area_name' => $request->area_name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageUrl,  // Store the full image URL
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Database save failed: ' . $e->getMessage()], 500);
    }

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
