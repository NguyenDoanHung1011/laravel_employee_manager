<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->role_id == 1) {
            // Admin: Trả về tất cả nhân viên (trừ chính họ)
            $employees = User::where('id', '!=', $user->id)->get();
        } elseif ($user->role_id == 2) {
            // Leader: Chỉ lấy nhân viên cùng phòng ban (trừ chính họ)
            $employees = User::where('department_id', $user->department_id)
                             ->where('id', '!=', $user->id)
                             ->get();
        } else {
            // Employee: Chỉ xem được thông tin bản thân và đồng nghiệp cùng phòng ban
            $employees = User::where('department_id', $user->department_id)->get();
        }

        return response()->json($employees);
    }
}
