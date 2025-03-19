<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

<<<<<<< Updated upstream
<<<<<<< Updated upstream
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index']);
});
=======
Route::middleware('auth:sanctum')->get('/employees', [EmployeeController::class, 'index']);
>>>>>>> Stashed changes
=======
Route::middleware('auth:sanctum')->get('/employees', [EmployeeController::class, 'index']);
>>>>>>> Stashed changes
