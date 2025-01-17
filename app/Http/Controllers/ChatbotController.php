<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function getAnswer(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $userMessage = $validated['message'];

        $matchedEntry = Chatbot::where('question', '=', $userMessage)->first();

        if (!$matchedEntry) {
            $words = explode(' ', $userMessage);

            $pattern = implode('|', array_map(function ($word) {
                return '\\b' . preg_quote($word, '/') . '\\b';
            }, $words));

            $matchedEntry = Chatbot::where('question', 'REGEXP', $pattern)->first();
        }

        if ($matchedEntry) {
            return response()->json([
                'status' => 'success',
                'answer' => $matchedEntry->answer,
            ], 200);
        } else {
            return response()->json([
                'status' => 'not_found',
                'answer' => 'Sorry, I could not find an answer to your question.',
            ], 404);
        }
    }
}
