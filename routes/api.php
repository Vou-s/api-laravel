<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController; // <- tambahkan
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);
Route::post('/order', [OrderController::class, 'store']); // biar dua-duanya bisa

// Protected routes (JWT)
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'profile']); // alias baru
    Route::post('/logout', [AuthController::class, 'logout']);

    // Orders
    Route::get('orders', [OrderController::class, 'userOrders']);
    Route::post('order', [OrderController::class, 'store']);

    // Midtrans Payment
    Route::post('payment', [PaymentController::class, 'createTransaction']);
});
