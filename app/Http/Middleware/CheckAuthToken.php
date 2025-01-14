<?php

// app/Http/Middleware/CheckAuthToken.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthToken
{
 public function handle(Request $request, Closure $next)
{
    // Log incoming request headers for debugging
    \Log::info('Request Headers: ', $request->headers->all());

    if (!$request->hasHeader('Authorization')) {
        return response()->json(['error' => 'Authorization token is missing.'], 401);
    }

    $token = str_replace('Bearer ', '', $request->header('Authorization'));

    if (!Auth::guard('api')->check()) {
        return response()->json(['error' => 'Invalid or expired token.'], 401);
    }

    return $next($request);
}

}

