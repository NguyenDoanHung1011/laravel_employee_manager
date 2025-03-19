<?php

namespace App\Http\Controllers;

use App\Queries\GetEmployeesQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $getEmployeesQuery;

    public function __construct(GetEmployeesQuery $getEmployeesQuery)
    {
        $this->getEmployeesQuery = $getEmployeesQuery;
    }

    public function index(Request $request)
    {
        $employee = Auth::employee();
        if (!$employee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $employees = $this->getEmployeesQuery->execute();
        return response()->json($employees);
    }
}
