<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::resource('customers', CustomerController::class)
            ->middleware(['auth', 'verified']);

            // Web route for user_management
        Route::resource('user_management', UserManagementController::class)
            ->middleware(['auth', 'verified']);

        Route::resource('product', ProductController::class)
             ->middleware(['auth', 'verified']);


        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

require __DIR__.'/auth.php';

// Web route for produc
