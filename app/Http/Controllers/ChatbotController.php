<?php

namespace App\Http\Controllers;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $chatbotEntries = Chatbot::all();
        return response()->json($chatbotEntries, 200);
    }
   public function addChatbot(Request $request)
{
    $validated = $request->validate([
        'question' => 'required|string',
        'answer' => 'required|string',
    ]);

    $chatbot = Chatbot::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Chatbot entry added successfully',
        'data' => $chatbot,
    ], 201);
}

   public function deleteChatbot($id)
{
    $chatbot = Chatbot::find($id);

    if (!$chatbot) {
        return response()->json(['success' => false, 'message' => 'Chatbot entry not found.'], 404);
    }

    $chatbot->delete();

    return response()->json(['success' => true, 'message' => 'Chatbot entry deleted successfully.'], 200);
}


}
