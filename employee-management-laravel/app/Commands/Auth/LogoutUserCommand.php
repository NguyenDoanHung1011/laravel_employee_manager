<?php

namespace App\Commands\Auth;

use Illuminate\Http\Request;

class LogoutUserCommand
{
    public function execute(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
