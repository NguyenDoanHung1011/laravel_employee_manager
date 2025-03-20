<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAllUsers();
    }

    public function show($id)
    {
        return $this->userService->getUserById($id);
    }

    public function store(Request $request)
    {
        return $this->userService->createUser($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->userService->updateUser($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userService->deleteUser($id);
    }
}
