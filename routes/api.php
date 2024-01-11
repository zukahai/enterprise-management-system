<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RoleController;

Route::prefix('/v1')->middleware('api')->group(function () {

    Route::prefix('/roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });
});