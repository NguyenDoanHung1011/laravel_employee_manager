<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employee = Auth::employee();

        if (!$employee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($employee->role_id == 1) {
            // Admin: Trả về tất cả nhân viên (trừ chính họ)
            $employees = Employee::where('id', '!=', $employee->id)->get();
        } elseif ($employee->role_id == 2) {
            // Leader: Chỉ lấy nhân viên cùng phòng ban (trừ chính họ)
            $employees = Employee::where('department_id', $employee->department_id)
                             ->where('id', '!=', $employee->id)
                             ->get();
        } else {
            // Employee: Chỉ xem được thông tin bản thân và đồng nghiệp cùng phòng ban
            $employees = Employee::where('department_id', $employee->department_id)->get();
        }

        return response()->json($employees);
    }
}
