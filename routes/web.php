<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main\UserController;
use App\Http\Controllers\main\HomeController;
use App\Http\Controllers\main\MessageController;

Route::prefix('/')->middleware('auth.custom')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::prefix('/staff')->middleware('admin')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('staff.index');
        Route::post('/', [UserController::class,'create'])->name('staff.create');
        Route::post('/update/{id?}', [UserController::class,'update'])->name('staff.update');
    });

    Route::prefix('/message')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('message');
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