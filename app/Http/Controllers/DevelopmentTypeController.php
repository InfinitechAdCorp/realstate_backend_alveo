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
    public function delete($id)
    {
        // Find the development type by ID
        $developmentType = DevelopmentType::find($id);

        // Check if the development type exists
        if (!$developmentType) {
            return response()->json(['message' => 'Development Type not found'], 404);
        }

        // Delete the development type
        $developmentType->delete();

        // Return a success response
        return response()->json(['message' => 'Development Type deleted successfully'], 200);
    }
}
