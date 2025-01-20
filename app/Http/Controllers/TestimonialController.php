<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Get all testimonials
    public function index()
    {
        return response()->json(Testimonial::all(), 200);
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $testimonial = Testimonial::create($request->all());
        return response()->json($testimonial, 201);
    }

    // Get a specific testimonial
    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }
        return response()->json($testimonial, 200);
    }

    // Update a testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        $testimonial->update($request->all());
        return response()->json($testimonial, 200);
    }

    // Delete a testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully'], 200);
    }
}
