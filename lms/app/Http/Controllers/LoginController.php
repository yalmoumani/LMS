<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");

        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user(); // Retrieve the authenticated user
                $token = $user->createToken($request->token_name)->plainTextToken;

                // Return JSON response indicating successful login
                return response()->json([
                    "message" => "Successfully logged in.",
                    "access_token" => $token,
                ]);
            } else {
                throw ValidationException::withMessages([
                    "email" => "Invalid email or password.",
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Login failed.",
                "errors" => $e->errors(),
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out.'
        ]);
    }
}
