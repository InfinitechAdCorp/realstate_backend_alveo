<?php
namespace App\Http\Controllers;
use App\Models\Image; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Property;
use App\Models\Feature;
class FeatureController extends Controller
{
public function addFeature(Request $request)
{
    foreach ($request->input('features') as $propertyId => $features) {
        // Find the property by propertyId
        $property = Property::find($propertyId);

        if (!$property) {
            return response()->json(['error' => 'Property not found.'], 404);
        }

        // Decode existing features or initialize an empty array if none exist
        $existingFeatures = $property->features ? json_decode($property->features, true) : [];

        // Array to store new features to be appended
        $newFeatures = [];

        foreach ($features as $feature) {
            // Process the feature image if provided
            $imagePath = null;
            if ($request->hasFile("features.$propertyId." . array_search($feature, $features) . ".image")) {
                $imageFile = $request->file("features.$propertyId." . array_search($feature, $features) . ".image");
                $imagePath = $imageFile->store('assets/Location/' . $property->name, 'public');
            }

            // Prepare the new feature data with the correct full URL for the image
            $newFeatures[] = [
                'name' => $feature['featureName'],
                'image' => $imagePath ? url('storage/' . $imagePath) : null, // Generate full URL for the image
            ];
        }

        // Append the new features to the existing features
        $updatedFeatures = array_merge($existingFeatures, $newFeatures);

        // Save the updated features back to the database
        $property->features = json_encode($updatedFeatures);
        $property->save();
    }

    return response()->json(['success' => 'Features added successfully.']);
}


    public function upload(Request $request)
    {
        // Log the incoming request data
        Log::info('Image upload request received:', $request->all());

        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048', // Max size 2MB
            'propertyId' => 'required|integer',
            'inputIndex' => 'required|integer',
        ]);

        // Handle the file upload
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $path = $file->store('images', 'public'); // Store in 'storage/app/public/images'

                // Optional: Save the image path in the database
                // Image::create([
                //     'image_path' => $path,
                //     'property_id' => $request->propertyId,
                // ]);

                return response()->json([
                    'success' => true,
                    'imageUrl' => Storage::url($path), // Get the URL for the stored image
                    'propertyId' => $request->propertyId,
                    'inputIndex' => $request->inputIndex,
                ]);
            } catch (\Exception $e) {
                Log::error('Error storing image: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Image upload failed'], 500);
            }
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
    }
public function saveImage(Request $request)
{
    // Log the incoming request data for debugging
    Log::info('Features save request received:', $request->all());

    // Validate the incoming data
    $request->validate([
        '*.propertyId' => 'required|integer',
        '*.name' => 'required|string',
        '*.featureImage' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Get all features from the request (this should be an array of features)
        $features = $request->all(); 

        // Initialize a response array to gather results
        $response = [];

        foreach ($features as $feature) {
            $propertyId = $feature['propertyId']; // Access the propertyId for the current feature
            Log::info('Processing propertyId:', ['propertyId' => $propertyId]);

            // Find the property using the extracted propertyId
            $property = Property::findOrFail($propertyId);

            // Decode existing features, or initialize an empty array if there are none
            $existingFeatures = json_decode($property->features, true) ?: [];

            // Create an associative array for the new feature
            $newFeature = [
                'name' => $feature['name'],
                'image' => null, // Default value for image
            ];

            // Handle the image upload
            if (isset($feature['featureImage']) && $feature['featureImage'] instanceof UploadedFile) {
                // Store the image and get the path
                $path = $feature['featureImage']->store('features', 'public');
                $newFeature['image'] = Storage::url($path); // Generate the public URL for the image
            }

            // Append the new feature to existing features
            $existingFeatures[] = $newFeature;

            // Store features as JSON in the database
            $property->features = json_encode($existingFeatures);
            $property->save();

            // Add success message for the current property
            $response[] = [
                'propertyId' => $propertyId,
                'message' => 'Feature saved successfully.',
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error('Property not found with ID: ' . $propertyId);
        return response()->json(['success' => false, 'message' => 'Property not found.'], 404);
    } catch (\Exception $e) {
        Log::error('Error saving features to database: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to save features to database.'], 500);
    }
}



}
