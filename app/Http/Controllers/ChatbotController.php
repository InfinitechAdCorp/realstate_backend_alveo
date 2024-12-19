<?php

namespace App\Http\Controllers;
use App\Models\Chatbot;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    // Fetch all chatbot questions and answers
    public function index()
    {
        $chatbotData = Chatbot::all(); // Retrieve all chatbot data
        return response()->json($chatbotData);
    }

    // Store a new chatbot question and answer
public function store(Request $request)
{
    // Validate the request data and catch any errors
    $validatedData = $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
    ]);

    if ($validatedData) {
        // If validated, proceed to create chatbot data
        $chatbotData = Chatbot::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

       return response()->json([
    'success' => true,
    'message' => 'Chatbot data added successfully', 
    'data' => $chatbotData
], 201);

    } else {
        return response()->json(['message' => 'Validation error', 'errors' => $request->errors()], 422);
    }
}




    // Update an existing chatbot question and answer
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $chatbotData = Chatbot::findOrFail($id); // Find the record by ID

        $chatbotData->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return response()->json(['message' => 'Chatbot data updated successfully', 'data' => $chatbotData]);
    }

    // Delete a chatbot question and answer
    public function destroy($id)
    {
        $chatbotData = Chatbot::findOrFail($id);
        $chatbotData->delete();

        return response()->json(['message' => 'Chatbot data deleted successfully']);
    }
}
