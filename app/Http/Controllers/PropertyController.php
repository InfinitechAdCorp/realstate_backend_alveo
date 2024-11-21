<?php

    namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse; // Ensure this is imported at the top


    use App\Models\Property;
    use Illuminate\Http\Request;
    class PropertyController extends Controller

        {
public function store(Request $request)
{
    // Validate incoming request
    $request->validate([
        'key' => 'required|string|max:255', 
        'name' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'specific_location' => 'required|string|max:255',
        'price_range' => 'required|string|max:255',
        'units' => 'required|string|max:255',
        'land_area' => 'required|string|max:255',
        'development_type' => 'required|string|max:255',
        'architectural_theme' => 'required|string|max:255',
        'propertyImage' => 'required|image|mimes:jpg,jpeg,png',
        'masterPlanImg' => 'required|image|mimes:jpg,jpeg,png',
    ]);

    // Store property images
    $propertyImagePath = $request->file('propertyImage')->store('properties/images', 'public');
    $masterPlanImagePath = $request->file('masterPlanImg')->store('properties/masterplans', 'public');

    // Create full URLs for images
    $propertyImageUrl = url('storage/' . $propertyImagePath); // Generate full URL for property image
    $masterPlanImageUrl = url('storage/' . $masterPlanImagePath); // Generate full URL for master plan image

    // Create a new property record
    $property = Property::create([
        'key' => $request->key,
        'name' => $request->name,
        'status' => $request->status,
        'location' => $request->location,
        'specific_location' => $request->specific_location,
        'price_range' => $request->price_range,
        'units' => $request->units,
        'land_area' => $request->land_area,
        'development_type' => $request->development_type,
        'architectural_theme' => $request->architectural_theme,
        'path' => $propertyImageUrl, // Save the full URL instead of the relative path
        'view' => $masterPlanImageUrl, // Save the full URL instead of the relative path
    ]);

    // Optionally, return a response
    return response()->json([
        'message' => 'Property created successfully',
        'property' => $property,
    ], 201);
}
             public function updateProperties(Request $request)
                {
                return response()->json(['message' => 'Hello, World!']);
                }
        public function index(Request $request)
{
    // Get query parameters
    $filter = $request->query('filter');
    $search = $request->query('search');

    // Start the query for properties
    $properties = Property::query();

    // Check if both filter and search are provided
    if ($filter && $search) {
        // Ensure filter is a valid column name to prevent SQL injection
        $validFilters = ['name',
            'status',
            'location',
            'specific_location',
            'price_range',
            'units',
            'land_area',
            'development_type',
            'architectural_theme',]; // Adjust with your actual fields
        if (in_array($filter, $validFilters)) {
            $properties->where($filter, 'like', "%{$search}%");
        }
    }

    // Return the properties as a JSON response
    return response()->json($properties->get());
}

            public function show($slug)
            {
                // Assuming you have a Property model that fetches the properties
                $property = Property::where('key', $slug)->get();

                if (!$property) {
                    return response()->json(['message' => 'Property not found'], 404);
                }

                return response()->json($property);
            }
             public function countlocations(): JsonResponse
    {
        // Count unique locations
        $count = Property::distinct('location')->count('location');
        return response()->json(['count' => $count]); // Return as JSON
    }
   public function countProperties(): JsonResponse // Use Illuminate\Http\JsonResponse
    {
        $count = Property::count(); // Get the count of properties
        return response()->json(['count' => $count]); // Return as JSON
    }
    public function showById($id)
        {
            // Fetch the property from the database based on the ID
            $property = Property::find($id);

            // Check if property exists
            if (!$property) {
                return response()->json(['message' => 'Property not found'], 404);
            }

            return response()->json($property); // Return the property data as JSON
        }
        public function getPropertyByName($name)
        {
            // Fetch the property by name
            $property = Property::where('name', $name)->first();

            if ($property) {
                return response()->json($property);
            }

            return response()->json(['message' => 'Property not found'], 404);
        }
        public function properties()
    {
        // Fetch all properties from the database
        $properties = Property::all();

        // Return the property data as JSON
        return response()->json($properties); // Return the properties data as JSON
    }
public function features()
{
    // Fetch all properties and select only id and features
    $features = Property::select('id', 'features')->get();

    // Return the property data as JSON
    return response()->json($features);
}
public function deleteProperties(Request $request)
{
    \Log::info('Delete Request Received:', $request->all()); // Log the request data

    $ids = $request->input('id'); // Expecting an array of IDs
    
    if (empty($ids) || !is_array($ids)) {
        return response()->json(['message' => 'No valid IDs provided'], 400);
    }

    // Delete properties with the provided IDs
    Property::destroy($ids);

    return response()->json(['message' => 'Properties deleted successfully']);
}


        }