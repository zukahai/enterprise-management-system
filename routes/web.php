<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main\UserController;
use App\Http\Controllers\main\HomeController;

Route::prefix('/')->middleware('auth.custom')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::prefix('/staff')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('staff.index');
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
    });

    Route::prefix('/logout')->group(function () {
        Route::get('/', [UserController::class, 'logout'])->name('logout');
    });

});

Route::prefix('/login')->group(function () {
    Route::get('/', [UserController::class, 'loginPage'])->name('login');
    Route::post('/', [UserController::class, 'login'])->name('solve-login');
});