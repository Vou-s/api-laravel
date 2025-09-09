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

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Route::get('/products', [ProductController::class, 'index']);

// // Biarkan hanya 1 endpoint orders (lebih konsisten pakai plural)
// Route::post('/orders', [OrderController::class, 'store']);
// Route::get('/orders', [OrderController::class, 'store']);


Route::apiResource('products', ProductController::class);
// Route::apiResource('orders', OrderController::class);

/*
|--------------------------------------------------------------------------
| Protected Routes (JWT)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function () {

    // User profile
    Route::get('/me', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'profile']); // alias

    Route::post('/logout', [AuthController::class, 'logout']);

    // Orders
    Route::apiResource('orders', OrderController::class);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    // Midtrans Payment
    Route::prefix('payments')->group(function () {
        Route::post('/', [PaymentController::class, 'createTransaction']);
    });
});
