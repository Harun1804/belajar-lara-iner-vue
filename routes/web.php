<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
});

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginPage')->name('login.page');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'registerPage')->name('register.page');
    Route::post('/register', 'register')->name('register');
});
