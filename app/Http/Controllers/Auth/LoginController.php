<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Check user email
        $user = User::where('email', $request->email)->first();

        // Attempt to authenticate
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Generate a Sanctum token for the user
        $token = $user->createToken('access-token')->plainTextToken;

        // Get the user's role
        $role = $user->roles->pluck('name')->first();

        // Return the user and token as a response
        return response()->json([
            'user' => $user,
            'role' => $role,
            'token' => $token,
        ], 200);
    }
}
