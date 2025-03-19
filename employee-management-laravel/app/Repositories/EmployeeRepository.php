<?php
namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployeesByRole($employee)
    {
        if ($employee->role_id == 1) {
            return employee::where('id', '!=', $employee->id)->get();
        } elseif ($employee->role_id == 2) {
            return employee::where('department_id', $employee->department_id)
                        ->where('id', '!=', $employee->id)
                        ->get();
        } else {
            return employee::where('department_id', $employee->department_id)->get();
        }
    }
}