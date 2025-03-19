<?php

namespace App\Commands;

use App\DTOs\LoginDTO;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class LoginEmployeeCommand
{
    public function execute(LoginDTO $dto)
    {
        $employee = employee::where('email', $dto->email)->first();

        if (!$employee || !Hash::check($dto->password, $employee->password)) {
            return null;
        }

        return [
            'access_token' => $employee->createToken('authToken')->plainTextToken,
            'token_type' => 'Bearer',
            'employee' => $employee
        ];
    }
}
