<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:admin,owner,client',
        ]);

        // Create a new user (client)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Check user type
        if ($request->user_type == "admin") {
            $user->assignRole('admin');
        } elseif ($request->user_type == "owner") {
            $user->assignRole('owner');
        } else {
            $user->assignRole('client');
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
        ], 201);

    }
}
