<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAll()
    {
        $data = Area::all();
        return response()->json($data, 200);
    }

    public function get()
    {
        $data = Area::all()->map(function ($item) {
            $item->area_name = strtolower(str_replace(' ', '', $item->area_name)); 
            return $item;
        });

        return response()->json($data, 200); // Return the transformed data
    }


    public function store(Request $request)
    {
        $request->validate([
            'area_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',  // Ensure it's an image file if provided
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');

            $imageName = $imageFile->getClientOriginalName();

            $imageFile->move(public_path('images'), $imageName);
        }

        Area::create([
            'area_name' => $request->area_name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,  
        ]);

        // Return a successful response
        return response()->json(['message' => 'Added successfully'], 201);
    }
}
