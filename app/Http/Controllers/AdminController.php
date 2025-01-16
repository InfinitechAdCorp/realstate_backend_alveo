<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Property;
use App\Models\Building;
use App\Models\Facility;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminController extends Controller
{

  


    public function deleteProperty(Request $request)
    {
        $request->validate(['id' => 'required|array']); // Ensure the IDs are in an array

        // Log the property IDs being used for deletion
        \Log::info('Attempting to delete properties with IDs:', $request->id);

        // Delete the properties based on the array of IDs
        $deletedCount = Property::whereIn('id', $request->id)->delete();

        // Log the number of deleted properties
        \Log::info('Number of properties deleted:', [$deletedCount]);

        return response()->json(['message' => 'Properties deleted successfully', 'deleted_count' => $deletedCount]);
    }


    public function deleteBuilding(Request $request)
    {
        $request->validate(['id' => 'required|array']);

        // Log the property IDs being used for deletion
        \Log::info('Attempting to delete buildings with property IDs:', $request->id);

        // Delete buildings based on property_id
        $deletedCount = Building::whereIn('property_id', $request->id)->delete();

        // Log the number of deleted buildings
        \Log::info('Number of buildings deleted:', [$deletedCount]);

        return response()->json(['message' => 'Buildings deleted successfully', 'deleted_count' => $deletedCount]);
    }
public function deleteFeature(Request $request)
{
    // Validate the input
    $request->validate(['id' => 'required|array']);

    // Log the property IDs being used for deletion
    \Log::info('Attempting to delete features for property IDs:', $request->id);

    // Iterate through each property ID and remove the features
    $deletedCount = 0;

    foreach ($request->id as $propertyId) {
        // Find the property by its ID
        $property = Property::find($propertyId);

        if ($property) {
            // Decode the existing features
            $features = $property->features ? json_decode($property->features, true) : [];

            // Check if features exist and remove them
            if (!empty($features)) {
                // Remove the features (or a specific feature based on your logic)
                $property->features = json_encode([]); // Set the features to an empty array

                // Save the property after updating the features
                $property->save();
                $deletedCount++;
            } else {
                // Log a message if no features exist
                \Log::info("No features found for property ID: $propertyId");
            }
        } else {
            // Log if property is not found
            \Log::warning("Property ID $propertyId not found.");
        }
    }

    // Log the number of deleted features
    \Log::info('Number of features deleted:', [$deletedCount]);

    // Return a response
    return response()->json(['message' => 'Features deleted successfully', 'deleted_count' => $deletedCount]);
}


    public function deleteFacility(Request $request)
    {
        $request->validate(['id' => 'required|array']);

        // Log the IDs being used for deletion
        \Log::info('Attempting to delete facilities with property IDs:', $request->id);

        // Delete facilities based on property_id
        $deletedCount = Facility::whereIn('property_id', $request->id)->delete();

        // Log the number of deleted facilities
        \Log::info('Number of facilities deleted:', [$deletedCount]);

        return response()->json(['message' => 'Facilities deleted successfully', 'deleted_count' => $deletedCount]);
    }



    public function updateProperties(Request $request)
    {
        // Log the incoming request for debugging
        \Log::info('Incoming Building Update Request:', $request->all());

        // Decode the incoming JSON data
        $data = json_decode($request->getContent(), true);

        // Validate the incoming data structure
        $validatedData = $request->validate([
            '*.propertyId' => 'required|integer|exists:properties,id', // Ensure the propertyId exists in the database
            '*.item' => 'required|array',
            '*.item.id' => 'required|integer|exists:properties,id',
            '*.item.name' => 'required|string|max:255',
            '*.item.status' => 'required|string|max:50',
            '*.item.location' => 'required|string|max:255',
            '*.item.specific_location' => 'nullable|string|max:255',
            '*.item.price_range' => 'required|string|max:100',
            '*.item.units' => 'nullable|string|max:50',
            '*.item.land_area' => 'nullable|string|max:50',
            '*.item.development_type' => 'required|string|max:100',
            '*.item.architectural_theme' => 'nullable|string|max:100',
            '*.item.path' => 'nullable|string|max:255',
            '*.item.view' => 'nullable|string|max:255',
            '*.item.features' => 'nullable|string', // Assuming features are sent as JSON string
        ]);

        // Loop through each property item in the array to update properties
        foreach ($data as $propertyData) {
            $propertyId = $propertyData['propertyId'];
            $item = $propertyData['item'];

            // Find each property by ID
            $property = Property::find($item['id']);

            // Update the property attributes
            $property->name = $item['name'];
            $property->status = $item['status'];
            $property->location = $item['location'];
            $property->specific_location = $item['specific_location'];
            $property->price_range = $item['price_range'];
            $property->units = $item['units'];
            $property->land_area = $item['land_area'];
            $property->development_type = $item['development_type'];
            $property->architectural_theme = $item['architectural_theme'];
            $property->path = $item['path'];
            $property->view = $item['view'];
            $property->features = $item['features']; // Assuming you want to store the features

            // Save the updated property
            $property->save();
        }

        // Return a success response
        return response()->json(['message' => 'Properties updated successfully.'], 200);
    }
    public function updateLocation(Request $request)
    {
        // Log the incoming request for debugging
        \Log::info('Incoming Location Update Request:', $request->all());

        // Validate the incoming request for location data
        $validatedRequest = $request->validate([
            '*.propertyId' => 'required|integer|exists:properties,id',  // Make sure propertyId is valid
            '*.item.id' => 'required|integer|exists:locations,id',  // Ensure item.id exists in the locations table
            '*.item.lat' => 'nullable|numeric',
            '*.item.lng' => 'nullable|numeric',
            '*.item.location' => 'nullable|string|max:255',
            '*.item.specific_location' => 'nullable|string|max:255',
            '*.item.path' => 'nullable|string|max:255',
        ]);

        // Iterate through each item and update location data
        foreach ($validatedRequest as $data) {
            // Use propertyId to find the corresponding location by its 'id' field
            $location = Location::find($data['item']['id']); // Lookup by 'id', not 'property_id'

            if ($location) {
                // Update the location with the validated data
                $location->update([
                    'name' => $data['item']['name'] ?? $location->name,
                    'location' => $data['item']['location'] ?? $location->location,
                    'specific_location' => $data['item']['specific_location'] ?? $location->specific_location,
                    'lat' => $data['item']['lat'] ?? $location->lat,
                    'lng' => $data['item']['lng'] ?? $location->lng,
                    'path' => $data['item']['path'] ?? $location->path,
                ]);

                \Log::info("Updated Location for Location ID: {$data['item']['id']}");
            } else {
                \Log::warning("Location with ID {$data['item']['id']} not found.");
            }
        }

        // Return a success response for the location update
        return response()->json(['message' => 'Location updated successfully.'], 200);
    }
    public function updateBuildings(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Incoming Building Update Request:', $request->all());

        // Validate the incoming request
        $validatedRequest = $request->validate([
            '*.propertyId' => 'required|integer|exists:properties,id',
            '*.item.id' => 'required|integer|exists:buildings,id',
            '*.item.property_id' => 'required|integer|exists:properties,id',
            '*.item.name' => 'required|string|max:255',
            '*.item.development_type' => 'required|string|max:100',
            '*.item.residential_levels' => 'nullable|integer',
            '*.item.basement_parking_levels' => 'nullable|integer',
            '*.item.podium_parking_levels' => 'nullable|integer',
            '*.item.commercial_units' => 'nullable|integer',
            '*.item.path' => 'nullable|string|max:255',
            '*.item.lower_ground_floor_parking_levels' => 'nullable|integer', // Ensuring this is validated
        ]);


        // Iterate through each validated item
        foreach ($validatedRequest as $data) {
            // Find the building using the item ID
            $building = Building::find($data['item']['id']);

            if ($building) {
                // Only update fields that are provided, avoiding overwriting with null if not passed
                $buildingData = [
                    'property_id' => $data['item']['property_id'],
                    'name' => $data['item']['name'],
                    'development_type' => $data['item']['development_type'],
                    'residential_levels' => $data['item']['residential_levels'] ?? $building->residential_levels,
                    'basement_parking_levels' => $data['item']['basement_parking_levels'] ?? $building->basement_parking_levels,
                    'podium_parking_levels' => $data['item']['podium_parking_levels'] ?? $building->podium_parking_levels,
                    'commercial_units' => $data['item']['commercial_units'] ?? $building->commercial_units,
                    'path' => $data['item']['path'] ?? $building->path,
                    'lower_ground_floor_parking_levels' => $data['item']['lower_ground_floor_parking_levels'] ?? $building->lower_ground_floor_parking_levels, // Use the updated value if provided
                ];

                Log::info('Building Data to Update:', $buildingData);

                $building->update($buildingData);
                Log::info("Updated Building ID: {$data['item']['id']}");
            } else {
                // Log an error if the building is not found
                Log::warning("Building with ID {$data['item']['id']} not found.");
            }
        }

        // Return a success response
        return response()->json(['message' => 'Buildings updated successfully.'], 200);
    }


    public function updateFeatures(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'property_id' => 'required|integer|exists:properties,id',
                'features' => 'required|array',
                'features.*.name' => 'required|string',
                'features.*.image' => 'required|string',  // Validate that the image is a string
            ]);

            // Find the property by ID
            $property = Property::find($validated['property_id']);
            if (!$property) {
                return response()->json(['message' => 'Property not found'], 404);
            }

            // Handle the features and process images
            $features = [];
            foreach ($validated['features'] as $feature) {
                $image = $feature['image'];

                // Check if the image is base64 encoded
                if (strpos($image, 'data:image') === 0) {
                    // Extract the base64 part and decode it
                    $imageData = explode(',', $image)[1];
                    $imageData = base64_decode($imageData);

                    // Define the file path where the image will be stored
                    $fileName = 'features/' . uniqid() . '.png';
                    $filePath = public_path($fileName);

                    // Save the image as a file
                    file_put_contents($filePath, $imageData);

                    // Update the feature's image with the file path
                    $feature['image'] = $fileName;
                }

                $features[] = $feature;
            }

            // Save the updated features as JSON in the property record
            $property->features = json_encode($features);
            $property->save();

            return response()->json(['message' => 'Features updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating features', 'error' => $e->getMessage()], 500);
        }
    }



    public function updateFacilities(Request $request)
    {
        $facilitiesData = json_decode($request->getContent(), true);

        foreach ($facilitiesData as $data) {
            if (!isset($data['id']) || !isset($data['property_id']) || !isset($data['name'])) {
                return response()->json(['message' => 'Missing required fields in the request data'], 400);
            }

            $facilityId = $data['id'];
            $propertyId = $data['property_id'];
            $facilityName = $data['name'];

            $existingFacility = Facility::where('id', $facilityId)
                ->where('property_id', $propertyId)
                ->first();

            if ($existingFacility) {
                $existingFacility->update(['name' => $facilityName]);
            } else {
                Facility::create([
                    'property_id' => $propertyId,
                    'name' => $facilityName,
                ]);
            }
        }

        return response()->json(['message' => 'Facilities updated successfully!']);
    }


    public function addFacilities(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            '*.property_id' => 'required|exists:properties,id', // Ensure the property exists
            '*.facilities' => 'required|string|max:255', // Ensure each facility is a string
        ]);

        // Prepare an array to hold created facilities
        $facilities = [];

        // Loop through the submitted data
        foreach ($request->all() as $data) {
            // Create the facility for each entry
            $facility = Facility::create([
                'property_id' => $data['property_id'], // Reference the property ID from submitted data
                'name' => $data['facilities'], // Facility name
            ]);

            // Push created facility to the array
            $facilities[] = $facility;
        }

        // Return the created facilities as a JSON response
        return response()->json($facilities, 201);
    }

    public function addFacilitiesAlone(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'facilities' => 'required|array',
            'facilities.*.property_id' => 'required|integer',
            'facilities.*.facilities' => 'required|string|max:255',
        ]);

        $facilities = [];

        try {
            // Loop through the submitted facilities
            foreach ($request->input('facilities') as $data) {
                // Create the facility using the provided data
                $facility = Facility::create([
                    'property_id' => $data['property_id'], // Directly using property ID
                    'name' => $data['facilities'], // Facility name from the incoming data
                ]);

                // Push created facility to the array
                $facilities[] = $facility;
            }

            // Log success message
            Log::info('Facilities added successfully', ['facilities' => $facilities]);

            // Return the created facilities as a JSON response
            return response()->json([
                'message' => 'Facilities added successfully.',
                'facilities' => $facilities,
            ], 201);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Failed to add facilities: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e,
            ]);

            return response()->json(['message' => 'Failed to add facilities.'], 500);
        }
    }


    public function store(Request $request)
    {
        // Validate the incoming request for images
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Adjust validation rules as needed
            'propertyId' => 'required|integer', // Validate propertyId
            'inputIndex' => 'required|integer',  // Validate inputIndex
        ]);

        $uploadedImages = [];

        // Store each image in the 'public/images' folder
        foreach ($request->file('images') as $image) {
            $path = 'images/' . $image->getClientOriginalName(); // Store using the original file name
            $image->move(public_path('images'), $path); // Save directly to the 'public/images' directory
            $uploadedImages[] = asset($path); // Get the publicly accessible URL
        }

        // Log the uploaded images for debugging
        Log::info('Uploaded images:', $uploadedImages);

        return response()->json([
            'success' => true,
            'uploaded_images' => $uploadedImages,
        ]);
    }



    // Create similar methods for updateBuildings, updateFeatures, and updateFacilities
}
