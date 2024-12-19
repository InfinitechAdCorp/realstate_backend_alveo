<?php
    namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DevelopmentType;
use App\Models\ArchitecturalTheme;
use App\Models\Status;
use App\Models\Area;

class ResourceController extends Controller
{
    /**
     * Handle adding a resource based on the type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
   public function addResource(Request $request, $type)
{
    // Validate the required fields
    $validated = $request->validate(['name' => 'required|string']);

    switch ($type) {
        case 'development-type':
            $model = new DevelopmentType();
            break;
        case 'architectural-theme':
            $model = new ArchitecturalTheme();
            break;
        case 'status':
            $model = new Status();
            break;
        case 'location':
            $model = new Area();

            // Add specific fields for location
            $request->validate([
                'area_name' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|string', // Optional image field
            ]);

            // Check if location with the same area_name already exists
            $existingLocation = Area::where('area_name', $request->area_name)->first();
            if ($existingLocation) {
                return response()->json(['message' => 'Location with this name already exists'], 400);
            }

            // Assign values for location
            $model->area_name = $request->area_name;
            $model->title = $request->title;
            $model->description = $request->description;
            $model->image = $request->image;  // Assuming the image is passed as a string (path or URL)
            break;
        default:
            return response()->json(['message' => 'Invalid resource type'], 400);
    }

    // Check for duplicate name for other types
    $existingResource = $model::where('name', $request->name)->first();
    if ($existingResource) {
        return response()->json(['message' => ucfirst($type) . ' with this name already exists'], 400);
    }

    // Save the model (common for all types)
    $model->name = $request->name;
    $model->save();

    // Return a success response
    return response()->json(['message' => ucfirst($type) . ' added successfully'], 201);
}

    /**
     * Handle deleting a resource based on the type and id.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteResource($type, $id)
{
    \Log::info("Deleting resource: Type - $type, ID - $id"); // Debugging log
    
    switch ($type) {
        case 'development-type':
            $model = DevelopmentType::find($id);
            break;
        case 'architectural-theme':
            $model = ArchitecturalTheme::find($id);
            break;
        case 'status':
            $model = Status::find($id);
            break;
        case 'location':
            $model = Area::find($id);
            break;
        default:
            return response()->json(['message' => 'Invalid resource type'], 400);
    }

    if (!$model) {
        return response()->json(['message' => ucfirst($type) . ' not found'], 404);
    }

    $model->delete();
    return response()->json(['message' => ucfirst($type) . ' deleted successfully']);
}

}
