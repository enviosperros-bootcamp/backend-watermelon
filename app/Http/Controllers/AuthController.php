<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUserMail;




class AuthController extends Controller
{
public function register(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
        ]);
        Mail::to($user->email)->send(new WelcomeUserMail($user));


        $token = auth('api')->attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        if (!$token) {
            return response()->json([
                'message' => 'Login after register failed'
            ], 401);
        }

        return response()->json([
            'message' => 'User registered and logged in successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user->only(['id', 'name', 'email'])
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    }
    
}


    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email', // ✅ fix typo
            'password' => 'required|string',
        ]);

        if (!$token = auth('api')->attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json([
            'user' => auth('api')->user(),
        ]);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => auth('api')->user(),
        ]);
    }
    public function logout()
{
    auth('api')->logout(); 
    return response()->json(['message' => 'Successfully logged out']);
}

}
