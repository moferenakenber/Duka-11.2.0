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
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::get('/', function () {
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->role === 'Admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->role === 'Seller') {
                    return redirect()->route('seller.dashboard');
                }

                if ($user->role === 'Stock Keeper') {
                    return redirect()->route('stock_keeper.dashboard');
                }
                return view('visitor.home');
                //return redirect()->route('home'); // For users with no specific role
            }

            // For guests
            return view('welcome');
        })->name('home');



        // // Visitor route (Unauthenticated users)
        // Route::group(['middleware' => 'guest', 'as' => 'visitor.'], function () {
        //     Route::get('/', function () {
        //         return view('welcome');
        //     })->name('home');
        // });




        Route::group(['middleware' => ['auth', 'verified']], function (){

            // Admin routes group
            Route::group([
                'prefix' => 'admin',
                'middleware' => 'check_role:Admin',
                'as' => 'admin.',
            ], function(){

                Route::get('/dashboard', function () {
                    return view('dashboard');
                })->name('dashboard');

                Route::get('/test', function () {
                    return view('test');
                })->name('test');

                Route::get('/flowbite', function () {
                    return view('flowbite');
                })->name('flowbite');

                // Admin resource routes
                Route::resource('user_managements', UserManagementController::class);
                Route::resource('customers', CustomerController::class);
                Route::resource('items', ItemController::class);
                Route::resource('carts', CartController::class);
                Route::resource('products', ProductController::class);
                Route::resource('sales', SaleController::class);
                Route::resource('purchases', PurchaseController::class);

                // Cart routes
                Route::match(['get', 'post'], '/cart/{cart}/add', [CartController::class, 'addItem'])->name('cart.add');
            });

            // Seller routes group
            Route::group([
                'prefix' => 'seller',
                'middleware' => 'check_role:Seller',
                'as' => 'seller.',
            ], function(){

                Route::get('/dashboard', function () {
                    return view('seller.index');
                })->name('dashboard');
            });

            // Stock Keeper routes group
            Route::group([
                'prefix' => 'stock_keeper',
                'middleware' => 'check_role:Stock Keeper',
                'as' => 'stock_keeper.',
            ], function(){

                Route::get('/dashboard', function () {
                    return view('stock_keeper.index');
                })->name('dashboard');
            });

            // Visitor routes group
            // Route::group([
            //     'as' => 'visitor.',
            // ], function(){

            //     Route::get('/', function () {
            //         return view('welcome');
            //     })->name('home');
            // });

        });


    //      // Home
    //     Route::middleware('auth')->group(function () {
    //         Route::get('/', function () {return view('welcome');})->name('Home');

    // });




require __DIR__.'/auth.php';

