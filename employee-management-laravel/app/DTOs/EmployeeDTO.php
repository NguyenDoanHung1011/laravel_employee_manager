<?php

namespace App\DTOs;

class EmployeeDTO
{
    public int $id;
    public string $name;
    public string $email;
    public int $role_id;
    public int $department_id;

    public function __construct(int $id, string $name, string $email, int $role_id, int $department_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role_id = $role_id;
        $this->department_id = $department_id;
    }
}