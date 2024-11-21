<?php

namespace App\Http\Controllers;
use App\Models\Building; 
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class BuildingController extends Controller
{
public function addBuildings(Request $request)
{
    $buildingsData = [];

    foreach ($request->propertyId as $propertyIndex => $propertyId) {
        $numberOfBuildings = $request->input("numberOfBuildings.{$propertyIndex}");

        for ($i = 0; $i < $numberOfBuildings; $i++) {
            $building = [
                'property_id' => $propertyId,
                'name' => $request->input("buildings.{$propertyIndex}.{$i}.name"),
                'development_type' => $request->input("buildings.{$propertyIndex}.{$i}.developmentType"),
                'residential_levels' => $request->input("buildings.{$propertyIndex}.{$i}.residentialLevels"),
                'basement_parking_levels' => $request->input("buildings.{$propertyIndex}.{$i}.basementParkingLevels"),
                'podium_parking_levels' => $request->input("buildings.{$propertyIndex}.{$i}.podiumParkingLevels"),
                'lower_ground_floor_parking_levels' => $request->input("buildings.{$propertyIndex}.{$i}.lowerGroundFloorParkingLevels"),
                'commercial_units' => $request->input("buildings.{$propertyIndex}.{$i}.commercialUnits"),
            ];

            // Store and save the path for the building view image
            if ($request->hasFile("buildings.{$propertyIndex}.{$i}.buildingView")) {
                $buildingViewPath = $request->file("buildings.{$propertyIndex}.{$i}.buildingView")->store('uploads/buildings', 'public');
                $building['path'] = url('storage/' . $buildingViewPath); // Generate full URL for the image
            }

            // Save the building data in the database
            $buildingModel = Building::create($building);

            // Add to response data
            $buildingsData[] = $buildingModel->toArray();
        }
    }

    // Return response with saved building data including paths
    return response()->json([
        'message' => 'Buildings saved successfully',
        'buildings' => $buildingsData
    ]);
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
