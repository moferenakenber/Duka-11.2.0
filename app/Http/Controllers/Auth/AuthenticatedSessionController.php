<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


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
        $remember = $request->boolean('remember');

        Log::info('Login form submitted', [
            'email' => $request->input('email'),
            'remember_input' => $request->input('remember'), // raw input
            'remember_boolean' => $remember,               // converted to boolean
        ]);

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $request->session()->regenerate();

            session(['remember_me' => $remember]);
            session()->save();

            $user = auth()->user();
            Log::info('User authenticated', [
                'user_id' => $user->id,
                'email' => $user->email,
                'remember_requested' => $remember,
                'session_id' => session()->getId()
            ]);

            return match ($user->role) {
                'Admin' => redirect()->route('admin.dashboard'),
                'Seller' => redirect()->route('seller.dashboard'),
                'Stock Keeper' => redirect()->route('stock_keeper.dashboard'),
                default => redirect()->intended('/'),
            };
        }

        Log::warning('Login failed', ['email' => $request->input('email')]);
        return back()->withErrors(['email' => 'Invalid credentials']);
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
