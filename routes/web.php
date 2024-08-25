<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authentication'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'create'])->name('register');
});

Route::get('help', [PublicController::class, 'help'])->name('help');
Route::get('term', [PublicController::class, 'term'])->name('term');
Route::get('privacy-policy', [PublicController::class, 'privacy'])->name('privacy-policy');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        Route::get('profile', [UserController::class, 'index'])->name('profile');
        Route::post('profile', [UserController::class, 'update'])->name('profile');

        Route::get('product/category', [CategoryController::class, 'index'])->name('product/category');
        Route::post('product/category/create', [CategoryController::class, 'store'])->name('product/category/create');
        Route::get('product/category/{category}', [CategoryController::class, 'edit'])->name('product/category/edit');
        Route::put('product/category/{category}', [CategoryController::class, 'update'])->name('product/category/edit');
        Route::delete('product/category', [CategoryController::class, 'delete'])->name('product/category/delete');

        Route::get('product', [ProductController::class, 'index'])->name('product');
        Route::post('product/create', [ProductController::class, 'store'])->name('product/create');
        Route::get('product/detail/{product}', [ProductController::class, 'edit'])->name('product/edit');
        Route::put('product/detail/{product}', [ProductController::class, 'update'])->name('product/edit');
        Route::delete('product', [ProductController::class, 'delete'])->name('product/delete');

        Route::get('product/gallery', [GalleryController::class, 'index'])->name('product/gallery');
        Route::post('product/gallery/create', [GalleryController::class, 'store'])->name('product/gallery/create');
        Route::get('product/gallery/{gallery}', [GalleryController::class, 'edit'])->name('product/gallery/edit');
        Route::put('product/gallery/{gallery}', [GalleryController::class, 'update'])->name('product/gallery/edit');
        Route::delete('product/gallery', [GalleryController::class, 'delete'])->name('product/gallery/delete');

        Route::get('user',[UserController::class,'userShow'])->name('user/show');

        Route::get('report',[ReportController::class,'index'])->name('report/show');
        Route::get('showReport',[ReportController::class,'lihat'])->name('report/shows');
        Route::get('generate',[ReportController::class,'generate'])->name('report/download');

        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
        Route::put('transaction', [TransactionController::class, 'update'])->name('transaction');

        Route::get('chat', [ChatController::class, 'index'])->name('chat');
        Route::get('chat/{room}', [ChatController::class, 'show'])->name('chat/show');
        Route::post('chat/{room}/send', [ChatController::class, 'send'])->name('chat/send');
    });
});
