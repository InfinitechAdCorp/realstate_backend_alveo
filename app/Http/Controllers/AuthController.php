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
class AuthController extends Controller
{
 public function login(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Ensure email is properly formatted
            'password' => 'required|min:6', // Password must be at least 6 characters long
            'code' => 'required|string', // Ensure code is provided and is a string
        ]);

        // Return errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'details' => $validator->errors()
            ], 400);
        }

        // Check if the code exists and matches the 'LOGIN' status
        $companyCode = CompanyCode::where('code', $request->code)
                                  ->where('status', 'LOGIN') // Ensure the code is for login
                                  ->where('is_active', 1)
                                  ->first();

        // If the code is invalid, return an error
        if (!$companyCode) {
            return response()->json([
                'error' => 'Invalid code',
                'message' => 'The provided code is incorrect or not valid for login.'
            ], 401);
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and if the password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Invalid credentials',
                'message' => 'The provided email or password is incorrect.'
            ], 401);
        }


        // Set expiration time to 2 hours from now
    $token = $user->createToken('real-state', ['ability1', 'ability2'])
                  ->plainTextToken;

    // Store token expiration manually in the database (for validation)
    DB::table('personal_access_tokens')
        ->where('token', $token)
        ->update(['expires_at' => now()->addMinutes(2)]);

    // Return a success response with user data and token
    return response()->json([
        'message' => 'Login successful',
        'user' => $user,  // Optionally return the user data
        'token' => $token  // Include the generated token in the response
    ], 200);
}
public function register(Request $request)
{
    // Log the incoming request to inspect what data is being received
    \Log::info('Received registration request:', $request->all());

    // Validate the incoming data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email', // Ensure email is unique and properly formatted
        'password' => 'required|min:6', // Password must be at least 6 characters long
        'code' => 'required|string', // Validate code as a required field
    ]);

    // Return errors if validation fails
    if ($validator->fails()) {
        return response()->json([
            'error' => 'Validation failed',
            'details' => $validator->errors()
        ], 400);
    }

    // Validate if the code exists in the companycode table with status 'REGISTER'
    $companyCode = CompanyCode::where('status', 'REGISTER') // Only look for status "REGISTER"
                               ->where('code', $request->code) // Check for the matching code
                               ->where('is_active', 1)
                               ->first();

    if (!$companyCode) {
        return response()->json([
            'error' => 'Invalid code',
            'message' => 'The provided code does not exist or is not valid for registration.'
        ], 400);
    }

    try {
        // Proceed to create the user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password for security
        ]);

        // Return a success response with user data
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    } catch (\Exception $e) {
        // Handle any errors that may occur during user creation
        return response()->json([
            'error' => 'User registration failed',
            'exception' => $e->getMessage() // Include exception message for debugging
        ], 500);
    }
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
