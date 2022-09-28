<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserController as ControllersUserController;

// login and register page
Route::middleware(['admin_auth', 'user_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'redirectDashboard']);

    // admin
    Route::middleware('admin_auth')->group(function () {

        // admin account
        Route::prefix('admin')->group(function () {
            Route::get('password/changePage', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            Route::get('account/datails', [AdminController::class, 'details'])->name('admin#accountDetails');
            Route::get('account/editPage', [AdminController::class, 'editPage'])->name('admin#editPage');
            Route::post('account/edit/{id}', [AdminController::class, 'edit'])->name('admin#editAccount');
            // admin list and management
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('change/role', [AdminController::class, 'changeRole'])->name('admin#changeRole');
        });

        // category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('editPage/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // product
        Route::prefix('product')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('view/details/{id}', [ProductController::class, 'viewMore'])->name('product#view');
            Route::get('edit/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
            Route::post('edit', [ProductController::class, 'edit'])->name('product#edit');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
        });

        // order
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'orderList'])->name('order#list');
            Route::get('filter', [OrderController::class, 'orderFilter'])->name('order#filter');
            Route::get('details/{orderCode}', [OrderController::class, 'orderDetails'])->name('order#details');
            // Ajax
            Route::get('change/status', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
        });

        Route::prefix('users')->group(function () {
            Route::get('list', [ControllersUserController::class, 'userList'])->name('users#list');
            Route::get('change/role', [ControllersUserController::class, 'changeRole'])->name('users#changeRole');
            Route::get('contact', [ControllersUserController::class, 'feedbacks'])->name('users#contact');
            Route::get('delete/{id}', [ControllersUserController::class, 'deleteUser'])->name('users#delete');
        });
    });

    // user
    Route::middleware('user_auth')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('home', [UserController::class, 'home'])->name('user#home');
            Route::get('filter/category/{id}', [UserController::class, 'filter'])->name('user#categoryFilter');

            // user profile manage
            Route::get('profile', [UserController::class, 'editPage'])->name('user#editPage');
            Route::post('profile/edit/{id}', [UserController::class, 'edit'])->name('user#edit');
            Route::get('password/change', [UserController::class, 'passwordchangePage'])->name('user#passwordChangePage');
            Route::post('password/change', [UserController::class, 'changePassword'])->name('user#changePassword');

            // contact
            Route::get('contact', [ContactController::class, 'contactForm'])->name('user#contactForm');
            Route::post('contact', [ContactController::class, 'contact'])->name('user#contact');
        });

        // API
        Route::prefix('ajax')->group(function () {
            Route::get('pizzalist', [AjaxController::class, 'pizzaApi'])->name('ajax#pizzalist');
            Route::get('cart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('delete/row', [AjaxController::class, 'deleteRow'])->name('cart#deleteRow');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('view_count/increase', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        // Order
        Route::prefix('order')->group(function () {
            Route::get('history', [OrderController::class, 'history'])->name('order#history');
        });

        // Cart
        Route::prefix('cart')->group(function () {
            Route::get('list', [CartController::class, 'cartList'])->name('cart#list');
        });

        // product
        Route::prefix('product')->group(function () {
            Route::get('details/{id}/{category_id}', [UserController::class, 'details'])->name('product#details');
        });
    });
});


// Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
//     Route::get('home', [UserController::class, 'home'])->name('user#home');
// });
