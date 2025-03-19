<?php

namespace App\Handlers\Queries\Employee;

use App\Queries\Employee\GetEmployeesQuery;
use App\Models\User;

class GetEmployeesHandler {
    public function handle(GetEmployeesQuery $query) {
        if ($query->roleId == 1) {
            return User::where('id', '!=', $query->userId)->get();
        } elseif ($query->roleId == 2) {
            return User::where('department_id', $query->departmentId)
                       ->where('id', '!=', $query->userId)
                       ->get();
        } else {
            return User::where('department_id', $query->departmentId)->get();
        }
    }
}
