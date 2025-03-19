<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Đăng nhập
    public function login(Request $request)
{
    $employee = Employee::where('email', $request->email)->first();

    if (!$employee || !Hash::check($request->password, $employee->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $token = $employee->createToken('authToken')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'employee' => $employee
    ]);
}

    // Đăng xuất
    public function logout(Request $request)
    {
        $request->employee()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}