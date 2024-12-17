<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getAll()
    {
        $developmentTypes = Status::all(); // Fetch all development types
        return response()->json($developmentTypes, 200); // Return the data as JSON with a 200 OK status
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Add validation rules
        ]);

        Status::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Added successfully'], 201);
    }
}
