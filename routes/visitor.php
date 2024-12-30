<?php

use App\Http\Controllers\Visitor\VisitorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::group(['middleware' => 'guest', 'as' => 'visitor.'], function () {
    //Route::group(['as' => 'visitor.'], function () {
        // Homepage for visitors
        Route::get('/', [VisitorController::class, 'index'])->name('home');

        // Show specific item for visitors
        Route::get('/{id}', [VisitorController::class, 'show'])->name('show');

        // Create item (if applicable)
        Route::get('/create', [VisitorController::class, 'create'])->name('create');

        // Store item (if applicable)
        Route::post('/', [VisitorController::class, 'store'])->name('store');

        // Edit item (if applicable)
        Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit');

        // Update item (if applicable)
        Route::put('/{id}', [VisitorController::class, 'update'])->name('update');

        // Destroy item (if applicable)
        Route::delete('/{id}', [VisitorController::class, 'destroy'])->name('destroy');

        // Cart routes for visitors
        Route::get('/cart', [VisitorController::class, 'showCart'])->name('cart');
        Route::post('/cart/{itemId}/add', [VisitorController::class, 'addToCart'])->name('cart.add');
        Route::delete('/cart/{itemId}', [VisitorController::class, 'removeFromCart'])->name('cart.remove');
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

            if ($user->role === 'User') {
                return redirect()->route('user.home'); //
            }
        }
        // For Visitors
        return view('visitor.home');
    })->name('home');
