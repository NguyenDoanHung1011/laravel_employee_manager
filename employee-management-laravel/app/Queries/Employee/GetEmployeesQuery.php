<?php

namespace App\Queries\Employee;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetEmployeesQuery
{
    public function execute()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->role_id == 1) {
            return User::where('id', '!=', $user->id)->get();
        } elseif ($user->role_id == 2) {
            return User::where('department_id', $user->department_id)
                       ->where('id', '!=', $user->id)
                       ->get();
        } else {
            return User::where('department_id', $user->department_id)->get();
        }
    }
}