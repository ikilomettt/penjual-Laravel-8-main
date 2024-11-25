<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'required',
            'password' => 'required|string|min:8',
            'level' => 'required|integer|min:1|max:3',
        ]);

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'phone_number' => $validateData['phoneNumber'],
            'password' => Hash::make($validateData['password']),
            'level' => $validateData['level'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'User created successfully',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
         $request->validate([
            'phoneNumber' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial pengguna
        $credentials = $request->only('phoneNumber', 'password');
        $user = User::where('phone_number', $request->phoneNumber)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate token untuk autentikasi
        $token = $user->createToken('authToken')->plainTextToken;

        // Berikan respons dengan token
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
}
