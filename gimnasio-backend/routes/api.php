<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ScheduleController;

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas con JWT
Route::middleware('auth:api')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // CRUDs
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('schedules', ScheduleController::class);

    // Ruta de ejemplo para obtener usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});