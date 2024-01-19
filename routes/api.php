<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\UserController;

Route::prefix('/v1')->middleware('api')->group(function () {

    Route::prefix('/roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('api.roles.index');
        Route::post('/', [RoleController::class, 'store'])->name('api.roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('api.roles.show');
        Route::put('/{id}', [RoleController::class, 'update'])->name('api.roles.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::prefix('/account')->group(function () {
        Route::post('/register', [UserController::class, 'register'])->name('api.account.register');
        Route::post('/login', [UserController::class, 'login'])->name('api.account.login');
        Route::get('/login', [UserController::class, 'viewLogin'])->name('api.login');
        Route::middleware(['auth:sanctum'])->get('/checkToken', [UserController::class, 'checkToken']);
        Route::get('/', [UserController::class, 'index'])->middleware(['auth:sanctum'])->name('api.account.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('api.account.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('api.account.update');
        Route::put('/changePassword/{id}', [UserController::class, 'changePassword'])->name('api.account.changePassword');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum'])->name('api.account.destroy');
    });

    Route::get('/test', [UserController::class, 'test'])->name('api.test');
});