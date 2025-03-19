<?php

namespace App\Http\Controllers;

use App\Queries\GetEmployeesQuery;
use Illuminate\Http\Request;
<<<<<<< Updated upstream
=======
use App\Queries\Employee\GetEmployeesQuery;
use App\Handlers\Queries\Employee\GetEmployeesHandler;
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $handler;

    public function __construct(GetEmployeesHandler $handler)
    {
        $this->handler = $handler;
    }

    public function index()
    {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        $employee = Auth::employee();
        if (!$employee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $employees = $this->getEmployeesQuery->execute();
=======
=======
>>>>>>> Stashed changes
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $query = new GetEmployeesQuery($user->id, $user->role_id, $user->department_id);
        $employees = $this->handler->handle($query);

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        return response()->json($employees);
    }
}
