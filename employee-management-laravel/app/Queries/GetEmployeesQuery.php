<?php

namespace App\Queries;

use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Auth;

class GetEmployeesQuery
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $employee = Auth::employee();

        if (!$employee) {
            return null;
        }

        return $this->employeeRepository->getEmployeesByRole($employee);
    }
}
