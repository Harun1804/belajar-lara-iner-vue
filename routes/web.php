<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::controller(HomeController::class)->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
});

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginPage')->name('login.page');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'registerPage')->name('register.page');
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
