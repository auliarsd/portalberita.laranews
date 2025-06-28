<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;


// Auth
Route::get('/masuk', [AuthController::class, 'index'])->name('login');
Route::post('/masuk', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'cache']], function (){
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/profile', [DashboardController::class, 'profile']);
    Route::resource('/berita', NewsController::class);
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/profile', [DashboardController::class, 'profile']);
    Route::resource('/berita', NewsController::class);
});

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'cache', 'admin']], function (){
    Route::resource('/kategori', CategoryController::class);
    Route::resource('/penulis', UserController::class);
});

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{params}', [HomeController::class, 'detail'])->name('detail');
Route::get('/tentang-kami', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/hubungi-kami', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/kategori-berita/{params}', [HomeController::class, 'kategori'])->name('kategori');
Route::post('/komentar/{type}/{id}', [HomeController::class, 'komentar'])->name('komentar');
Route::post('/berita/search', [HomeController::class, 'search'])->name('search');
Route::get('/berita/search', [HomeController::class, 'search'])->name('search');



