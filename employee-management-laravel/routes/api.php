<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']); 
    Route::get('/users/{id}', [UserController::class, 'show']); 
    Route::post('/users', [UserController::class, 'store']); 
    Route::put('/users/{id}', [UserController::class, 'update']); 
    Route::delete('/users/{id}', [UserController::class, 'destroy']); 
});
