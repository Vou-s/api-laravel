<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Public products (bisa dilihat tanpa login)
Route::apiResource('products', ProductController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Protected Routes (JWT)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function () {

    // Profile & logout
    Route::get('/me', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'profile']); // alias
    Route::post('/logout', [AuthController::class, 'logout']);

    // Orders
    // Semua endpoint orders sekarang protected
    Route::apiResource('orders', OrderController::class);

    // Midtrans Payment
    Route::prefix('payments')->group(function () {
        Route::post('/', [PaymentController::class, 'createTransaction']);
    });
});
