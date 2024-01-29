<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main\UserController;
use App\Http\Controllers\main\HomeController;
use App\Http\Controllers\main\CustomerController;
use App\Http\Controllers\main\BankController;
use App\Http\Controllers\main\MessageController;
use App\Http\Controllers\main\SupplierController;
use App\Http\Controllers\main\IngredientController;
use App\Http\Controllers\main\UnitController;
use App\Http\Controllers\main\FinishedProductController;

Route::prefix('/')->middleware('auth.custom')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    
    Route::prefix('/staff')->middleware('admin')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('staff.index');
        Route::post('/', [UserController::class,'create'])->name('staff.create');
        Route::post('/update/{id?}', [UserController::class,'update'])->name('staff.update');
    });

    Route::prefix('/customer')->group(function () {
        Route::get('/', [CustomerController::class,'index'])->name('customer.index');
        Route::post('/', [CustomerController::class,'create'])->name('customer.create');
        Route::post('/update/{id?}', [CustomerController::class,'update'])->name('customer.update');
    });

    Route::prefix('/bank')->group(function () {
        Route::get('/', [BankController::class,'index'])->name('bank.index');
        Route::post('/', [BankController::class,'create'])->name('bank.create');
        Route::post('/update/{id?}', [BankController::class,'update'])->name('bank.update');
    });

    Route::prefix('/supplier')->group(function () {
        Route::get('/', [SupplierController::class,'index'])->name('supplier.index');
        Route::post('/', [SupplierController::class,'create'])->name('supplier.create');
        Route::post('/update/{id?}', [SupplierController::class,'update'])->name('supplier.update');
    });

    Route::prefix('/ingredient')->group(function () {
        Route::get('/', [IngredientController::class,'index'])->name('ingredient.index');
        Route::post('/', [IngredientController::class,'create'])->name('ingredient.create');
        Route::post('/update/{id?}', [IngredientController::class,'update'])->name('ingredient.update');
    });

    Route::prefix('/unit')->group(function () {
        Route::get('/', [UnitController::class,'index'])->name('unit.index');
        Route::post('/', [UnitController::class,'create'])->name('unit.create');
        Route::post('/update/{id?}', [UnitController::class,'update'])->name('unit.update');
    });

    Route::prefix('/finished-product')->group(function () {
        Route::get('/', [FinishedProductController::class,'index'])->name('finished-product.index');
        Route::post('/', [FinishedProductController::class,'create'])->name('finished-product.create');
        Route::get('/{id}', [FinishedProductController::class,'show'])->name('finished-product.detail');
        Route::post('/update/{id?}', [FinishedProductController::class,'update'])->name('finished-product.update');
    });

    Route::prefix('/message')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('message');
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::get('/{username}', [UserController::class, 'profileUser'])->name('profile.user');
    });

    Route::prefix('/logout')->group(function () {
        Route::get('/', [UserController::class, 'logout'])->name('logout');
    });

});

Route::prefix('/login')->group(function () {
    Route::get('/', [UserController::class, 'loginPage'])->name('login');
    Route::post('/', [UserController::class, 'login'])->name('solve-login');
});

Route::prefix('/haizuka')->group(function () {
    Route::get('/', [HomeController::class, 'haizuka'])->name('haizuka');
});