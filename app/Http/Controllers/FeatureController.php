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

        foreach ($features as $index => $feature) {
            // Process the feature image if provided
            $imagePath = null;
            if ($request->hasFile("features.$propertyId.$index.featureImage")) {
                $imageFile = $request->file("features.$propertyId.$index.featureImage");
                $fileName = time() . '_' . $imageFile->getClientOriginalName(); // Unique file name
                
                // Use propertyName in the path
                $destinationPath = public_path('property/' . $property->name);

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true); // Create directory if it doesn't exist
                }

                // Move the file to the public directory
                $imageFile->move($destinationPath, $fileName);

                // Generate the public URL for the image
                $imagePath = asset('property/' . $property->name . '/' . $fileName);
            }

            // Prepare the new feature data with the correct full URL for the image
            $newFeatures[] = [
                'name' => $feature['featureName'],
                'image' => $imagePath, // Public URL for the image or null if no image was uploaded
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
public function uploadImage(Request $request)
{
    // Validate the request
    $request->validate([
        'propertyId' => 'required|integer',
        'features'   => 'required|array',
        'features.*.name'  => 'required|string',
        'features.*.image' => 'required|string', // Base64-encoded image or file upload
    ]);

    try {
        // Retrieve the property
        $property = Property::findOrFail($request->propertyId);

        // Normalize the folder name (making it lowercase and replacing spaces with underscores)
        $folderName = strtolower(str_replace(' ', '_', $property->name));

        // Get the path where the files will be stored (directly in public/property)
        $storagePath = public_path('property/' . $folderName);

        // Check if the folder exists, if not, create it
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true); // Create the folder and allow permissions
        }

        // Process each feature
        $features = [];
        foreach ($request->features as $feature) {
            $imagePath = null;

            // Check if the image is base64-encoded
            if (preg_match('/^data:image\/(\w+);base64,/', $feature['image'], $type)) {
                // Decode the base64 image
                $image = substr($feature['image'], strpos($feature['image'], ',') + 1);
                $image = base64_decode($image);

                // Generate a unique file name and save the image
                $imageName = uniqid() . '.' . $type[1];
                $imagePath = '/property/' . $folderName . '/' . $imageName; // Leading slash added
                file_put_contents(public_path($imagePath), $image);

            } elseif ($request->hasFile('features.*.image')) {
                // Handle uploaded file (not base64)
                $file = $request->file('features.*.image');
                $fileName = $file->getClientOriginalName();
                $file->move($storagePath, $fileName);
                $imagePath = '/property/' . $folderName . '/' . $fileName; // Leading slash added

            } else {
                // Use the existing image path (make sure it matches the correct format)
                $imagePath = '/property/' . $folderName . '/' . basename($feature['image']); // Leading slash added
            }

            // Add the processed feature to the array
            $features[] = [
                'name'  => $feature['name'],
                'image' => $imagePath,
            ];
        }

        // Update the features column in the database
        $property->features = json_encode($features);
        $property->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Features updated successfully!',
            'data'    => $property->features,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage(),
        ], 500);
    }
}


}
