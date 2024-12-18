<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAll()
    {
        $archiTheme = Area::all();
        return response()->json($archiTheme, 200);
    }

    public function show($slug)
    {
        // Query the database for the area by slug
        $slug = strtolower($slug); // Ensure the slug is lowercase
    
        // Query the Area model by comparing with the slug (after formatting the database's area_name)
        $area = Area::whereRaw('LOWER(REPLACE(area_name, " ", "-")) = ?', [$slug])->first();
    
        if (!$area) {
            return response()->json(['message' => 'Area not found'], 404);
        }

        return response()->json($area);
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('property_images', 'public');
        }

        Area::create([
            'area_name' => $request->area_name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Return a successful response
        return response()->json(['message' => 'Added successfully'], 201);
    }
}
