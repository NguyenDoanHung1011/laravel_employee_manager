<?php

namespace App\Queries\Employee;

class GetEmployeesQuery {
    public int $userId;
    public int $roleId;
    public int $departmentId;

    public function __construct(int $userId, int $roleId, int $departmentId) {
        $this->userId = $userId;
        $this->roleId = $roleId;
        $this->departmentId = $departmentId;
    }
}