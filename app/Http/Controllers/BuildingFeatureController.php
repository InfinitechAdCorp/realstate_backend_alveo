<?php

namespace App\Http\Controllers;

use App\Models\Facility; // Ensure this points to the correct model
use Illuminate\Http\Request;

class BuildingFeatureController extends Controller
{
    public function index(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'property_id' => 'required|integer|exists:properties,id', // Ensure property_id is valid
        ]);

        // Retrieve the property_id from the request
        $propertyId = $request->input('property_id');

        // Fetch facilities related to the property ID
        $facilities = Facility::where('property_id', $propertyId)->get();

        // Return the features as a JSON response
        return response()->json($facilities);
    }
    public function getFacilitiesbyID($id)
{
    // Fetch facilities related to the property ID
    $facilities = Facility::where('property_id', $id)->get();

    // Return the features as a JSON response
    return response()->json($facilities);
}
   public function facilities()
{
    // Fetch all properties from the database
    $facilities = Facility::all();

    // Return the property data as JSON
    return response()->json($facilities); // Return the properties data as JSON
}
}
