<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route API project ada di sini.
| Prefix default = /api
*/

// ===================
// 🔓 Public Routes
// ===================
Route::get('/products', [ProductController::class, 'index']);

// ===================
// 🔐 Auth Routes (JWT)
// ===================
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

// ===================
// 🔐 Protected Routes
// ===================
Route::middleware('auth:api')->group(function () {
    // Users
    Route::apiResource('users', UserController::class);

    // Products (kecuali index, karena sudah public)
    Route::apiResource('products', ProductController::class)->except(['index']);

    // Orders
    Route::apiResource('orders', OrderController::class);

    // Order Items
    Route::apiResource('order-items', OrderItemController::class);

    // Payments
    Route::apiResource('payments', PaymentController::class);

    // ✅ Midtrans Snap Token
    Route::post('/midtrans/token', [PaymentController::class, 'getSnapToken']);

    // Generate Snap token
    Route::get('payments/snap-token', [PaymentController::class, 'getSnapToken']);
});


// ===================
// 🔄 Midtrans Callback
// ===================
// ⚠️ Tidak boleh pakai JWT, dipanggil langsung oleh Midtrans server
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
// Route::post('/midtrans/token/{orderId}', [PaymentController::class, 'getSnapToken']);
