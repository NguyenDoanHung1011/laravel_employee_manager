<?php

namespace App\Commands\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserCommand
{
    public function execute($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}