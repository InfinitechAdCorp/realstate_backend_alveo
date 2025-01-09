<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse; // Ensure this is imported at the top
use Illuminate\Support\Facades\Log;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller

{

    public function getProperties(Request $request)
    {
        $location = $request->query('location');
        $architectural = $request->query('architectural');
        $unit = $request->query('unit');

        // Start building the query
        $propertiesQuery = Property::query();

        // Apply filters only if values are provided
        if ($location) {
            $propertiesQuery->where('location', $location);
        }

        if ($architectural) {
            $propertiesQuery->where('architectural_theme', $architectural);
        }

        if ($unit) { // You may want to handle "N/A" specifically
            $propertiesQuery->where('units', $unit);
        }

        // Fetch the results
        $properties = $propertiesQuery->get(['id', 'name', 'location', 'specific_location', 'land_area', 'price_range', 'units']);

        return response()->json($properties);
    }

    public function getAllLocations()
    {
        // Example with query builder for more control
        $locations = Property::select('location')->distinct()->get();

        return response()->json($locations);
    }
    public function getAllArchitectural()
    {
        // Example with query builder for more control
        $locations = Property::select('architectural_theme')->distinct()->get();

        return response()->json($locations);
    }
    public function store(Request $request)
    {
        // Validate incoming request, including file validation
        $request->validate([
            'key' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'specific_location' => 'required|string|max:255',
            'price_range' => 'required|string|max:255',
            'units' => 'required|string|max:255',
            'land_area' => 'required|string|max:255',
            'development_type' => 'required|string|max:255',
            'architectural_theme' => 'required|string|max:255',
            'path'  => 'nullable|image|max:2048',
            'view' => 'nullable|image|max:2048',
        ]);

        // Generate a folder name based on the property name or a unique identifier
        $folderName = strtolower(str_replace(' ', '_', $request->name));

        // Get the path where the files will be stored (directly in public/property)
        $storagePath = public_path('property/' . $folderName);

        // Check if the folder exists, if not, create it
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true); // Create the folder and allow permissions
        }

        // Initialize file paths
        $pathFilePath = null;
        $viewFilePath = null;

        // Check and handle 'path' file upload
        if ($request->hasFile('path')) {
            $pathFile = $request->file('path');
            $pathFileName = time() . '_' . $pathFile->getClientOriginalName();  // Ensure unique file name
            $pathFilePath = 'property/' . $folderName . '/' . $pathFileName;  // Store path relative to 'public' directory
            $pathFile->move($storagePath, $pathFileName); // Move the file to the folder
        }

        // Check and handle 'view' file upload
        if ($request->hasFile('view')) {
            $viewFile = $request->file('view');
            $viewFileName = time() . '_' . $viewFile->getClientOriginalName();  // Ensure unique file name
            $viewFilePath = 'property/' . $folderName . '/' . $viewFileName;  // Store path relative to 'public' directory
            $viewFile->move($storagePath, $viewFileName); // Move the file to the folder
        }

        // Log the request data for debugging
        Log::info('Received lat: ' . $request->lat);
        Log::info('Received lng: ' . $request->lng);
        Log::info('Request Data:', $request->all());

        // Create a new property record
        $property = Property::create([
            'key' => $request->key,
            'name' => $request->name,
            'status' => $request->status,
            'location' => $request->location,
            'lat' => (float) $request->lat,   // Cast to float
            'lng' => (float) $request->lng,   // Ensure lng is passed
            'specific_location' => $request->specific_location,
            'price_range' => $request->price_range,
            'units' => $request->units,
            'land_area' => $request->land_area,
            'development_type' => $request->development_type,
            'architectural_theme' => $request->architectural_theme,
            'path' => $pathFilePath,  // Save relative file path
            'view' => $viewFilePath,  // Save relative file path
        ]);

        // Return success response
        return response()->json([
            'message' => 'Property created successfully',
            'property' => $property,
        ], 201);
    }
    // Check if the property already exists

    public function index(Request $request)
    {
        // Get query parameters
        $filter = $request->query('filter');
        $search = $request->query('search');

        // Check if the filter and search are provided
        if (!$filter || !$search) {
            return response()->json([
                'message' => 'Filter or search value missing',
            ], 400);
        }

        // Start the query for properties
        $properties = Property::query();

        // Ensure filter is a valid column name to prevent SQL injection
        $validFilters = [
            'name',
            'status',
            'location',
            'specific_location',
            'price_range',
            'units',
            'land_area',
            'development_type',
            'architectural_theme',
        ];

        // Only apply the filter if it's valid
        if (in_array($filter, $validFilters)) {
            $properties->where($filter, 'like', "%{$search}%");
        } else {
            return response()->json([
                'message' => 'Invalid filter provided',
            ], 400);
        }

        // Execute the query and get the results
        $properties = $properties->get();

        // Return the results in the response
        return response()->json([
            'properties' => $properties,
        ]);
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
        Log::info('Delete Request Received:', $request->all()); // Log the request data

        $ids = $request->input('id'); // Expecting an array of IDs

        if (empty($ids) || !is_array($ids)) {
            return response()->json(['message' => 'No valid IDs provided'], 400);
        }

        // Delete properties with the provided IDs
        Property::destroy($ids);

        return response()->json(['message' => 'Properties deleted successfully']);
    }
}
