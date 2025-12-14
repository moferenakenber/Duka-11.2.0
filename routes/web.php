<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VariantController;
//use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\StockController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\CategoryController as SellerCategoryController;
use App\Http\Controllers\Seller\CustomerController as SellerCustomerController;
use App\Http\Controllers\Seller\ItemController as SellerItemController;
use App\Http\Controllers\Seller\CartController as SellerCartController;
use App\Http\Controllers\Seller\MenuController as SellerMenuController;
use App\Http\Controllers\Seller\SellerSettingsController;

use App\Http\Controllers\Stockkeeper\OrderController as StockkeeperOrderController;
use App\Http\Controllers\Stockkeeper\InventoryController as StockkeeperInventoryController;
use App\Http\Controllers\Stockkeeper\MenuController as StockkeeperMenuController;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\StoreController;



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

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


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

        // Session management routes
        Route::prefix('sessions')->group(function () {
            // List all sessions
            Route::get('/', [SessionController::class, 'index'])->name('sessions.index');

            // Delete a session to force logout
            Route::delete('/{id}', [SessionController::class, 'destroy'])->name('sessions.destroy');
        });


        // Admin resource routes
        Route::resource('users', UserController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('items', ItemController::class);
        Route::resource('stores', StoreController::class);

        // routes/web.php
        Route::get('stores/{store}/items', [StoreController::class, 'items'])
            ->name('stores.items');

        // Custom route for saving as draft
        Route::post('save-draft', [ItemController::class, 'saveDraft'])->name('saveDraft');

        Route::resource('carts', CartController::class);
        //Route::resource('products', ProductController::class);
        Route::resource('sales', SaleController::class);
        Route::resource('purchases', PurchaseController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('transfers', TransferController::class);
        // Upload images route

        Route::post('items/upload-images', [ItemController::class, 'uploadImages'])
            ->name('items.uploadImages');

        Route::patch('items/{item}/status', [ItemController::class, 'updateStatus'])
            ->name('items.updateStatus');


        // Prefix for all variant-related routes
        Route::prefix('variants')->group(function () {

            // List all items & variants (extra index)
            Route::get('/items', [VariantController::class, 'itemsIndex'])
                ->name('variants.items.index');

            // List variants for a specific item
            Route::get('/{item}', [VariantController::class, 'index'])
                ->name('variants.index');

            // Store variant for a specific item
            Route::post('/{item}', [VariantController::class, 'store'])
                ->name('variants.store');

            // Variant CRUD (except store) with proper route names
            Route::resource('variants/crud', VariantController::class)
                ->except(['store'])
                ->names([
                    'index' => 'variants.crud.index',
                    'create' => 'variants.crud.create',
                    'show' => 'variants.crud.show',
                    'edit' => 'variants.crud.edit',
                    'update' => 'variants.crud.update',
                    'destroy' => 'variants.crud.destroy',
                ]);


            // --- Add status update route ---
            Route::put('/{variant}/status', [VariantController::class, 'updateStatus'])
                ->name('variants.updateStatus');

            // Variant edit page
            Route::get('/{variant}/edit', [VariantController::class, 'edit'])
                ->name('variants.edit');

            // web.php
            Route::post('variants/upload-images', [VariantController::class, 'uploadImages'])->name('variants.uploadImages');

        });

        // Nested routes for store items & variants
        Route::prefix('stores/{store}/items')->name('stores.items.')->group(function () {

            // List all variants of a specific item in the store
            Route::get('{item}/variants', [StoreController::class, 'itemVariants'])
                ->name('variants');

            // Edit a specific variant of an item in the store
            Route::get('{item}/variants/{variant}/edit', [StoreController::class, 'editVariant'])
                ->name('variants.edit');

            // Update a specific variant of an item in the store
            Route::put('{item}/variants/{variant}', [StoreController::class, 'updateVariant'])
                ->name('variants.update');

        });

        // routes/web.php
        Route::get('stores/{store}/items/{item}/variants', [StoreController::class, 'itemVariants'])
            ->name('stores.items.variants');


        Route::match(['get', 'post'], '/cart/{cart}/add', [CartController::class, 'addItem'])->name('cart.add');

        Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])
            ->name('settings.index');

        Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])
            ->name('settings.update');
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
        Route::resource('categories', SellerCategoryController::class);
        Route::resource('customers', SellerCustomerController::class);
        Route::resource('items', SellerItemController::class);
        Route::resource('carts', SellerCartController::class);
        Route::resource('menu', SellerMenuController::class);
        Route::post('/cart/add', [SellerCartController::class, 'add'])->name('cart.add');

        // In your routes:
        Route::get('/settings', [SellerSettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SellerSettingsController::class, 'update'])->name('settings.update');


    });

    // Stock Keeper routes group
    Route::group([
        'prefix' => 'stock_keeper',
        'middleware' => 'check_role:Stock Keeper',
        'as' => 'stock_keeper.',
    ], function () {

        Route::get('/dashboard', function () {
            return view('stock_keeper.orders.index');
        })->name('dashboard');

        Route::resource('orders', StockkeeperOrderController::class);
        Route::resource('inventory', StockkeeperInventoryController::class);
        Route::resource('menu', StockkeeperMenuController::class);
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

