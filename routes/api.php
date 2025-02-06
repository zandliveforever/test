<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/test-role', function () {
    return response()->json(['message' => 'Middleware exists!']);
})->middleware('role:admin');

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('/employees', EmployeeController::class);
    Route::resource('/companies', CompanyController::class);

    Route::middleware('role:admin')->group(function () {
        Route::post('/companies', [AdminController::class, 'storeCompany']);
        Route::post('/employees', [AdminController::class, 'storeEmployee']);
    });
});




