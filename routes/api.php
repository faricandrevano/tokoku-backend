<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/password', [AuthController::class, 'password']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile', [UserController::class, 'update']);
});

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);

Route::group(['middleware' => 'api'], function () {
    Route::get('/cart', [CartController::class, 'read']);
    Route::post('/cart', [CartController::class, 'create']);
    Route::delete('/cart', [CartController::class, 'delete']);
    Route::post('/cart/increment', [CartController::class, 'increment']);
    Route::post('/cart/decrement', [CartController::class, 'decrement']);

    Route::get('/favorite', [FavoriteController::class, 'read']);
    Route::post('/favorite', [FavoriteController::class, 'action']);
    Route::get('/favorite/check', [FavoriteController::class, 'check']);

    Route::get('/transaction', [TransactionController::class, 'read']);
    Route::post('/transaction', [TransactionController::class, 'create']);

    Route::get('/chat', [ChatController::class, 'room']);
    Route::post('/chat', [ChatController::class, 'create']);
    Route::get('/chat/{id}', [ChatController::class, 'chat']);
    Route::post('/chat/{id}', [ChatController::class, 'send']);
});
