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
            'password' => 'required|string|min:8|confirmed',
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
 public function storeCompanyCode($user, $password, $status, $code, $is_active)
{
    // Validate the status to be 'register' or 'login'
    if (!in_array(strtolower($status), ['register', 'login'])) {
        return response()->json(['error' => 'Invalid status. Only "register" or "login" are allowed.'], 400);
    }

    // Convert is_active to boolean
    $is_active = filter_var($is_active, FILTER_VALIDATE_BOOLEAN);

    try {
        // Verify if the user exists and the password matches
        $admin = Admin::where('user', $user)->first();

        // Check if the user exists and password is correct
        if (!$admin || !Hash::check($password, $admin->password)) {
            return response()->json(['error' => 'Unauthorized. Invalid user or password.'], 401);
        }

        // Use updateOrInsert to either update or insert based on the status
        DB::table('companycode')->updateOrInsert(
            [
                'status' => strtolower($status), // Ensure status is in lowercase
            ],
            [
                'code' => $code,
                'is_active' => $is_active,
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Company code added or updated successfully.'], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Error: ' . $e->getMessage()], 400);
    }
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
