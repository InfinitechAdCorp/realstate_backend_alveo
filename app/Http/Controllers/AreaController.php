<?php

namespace App\Http\Controllers;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    // Validate incoming data (no need to validate the image since it's a Base64 string)
    $validated = $request->validate([
        'area_name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'image' => 'nullable|string',  // Image is now a Base64 string
    ]);

    // Log incoming data for debugging
    \Log::info('Request Data:', ['data' => $request->all()]);  // Log all request data

    // Generate a folder name based on the area name (you can adjust this as needed)
    $folderName = strtolower(str_replace(' ', '_', $request->area_name));

    // Get the storage path for the image uploads
    $storagePath = public_path('assets/' . $folderName);

    // Check if the folder exists, if not, create it
    if (!file_exists($storagePath)) {
        mkdir($storagePath, 0777, true); // Create the folder and allow permissions
    }

    // Initialize image file path
    $imagePath = null;

    // Handle the image if Base64 is present
    if ($request->image) {
        // Extract the image data (Base64 string)
        $imageData = $request->image;
        // Remove the prefix (e.g., "data:image/png;base64,")
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);  // Replace spaces with plus signs

        // Decode the Base64 string
        $decodedImage = base64_decode($imageData);

        // Generate a unique image filename (use proper file extension)
        $imageName = uniqid() . '.png';  // You can change this to .jpg if needed

        // Define the file path where the image will be stored
        $imageFilePath = $storagePath . '/' . $imageName;

        // Save the decoded image as a file
        file_put_contents($imageFilePath, $decodedImage);

        // Set the image path to store in the database (relative path)
        $imagePath = 'assets/' . $folderName . '/' . $imageName;
    }

    // Store the area data in the database
    $area = new Area();
    $area->area_name = $validated['area_name'];
    $area->title = $validated['title'];
    $area->description = $validated['description'];
    $area->image = $imagePath;  // Save the image file path in the database
    $area->save();

    // Return a success response with the image URL
    return response()->json([
        'message' => 'Area added successfully',
        'data' => $area,
        'image_url' => $imagePath ? asset($imagePath) : null // Include image URL in the response
    ], 200);
}
// app/Http/Controllers/AreaController.php
public function getSpecific($param)
{
    // Normalize the parameter by removing spaces and converting to lowercase
    $param = strtolower(str_replace(' ', '', $param));

    // Fetch areas, normalizing the area_name by removing spaces and converting to lowercase for comparison
    $areas = Area::whereRaw("LOWER(REPLACE(area_name, ' ', '')) LIKE ?", ['%' . $param . '%'])->get();

    return response()->json($areas);
}



}
