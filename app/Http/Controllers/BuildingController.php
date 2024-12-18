<?php

namespace App\Http\Controllers;
use App\Models\Building; 
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
class BuildingController extends Controller
{
public function addBuildings(Request $request)
{
    try {
        // Validate the request data
        $validated = $this->validateBuildingData($request);

        // Prepare the building data
        $building = $this->prepareBuildingData($validated);

        // Handle file upload for 'buildingView' and update path
        if ($request->hasFile('buildingView')) {
            $building['path'] = $this->uploadBuildingImage($request, $validated['propertyName']);
        }

        // Save building data to the database
        $buildingModel = Building::create($building);

        // Return success response
        return response()->json([
            'message' => 'Building saved successfully',
            'building' => $buildingModel->toArray(),
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        Log::error('Validation Error:', $e->errors());
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        // Handle general exceptions
        Log::error('Unexpected Error:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'An unexpected error occurred'], 500);
    }
}

/**
 * Validate the incoming request data.
 */
private function validateBuildingData(Request $request)
{
    return $request->validate([
        'propertyId' => 'required|integer',
        'propertyName' => 'required|string|regex:/^[a-zA-Z0-9_\- ]+$/', // Allow letters, numbers, spaces, underscores, hyphens
        'buildingName' => 'required|string',
        'developmentType' => 'required|string',
        'residentialLevels' => 'required|integer',
        'basementParkingLevels' => 'required|integer',
        'podiumParkingLevels' => 'required|integer',
        'commercialUnits' => 'required|integer',
        'lowerGroundParkingLevels' => 'required|integer',
  'buildingView' => 'nullable|image|max:2048',

    ]);
}

/**
 * Prepare the building data for saving.
 */
private function prepareBuildingData(array $validated)
{
    return [
        'property_id' => $validated['propertyId'],
        'name' => $validated['buildingName'],
        'development_type' => $validated['developmentType'],
        'residential_levels' => $validated['residentialLevels'],
        'basement_parking_levels' => $validated['basementParkingLevels'],
        'podium_parking_levels' => $validated['podiumParkingLevels'],
        'lower_ground_floor_parking_levels' => $validated['lowerGroundParkingLevels'],
        'commercial_units' => $validated['commercialUnits'],
    ];
}

/**
 * Upload the building image to a dynamic directory based on propertyName.
 */
private function uploadBuildingImage(Request $request, string $propertyName)
{
    // Sanitize property name for directory creation
    $safePropertyName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $propertyName);

    // Define destination directory
    $destinationPath = public_path("property/{$safePropertyName}");

    // Create directory if it doesn't exist
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
        Log::info('Directory created successfully', ['path' => $destinationPath]);
    }

    // Process the uploaded file
    $file = $request->file('buildingView');
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Move the file to the destination path
    $file->move($destinationPath, $fileName);

    // Return the public path to the uploaded file
    $publicPath = asset("property/{$safePropertyName}/{$fileName}");
    Log::info('File uploaded successfully', ['path' => $publicPath]);

    return $publicPath;
}




       public function countotherbuildings(): JsonResponse
    {
        $count = Building::count(); // Get the count of buildings
        return response()->json(['count' => $count]); // Return as JSON
    }
      public function countcondominiums(): JsonResponse
    {
        // Use LIKE query to count all buildings with 'Condominium' in the development_type
        $count = Building::where('development_type', 'LIKE', '%Condominium%')->count();
        return response()->json(['count' => $count]); // Return as JSON
    }
    public function getBuildingsByProperty(Request $request)
    {
        // Validate that 'property_id' is provided
        $request->validate([
            'property_id' => 'required|integer|exists:properties,id',
        ]);

        // Fetch buildings associated with the provided property_id
        $buildings = Building::where('property_id', $request->property_id)->get();

        // Return the buildings as a JSON response
        return response()->json($buildings);
    }
      public function index(Request $request)
    {
        $buildings = Building::all();
        return response()->json($buildings);
    }
   public function getBuildingById($id)
{
    // Find the building by its ID
    $building = Building::where('property_id', $id)->get();

    if ($building) {
        return response()->json($building);
    }

    return response()->json(['message' => 'Building not found'], 404);
}
     public function buildings(Request $request)
    {
        $buildings = Building::all();
        return response()->json($buildings);
    }
}
