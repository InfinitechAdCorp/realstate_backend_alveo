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
     public function updateAdminFromUrl($user, $password)
    {
        // Validate input data
        if (empty($user) || empty($password)) {
            return response()->json(['error' => 'User and password are required.'], 400);
        }
        Log::info('Updating admin user: ' . $user);
        // Check if the user exists
        $admin = Admin::where('user', $user)->first();

        if (!$admin) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Hash the new password before updating
        $hashedPassword = Hash::make($password);

        // Update the user's password
        $admin->password = $hashedPassword;
        $admin->save();

        return response()->json(['message' => 'Admin password updated successfully.'], 200);
    }
     public function storeAdminFromUrl($user, $password)
    {
        // Validate input data
        if (empty($user) || empty($password)) {
            return response()->json(['error' => 'User and password are required.'], 400);
        }
        Log::info('Creating admin user: ' . $user);
        // Hash the password before saving
        $hashedPassword = Hash::make($password);

        // Insert the user and hashed password into the 'admin' table
        Admin::create([
            'user' => $user,
            'password' => $hashedPassword,
        ]);

        return response()->json(['message' => 'Admin user created successfully.'], 201);
    }
    public function deleteLocation(Request $request)
{
    // Validate that an array of location IDs is provided
    $request->validate(['id' => 'required|array']); 

    // Log the location IDs being used for deletion
    \Log::info('Attempting to delete locations with IDs:', $request->id);
    
    // Delete locations based on the provided IDs
    $deletedCount = Location::whereIn('id', $request->id)->delete();

    // Log the number of deleted locations
    \Log::info('Number of locations deleted:', [$deletedCount]);

    return response()->json(['message' => 'Locations deleted successfully', 'deleted_count' => $deletedCount]);
}

public function deleteProperty(Request $request)
{
    $request->validate(['id' => 'required|array']); // Validate that an array of IDs is provided

    // Log the property IDs being used for deletion
    \Log::info('Attempting to delete properties with IDs:', $request->id);
    
    // Delete properties based on property_id
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
    $request->validate(['id' => 'required|array']);
    
    // Log the property IDs being used for deletion
    \Log::info('Attempting to delete features with property IDs:', $request->id);
    
    // Delete features based on property_id
    $deletedCount = Property::whereIn('id', $request->id)->delete();
    
    // Log the number of deleted features
    \Log::info('Number of features deleted:', [$deletedCount]);

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
    \Log::info('Incoming Building Update Request:', $request->all());

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
    ]);

    // Iterate through each item and update
    foreach ($validatedRequest as $data) {
        // Find the building using the item ID
        $building = Building::find($data['item']['id']);

        if ($building) {
            // Update the building with the validated data
            $building->update([
                'property_id' => $data['item']['property_id'],
                'name' => $data['item']['name'],
                'development_type' => $data['item']['development_type'],
                'residential_levels' => $data['item']['residential_levels'],
                'basement_parking_levels' => $data['item']['basement_parking_levels'],
                'podium_parking_levels' => $data['item']['podium_parking_levels'],
                'commercial_units' => $data['item']['commercial_units'],
                'path' => $data['item']['path'],
            ]);

            \Log::info("Updated Building ID: {$data['item']['id']}");
        } else {
            // Log an error if the building is not found
            \Log::warning("Building with ID {$data['item']['id']} not found.");
        }
    }

    // Return a success response
    return response()->json(['message' => 'Buildings updated successfully.'], 200);
}

public function updateFeatures(Request $request)
{
    // Log the incoming request for debugging
    \Log::info('Incoming Request:', $request->all());

    // Validate incoming data structure
    $validatedData = $request->validate([
        '*.propertyId' => 'required|integer',
        '*.item' => 'required|array',
        '*.item.*.name' => 'required|string|max:255',
        '*.item.*.image' => 'nullable|string|max:255',
    ]);

    // Prepare an array to hold updated feature results
    $updatedFeatures = [];

    foreach ($validatedData as $data) {
        // Find the property using the propertyId as a reference
        $property = Property::find($data['propertyId']);

        if (!$property) {
            return response()->json(['message' => 'Property not found for ID ' . $data['propertyId']], 404);
        }

        // Prepare features array for JSON encoding
        $featuresArray = [];

        // Populate features array from validated data
        foreach ($data['item'] as $feature) {
            $featuresArray[] = [
                'name' => $feature['name'],
                'image' => $feature['image'] ?? null // Optional image field
            ];
        }

        // Update the property features field
        $property->features = json_encode($featuresArray);
        $property->save(); // Save the property

        // Log the updated features structure for debugging
        \Log::info('Updated Features for Property ID ' . $data['propertyId'], $featuresArray);

        // Store the updated features for the response
        $updatedFeatures[] = [
            'propertyId' => $data['propertyId'],
            'features' => $featuresArray
        ];
    }

    // Return a success response with all updated features
    return response()->json(['message' => 'Property features updated successfully.', 'updatedFeatures' => $updatedFeatures], 200);
}
public function updateFacilities(Request $request)
{
    $facilitiesData = json_decode($request->getContent(), true);

    foreach ($facilitiesData as $data) {
        $propertyId = $data['propertyId'];
        $items = $data['item'];

        // Get existing facilities for the property
        $existingFacilities = Facility::where('property_id', $propertyId)->pluck('name')->toArray();

        // Update or create facilities
        foreach ($items as $item) {
            // Check if facility already exists
            if (in_array($item, $existingFacilities)) {
                // Optionally, you can perform an update here if there are other fields to update
                continue; // Skip if facility already exists
            } else {
                // Create a new facility
                Facility::create([
                    'property_id' => $propertyId,
                    'name' => $item,
                ]);
            }
        }

        // Optionally, if you want to remove facilities that are no longer listed
        $facilitiesToDelete = array_diff($existingFacilities, $items);
        Facility::where('property_id', $propertyId)
            ->whereIn('name', $facilitiesToDelete)
            ->delete();
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

    // Store each image and collect their paths
    foreach ($request->file('images') as $image) {
        $path = $image->store('images', 'public'); // Store in 'storage/app/public/images'
        $uploadedImages[] = Storage::url($path); // Get the URL to the image
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
