<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    // Handle user registration
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Handle user login
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Store user information in session
        $user = Auth::user();
        session(['user_id' => $user->id]);

        return response()->json(['message' => 'Login successful'], 200);
    }

    // Handle user logout
    public function logout(Request $request) {
        Auth::logout(); // Log out the user
        $request->session()->flush(); // Clear the session

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Handle session check
    public function checkSession(Request $request) {
        if ($request->session()->has('user_id')) {
            return response()->json(['message' => 'User is logged in'], 200);
        }

        return response()->json(['message' => 'User is not logged in'], 401);
    }
}
