<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\CompanyCode;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Admin; 
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
public function logout(Request $request)
{
    $user = Auth::user();
    $user->tokens->each(function ($token) {
        $token->delete();
    });

    return response()->json(['message' => 'Logged out successfully.']);
}
public function logoutAll(Request $request)
{
    // Retrieve the authenticated user
    $user = $request->user();

    // Check if user is authenticated
    if (!$user) {
        return response()->json(['error' => 'User not authenticated.'], 401);
    }

    // Revoke/delete all existing tokens for this user (logs out from all sessions)
    $user->tokens->each(function ($token) {
        $token->delete();
    });

    // Return a success message
    return response()->json([
        'message' => 'All sessions logged out successfully.',
    ]);
}

public function login(Request $request)
{
    // Validate incoming request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find user by email
    $user = User::where('email', $request->email)->first();

    // If user not found or password doesn't match, return an error
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Invalid email or password.'], 401);
    }

    // Log user data for debugging (optional)
    Log::info('User logged in:', ['user' => $user]);

    // Generate API token
    $token = $user->createToken('AppName')->plainTextToken;

    // Return a success response with the token
    return response()->json([
        'message' => 'Login successful.',
        'token' => $token,
         'name' => $user->name,
    ]);
}


// In your AuthController or another relevant controller


public function register(Request $request)
{
    // Validate input
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',  // Removed the 'confirmed' rule
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()
        ], 400);
    }

    // Hash password and store user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),  // Hash the password
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Account created successfully!',
        'user' => $user,
    ], 201);
}



}
