<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;



Route::resource('products', App\Http\Controllers\API\ProductsAPIController::class)
    ->except(['create', 'edit']);


Route::resource('sub-categories', App\Http\Controllers\API\SubCategoriesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('categories', App\Http\Controllers\API\CategoriesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('users', App\Http\Controllers\API\UsersAPIController::class)
    ->except(['create', 'edit']);

Route::resource('products', App\Http\Controllers\API\ProductsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('orders', App\Http\Controllers\API\OrdersAPIController::class)
    ->except(['create', 'edit']);

Route::resource('midtrans', App\Http\Controllers\API\MidtransAPIController::class)
    ->except(['create', 'edit']);

Route::resource('auths', App\Http\Controllers\API\AuthsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payments', App\Http\Controllers\API\PaymentsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order_-items', App\Http\Controllers\API\Order_ItemsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('sub-categories', App\Http\Controllers\API\SubCategoryAPIController::class)
    ->except(['create', 'edit']);