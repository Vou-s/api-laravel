<?php

use Illuminate\Support\Facades\Route;


Route::resource('admin/categories', App\Http\Controllers\API\Admin\CategoriesAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.categories.index',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);


Route::resource('admin/sub-categories', App\Http\Controllers\API\Admin\SubCategoriesAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.subCategories.index',
        'store' => 'admin.subCategories.store',
        'show' => 'admin.subCategories.show',
        'update' => 'admin.subCategories.update',
        'destroy' => 'admin.subCategories.destroy'
    ]);

Route::resource('admin/products', App\Http\Controllers\API\Admin\ProductsAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.products.index',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]);

Route::resource('admin/users', App\Http\Controllers\API\Admin\UsersAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.users.index',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy'
    ]);

Route::resource('admin/orders', App\Http\Controllers\API\Admin\OrdersAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.orders.index',
        'store' => 'admin.orders.store',
        'show' => 'admin.orders.show',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy'
    ]);

Route::resource('admin/order_-items', App\Http\Controllers\API\Admin\Order_ItemsAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.orderItems.index',
        'store' => 'admin.orderItems.store',
        'show' => 'admin.orderItems.show',
        'update' => 'admin.orderItems.update',
        'destroy' => 'admin.orderItems.destroy'
    ]);

Route::resource('admin/payments', App\Http\Controllers\API\Admin\PaymentsAPIController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'admin.payments.index',
        'store' => 'admin.payments.store',
        'show' => 'admin.payments.show',
        'update' => 'admin.payments.update',
        'destroy' => 'admin.payments.destroy'
    ]);
