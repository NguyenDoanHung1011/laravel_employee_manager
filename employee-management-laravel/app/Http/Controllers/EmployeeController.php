<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\Employee\GetEmployeesQuery;

class EmployeeController extends Controller
{
    protected $getEmployeesQuery;

    public function __construct(GetEmployeesQuery $getEmployeesQuery)
    {
        $this->getEmployeesQuery = $getEmployeesQuery;
    }

    public function index(Request $request)
    {
        return response()->json($this->getEmployeesQuery->execute());
    }
}