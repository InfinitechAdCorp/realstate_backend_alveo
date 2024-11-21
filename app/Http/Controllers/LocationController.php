<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
 public function storeLocation(Request $request)
{
    // Validate incoming request
    $request->validate([
        'locations' => 'required|array', // Validate that locations is an array
        'locations.*.name' => 'required|string|max:255',
        'locations.*.location' => 'required|string|max:255',
        'locations.*.specific_location' => 'required|string|max:255',
        'locations.*.lat' => 'required|numeric',
        'locations.*.lng' => 'required|numeric',
        'locations.*.locationImage' => 'required|image|mimes:jpg,jpeg,png', // Validating the image for each location
    ]);

    // Loop through each location and process it
    $savedLocations = [];
    foreach ($request->locations as $locationData) {
        // Store location image
        $locationImagePath = $locationData['locationImage']->store('locations/images', 'public');
        
        // Generate the full URL for the image
        $locationImageUrl = url('storage/' . $locationImagePath);
        
        // Create a new location record in the database
        $location = Location::create([
            'name' => $locationData['name'],
            'location' => $locationData['location'],
            'specific_location' => $locationData['specific_location'],
            'lat' => $locationData['lat'],
            'lng' => $locationData['lng'],
            'location_image' => $locationImageUrl, // Save the full URL for the location image
        ]);
        
        // Store the saved location details to return in the response
        $savedLocations[] = $location;
    }

    // Return a response with all saved locations
    return response()->json([
        'message' => 'Locations created successfully',
        'locations' => $savedLocations,
    ], 201);
}

    public function search(Request $request)
    {
        $input = $request->input('input'); // Change to match your query parameter

        // Fetch locations that match the input
        $locations = Location::where('name', 'LIKE', '%' . $input . '%')->get();

        return response()->json($locations);
    }
     public function index(): JsonResponse
    {
        try {
            $locations = Location::all();
            if ($locations->isEmpty()) {
                return response()->json(['message' => 'No locations found'], 404);
            }
            return response()->json($locations);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch locations', 'message' => $e->getMessage()], 500);
        }
    }
     public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'locations' => 'required|array',
            'locations.*.location' => 'required|string',
            'locations.*.name' => 'required|string',
            'locations.*.path' => 'required|string',
            'locations.*.lat' => 'required|numeric',
            'locations.*.lng' => 'required|numeric',
        ]);

        // Loop through each location and save it
        foreach ($request->locations as $locationData) {
            Location::create($locationData);
        }

        return response()->json(['message' => 'Locations stored successfully'], 201);
    }
}