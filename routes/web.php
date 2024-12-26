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

        // Route::middleware(['auth', 'verified'])->group(function () {

        //     // Admin routes (only accessible to admins)
        //     Route::middleware(['check_role:admin'])->group(function () {

                // Route::get('/', function () {
                //     return view('welcome');
                // });

                // Route::get('/dashboard', function () {
                //     return view('dashboard');
                // })->name('dashboard');

                // Route::get('/test', function () {
                //     return view('test');
                // })->name('test');

                // Route::get('/flowbite', function () {
                //     return view('flowbite');
                // })->name('flowbite');

                // // Admin resource routes
                // Route::resource('user_managements', UserManagementController::class);
                // Route::resource('customers', CustomerController::class);
                // Route::resource('items', ItemController::class);
                // Route::resource('carts', CartController::class);
                // Route::resource('products', ProductController::class);
                // Route::resource('sales', SaleController::class);
                // Route::resource('purchases', PurchaseController::class);

                // // Cart routes
                // Route::match(['get', 'post'], '/cart/{cart}/add', [CartController::class, 'addItem'])->name('cart.add');
        //     });




        //     // Seller routes (restricted to sellers)
        //     Route::middleware(['check_role:Seller'])->group(function () {
                // Route::get('/seller', function () {
                //     return view('seller.index');
                // })->name('seller');
        //     });





        //     // Stock Keeper routes (restricted to stock keepers)
        //     Route::middleware(['check_role:stock_keeper'])->group(function () {
                // Route::get('/stock-keeper', function () {
                //     return view('stock_keeper.index');
                // })->name('stock_keeper');
        //     });

        // });
        Route::get('/', function () {
                           return view('welcome');
                        });


        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });






        Route::group(['middleware' => ['auth', 'verified']], function (){

            Route::group([
                'prefix' => 'admin',
                'middleware' => 'check_role:Admin',
                'as' => 'admin.',
            ], function(){


                // Route::get('/', function () {
                //     return view('welcome');
                // });

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




            Route::group([
                'prefix' => 'seller',
                'middleware' => CheckRole::class.':Seller',
                'as' => 'seller.',
            ], function(){
                Route::get('/seller', function () {
                    return view('seller/index');
                })->name('dashboard');
            });

            Route::group([
                'prefix' => 'stock_keeper',
                'middleware' => 'check_role:stock_keeper',
                'as' => 'stock_keeper.',
            ], function(){
                Route::get('/stock-keeper', function () {
                    return view('stock_keeper.index');
                })->name('dashboard');
            });

        });



require __DIR__.'/auth.php';

