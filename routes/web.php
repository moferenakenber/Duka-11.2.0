<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::get('/test', function () {
            return view('test');
        })->middleware(['auth', 'verified'])->name('test');

        Route::get('/flowbite', function () {
            return view('flowbite');
        })->middleware(['auth', 'verified'])->name('flowbite');


        Route::resource('customers', CustomerController::class)
            ->middleware(['auth', 'verified']);

            // Web route for user_management
        Route::resource('user_management', UserManagementController::class)
            ->middleware(['auth', 'verified']);

        Route::resource('product', ProductController::class)
             ->middleware(['auth', 'verified']);

        Route::resource('sale', SaleController::class)
             ->middleware(['auth', 'verified']);

        Route::resource('purchase', PurchaseController::class)
            ->middleware(['auth', 'verified']);


        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

require __DIR__.'/auth.php';

