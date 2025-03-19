<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commands\LoginUserCommand;
use App\Commands\LogoutUserCommand;
use App\DTOs\LoginDTO;

class AuthController extends Controller
{
    protected $loginUserCommand;
    protected $logoutUserCommand;

    public function __construct(LoginUserCommand $loginUserCommand, LogoutUserCommand $logoutUserCommand)
    {
        $this->loginUserCommand = $loginUserCommand;
        $this->logoutUserCommand = $logoutUserCommand;
    }

    public function login(Request $request)
    {
        $dto = new LoginDTO($request->email, $request->password);
        $result = $this->loginUserCommand->execute($dto);

        if (!$result) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($result);
    }

    public function logout(Request $request)
    {
        return response()->json($this->logoutUserCommand->execute($request));
    }
}