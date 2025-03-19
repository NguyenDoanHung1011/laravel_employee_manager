<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\DTOs\EmployeeDTO;

class GetEmployeesQuery
{
    public function execute(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $query = User::query();

        if ($user->role_id == 1) {
            $query->where('id', '!=', $user->id);
        } elseif ($user->role_id == 2) {
            $query->where('department_id', $user->department_id)
                  ->where('id', '!=', $user->id);
        } else {
            $query->where('department_id', $user->department_id);
        }

        return $query->get()->map(fn($employee) => new EmployeeDTO(
            $employee->id,
            $employee->name,
            $employee->email,
            $employee->role_id,
            $employee->department_id
        ))->toArray();
    }
}