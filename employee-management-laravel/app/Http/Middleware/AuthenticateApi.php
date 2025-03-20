<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AuthenticateApi
{
    public function handle($request, Closure $next)
    {
        // Lấy token từ header Authorization
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Tìm user có token hợp lệ
        $user = User::where('api_token', hash('sha256', $token))->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Đăng nhập user vào request
        auth()->setUser($user);

        return $next($request);
    }
}
