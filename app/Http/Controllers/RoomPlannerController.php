<?php

namespace App\Http\Controllers;
use App\Models\RoomPlanner;
use Illuminate\Http\Request;

class RoomPlannerController extends Controller
{
    // Store room planner data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'required|string|max:255',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'category' => 'required|string|max:255',
        ]);

        $roomPlanner = RoomPlanner::create([
            'name' => $request->name,
            'picture' => $request->picture,
            'width' => $request->width,
            'height' => $request->height,
            'category' => $request->category,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Room Planner item created successfully!',
            'data' => $roomPlanner,
        ], 201);
    }

    // Fetch all room planner items
    public function index()
    {
        $roomPlanners = RoomPlanner::all();

        return response()->json([
            'data' => $roomPlanners,
        ]);
    }
}
