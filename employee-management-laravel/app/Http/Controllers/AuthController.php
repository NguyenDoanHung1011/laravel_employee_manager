<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commands\Auth\LoginUserCommand;
use App\Commands\Auth\LogoutUserCommand;

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
        return $this->loginUserCommand->execute($request->email, $request->password);
    }

    public function logout(Request $request)
    {
        return $this->logoutUserCommand->execute($request);
    }
}