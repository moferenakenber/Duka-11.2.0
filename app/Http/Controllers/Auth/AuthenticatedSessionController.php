<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     //return redirect()->intended(route('admin.dashboard', absolute: false));


    //     // // Get the authenticated user
    //     $user = auth()->user();

    //     // Check user role and redirect accordingly
    //     if ($user->role === 'Admim') {
    //         return redirect()->route('admin.dashboard'); // Admin dashboard route
    //     }

    //     if ($user->role === 'Seller') {
    //         return redirect()->route('seller.dashboard'); // Seller dashboard route
    //     }

    //     if ($user->role === 'Stock Keeper') {
    //         return redirect()->route('stock_keeper.dashboard'); // Stock keeper dashboard route
    //     }

    //     // Default redirect if no role matches
    //     return redirect()->intended(route('admin.dashboard', absolute: false));

    // }
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    // Get the authenticated user
    $user = auth()->user();

    // Log the authenticated user's role
    Log::info('User authenticated', ['user' => $user]);
    Log::info('User role after login:', ['role' => auth()->user()->role]);


    // Check user role and redirect accordingly
    if ($user->role === 'Admin') {
        Log::info('Redirecting user to Admin dashboard', ['user_role' => $user->role]);
        return redirect()->route('admin.dashboard'); // Admin dashboard route
    }

    if ($user->role === 'Seller') {
        Log::info('Redirecting user to Seller dashboard', ['user_role' => $user->role]);
        return redirect()->route('seller.dashboard'); // Seller dashboard route
    }

    if ($user->role === 'Stock Keeper') {
        Log::info('Redirecting user to Stock Keeper dashboard', ['user_role' => $user->role]);
        return redirect()->route('stock_keeper.dashboard'); // Stock keeper dashboard route
    }

    // Default redirect if no role matches
    Log::warning('No role matched, redirecting to default dashboard', ['user_role' => $user->role]);
    return redirect()->intended(route('admin.dashboard', absolute: false));
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        //Auth::guard('web')->logout();
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
