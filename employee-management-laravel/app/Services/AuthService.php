<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Tạo token API cho user
        $token = Str::random(60);
        $user->api_token = hash('sha256', $token);
        $user->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout($user)
    {
        $user->api_token = null;
        $user->save();
        
        return response()->json(['message' => 'Logged out successfully']);
    }
}
