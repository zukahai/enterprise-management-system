<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main\UserController;
use App\Http\Controllers\main\HomeController;

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('index');
    Route::get('/login', [HomeController::class,'index'])->name('login');
    Route::prefix('/staff')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('staff.index');
    });

});