<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main\UserController;

Route::prefix('/')->middleware('cors')->group(function () {
    Route::get('/', [UserController::class,'index'])->name('index');
    Route::get('/test', [UserController::class,'test'])->name('test');
});