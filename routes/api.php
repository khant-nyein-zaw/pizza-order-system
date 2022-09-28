<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GET
Route::get('products', [RouteController::class, 'products']);
Route::get('categories', [RouteController::class, 'categories']);
Route::get('users', [RouteController::class, 'users']);
Route::get('contacts', [RouteController::class, 'contacts']);
Route::get('orders', [RouteController::class, 'orders']);
Route::get('order/list', [RouteController::class, 'orderList']);

// Details
Route::get('categories/{id}', [RouteController::class, 'categoryDetails']);
Route::get('products/{id}', [RouteController::class, 'productDetails']);
Route::get('users/{id}', [RouteController::class, 'userDetails']);

// POST
// CREATE
Route::post('create/category', [RouteController::class, 'createCategory']);
// Route::post('create/product', [RouteController::class, 'createProduct']);

// UPDATE
Route::post('category/update', [RouteController::class, 'updateCategory']);

// DELETE
Route::get('product/delete/{id}', [RouteController::class, 'deleteProduct']);
Route::get('category/delete/{id}', [RouteController::class, 'deleteCategory']);
