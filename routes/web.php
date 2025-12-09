<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sub-categories', App\Http\Controllers\SubCategoriesController::class);
Route::resource('categories', App\Http\Controllers\CategoriesController::class);
Route::resource('users', App\Http\Controllers\UsersController::class);
Route::resource('orders', App\Http\Controllers\OrdersController::class);
Route::resource('products', App\Http\Controllers\ProductsController::class);
Route::resource('midtrans', App\Http\Controllers\MidtransController::class);
Route::resource('auths', App\Http\Controllers\AuthsController::class);
Route::resource('payments', App\Http\Controllers\PaymentsController::class);
Route::resource('order_-items', App\Http\Controllers\Order_ItemsController::class);