<?php

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

Route::get('users-with-orders', [UserController::class, 'usersWithOrders'])->name('users-with-orders');
Route::get('products-that-a-user-has-purchased/{user}', [ProductController::class, 'productsThatAUserHasPurchased'])->name('products-that-a-user-has-purchased');
Route::get('products-of-an-order/{order}', [OrderController::class, 'productsOfAnOrder'])->name('products-of-an-order');

Route::resource('users', UserController::class)->only(['index', 'show', 'store']);
Route::resource('products', ProductController::class)->except(['create', 'edit']);
Route::resource('orders', OrderController::class)->only(['index', 'show']);
