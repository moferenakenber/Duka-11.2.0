<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ProfileController;
//use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\CustomerController as SellerCustomerController;
use App\Http\Controllers\Seller\ItemController as SellerItemController;
use App\Http\Controllers\Seller\CartController as SellerCartController;

use App\Http\Controllers\Stockkeeper\ItemController as StockkeeperItemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'verified']], function () {

    // Admin routes group
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'check_role:Admin',
        'as' => 'admin.',
    ], function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/test', function () {
            return view('test');
        })->name('test');

        Route::get('/alpine', function () {
            return view('alpine');
        });

        Route::get('/daisyui', function () {
            return view('daisyui');
        })->name('daisyui');


        Route::get('/fullhtml', function () {
            return view('fullhtml');
        })->name('fullhtml');



        Route::get('/flowbite', function () {
            return view('flowbite');
        })->name('flowbite');

        // Admin resource routes
        Route::resource('users', UserController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('items', ItemController::class);
        // Custom route for saving as draft
        Route::post('save-draft', [ItemController::class, 'saveDraft'])->name('saveDraft');

        Route::resource('carts', CartController::class);
        //Route::resource('products', ProductController::class);
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
    ], function () {

        // Route::get('/dashboard', function () {
        //     // Set the theme for the seller role in the session
        //     session(['theme' => 'sellerandstock_keepertheme']);
        //     session()->save(); // Explicitly save the session if necessary
        //     return view('seller.items.index');
        // })->name('dashboard');

        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('customers', SellerCustomerController::class);
        Route::resource('items', SellerItemController::class);
        Route::resource('carts', SellerCartController::class);

    });

    // Stock Keeper routes group
    Route::group([
        'prefix' => 'stock_keeper',
        'middleware' => 'check_role:Stock Keeper',
        'as' => 'stock_keeper.',
    ], function () {

        Route::get('/dashboard', function () {
            return view('stock_keeper.items.index');
        })->name('dashboard');

        Route::resource('items', StockkeeperItemController::class);
    });

    // // User routes group
    Route::group([
        'prefix' => 'user',
        'middleware' => 'check_role:User',
        'as' => 'user.',
    ], function () {

        Route::get('/home', function () {
            return view('user.home.index');
        })->name('home');

        //Route::resource('items', StockkeeperItemController::class);
    });

    // User routes group
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


require __DIR__ . '/auth.php';


// Include visitor routes before authentication checks
require __DIR__ . '/visitor.php';

