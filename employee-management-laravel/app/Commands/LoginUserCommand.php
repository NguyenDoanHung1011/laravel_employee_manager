<?php

namespace App\Commands;

use App\DTOs\LoginDTO;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class LoginUserCommand
{
    public function execute(LoginDTO $dto)
    {
        $user = Employee::where('email', $dto->email)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            return null;
        }

        return [
            'access_token' => $user->createToken('authToken')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => $user
        ];
    }
}
