<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;

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




        Route::resource('user_managements', UserManagementController::class)
            ->middleware(['auth', 'verified']);

        Route::resource('customers', CustomerController::class)
            ->middleware(['auth', 'verified']);

        Route::resource('items', ItemController::class)
            ->middleware(['auth', 'verified']);

        Route::resource('carts', CartController::class)
            ->middleware(['auth', 'verified']);

            // Route::post('cart/{itemId}/add', [CartController::class, 'addToCart'])->name('cart.add')->middleware(['auth', 'verified']);

        // Update your route to accept both GET and POST requests
        Route::match(['get', 'post'], '/cart/{cart}/add', [CartController::class, 'addItem'])->name('cart.add');


        Route::resource('products', ProductController::class)
             ->middleware(['auth', 'verified']);

        Route::resource('sales', SaleController::class)
             ->middleware(['auth', 'verified']);

        Route::resource('purchases', PurchaseController::class)
            ->middleware(['auth', 'verified']);


        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });


        // Route::middleware('CheckRole')->group(function () {
        //     Route::get('/seller/dashboard', function () {
        //         return view('seller.index');
        //     })->name('seller.dashboard');
        // });

        // Route::get('/seller/dashboard', function () {
        //     return view('seller.index');
        // })->name('seller.dashboard')->middleware(EnsureTokenIsValid::class);

        // Route::get('/seller/test', function () {
        //     return view('seller.test');
        // })->middleware(CheckRole::class);




require __DIR__.'/auth.php';

