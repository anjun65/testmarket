<?php

use App\Http\Controllers\API\BannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\API\LocationController;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\TotalCartController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('transactions', [TransactionController::class, 'all']);
    Route::post('checkout', [TransactionController::class, 'checkout']);
});

Route::post('totalcart', [TotalCartController::class, 'totalCart'])->name('api-total-cart');

Route::get('banners', [BannerController::class, 'all']);
Route::get('products', [ProductController::class, 'all']);
Route::get('categories', [ProductCategoryController::class, 'all']);

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('register/check', [RegisterController::class, 'check'])->name('api-register-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('api-regencies');