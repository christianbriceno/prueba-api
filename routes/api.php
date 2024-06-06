<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas Privadas
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('me', [AuthController::class, 'me'])->name('me');

    // Route::get('users-with-orders', [UserController::class, 'usersWithOrders'])->name('users-with-orders');
    // Route::get('products-that-a-user-has-purchased/{user}', [ProductController::class, 'productsThatAUserHasPurchased'])->name('products-that-a-user-has-purchased');
    // Route::get('products-of-an-order/{order}', [OrderController::class, 'productsOfAnOrder'])->name('products-of-an-order');

    Route::apiResource('users', UserController::class)->only(['index', 'show', 'store']);
    // Route::apiResource('product.order', OrderController::class);
    // Route::resource('products', ProductController::class)->except(['create', 'edit']);
    // Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class)->only(['index', 'show']);

// Rutas Públicas
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
