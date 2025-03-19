<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commands\LoginEmployeeCommand;
use App\Commands\LogoutEmployeeCommand;
use App\DTOs\LoginDTO;

class AuthController extends Controller
{
    protected $loginEmployeeCommand;
    protected $logoutEmployeeCommand;

    public function __construct(LoginEmployeeCommand $loginEmployeeCommand, LogoutEmployeeCommand $logoutEmployeeCommand)
    {
        $this->loginEmployeeCommand = $loginEmployeeCommand;
        $this->logoutEmployeeCommand = $logoutEmployeeCommand;
    }

    public function login(Request $request)
    {
        $dto = new LoginDTO($request->email, $request->password);
        $result = $this->loginEmployeeCommand->execute($dto);

        if (!$result) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($result);
    }

    public function logout(Request $request)
    {
        return response()->json($this->logoutEmployeeCommand->execute($request));
    }
}
