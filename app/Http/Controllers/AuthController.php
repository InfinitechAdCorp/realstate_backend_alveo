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

class AuthController extends Controller
{
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

    // If credentials are correct, return success response
    return response()->json(['message' => 'Login successful.']);
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


    public function logout()
        {
            // Log the user out
            Auth::logout();

            // Invalidate the session and regenerate the session ID
            session()->invalidate();
            session()->regenerateToken();

            // Redirect the user to a desired page (e.g., login page)
            return redirect()->route('login'); // Or any other route you wish
        }
}
