<?php

namespace App\Http\Controllers;

use App\Models\ArchitecturalTheme;
use Illuminate\Http\Request;

class ArchitecturalThemeController extends Controller
{
    public function getAll()
    {
        $archiTheme = ArchitecturalTheme::all(); 
        return response()->json($archiTheme, 200); 
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        ArchitecturalTheme::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Added successfully'], 201);
    }
public function deleteArchitecturalTheme($id)
{
    $theme = ArchitecturalTheme::find($id);

    if ($theme) {
        $theme->delete();
        return response()->json(['message' => 'Architectural Theme deleted successfully']);
    }

    return response()->json(['message' => 'Architectural Theme not found'], 404);
}


}
