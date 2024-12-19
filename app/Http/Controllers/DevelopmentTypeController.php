<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentType;
use Illuminate\Http\Request;

class DevelopmentTypeController extends Controller
{
    
    public function getAll()
    {
        $developmentTypes = DevelopmentType::all(); // Fetch all development types
        return response()->json($developmentTypes, 200); // Return the data as JSON with a 200 OK status
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Add validation rules
        ]);

        DevelopmentType::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Development Type added successfully'], 201);
    }
    public function destroy($id)
{
    $developmentType = DevelopmentType::find($id);

    if (!$developmentType) {
        return response()->json(['message' => 'Development Type not found'], 404);
    }

    $developmentType->delete();

    return response()->json(['message' => 'Development Type deleted successfully'], 200);
}

}
