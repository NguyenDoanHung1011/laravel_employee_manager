<?php

namespace App\Commands;

use Illuminate\Http\Request;

class LogoutUserCommand
{
    public function execute(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }
}