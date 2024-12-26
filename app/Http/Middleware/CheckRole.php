<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = Auth::user();

        // // Check if the user is authenticated
        // if (!$user) {
        //     return redirect('/login')->with('error', 'You need to be logged in!');
        // }

        // // Handle admin routes
        // if ($user->role === 'admin') {
        //     return $next($request); // Allow access for Admin
        // }

        // // Handle Seller and Stock Keeper roles
        // if (in_array($user->role, ['Seller', 'stock_keeper'])) {
        //     // Block access to admin routes (like items, carts, etc.)
        //     $restrictedRoutes = [
        //         'dashboard*', 'user_managements*', 'customers*',
        //         'items*', 'carts*', 'products*', 'sales*', 'purchases*'
        //     ];

        //     foreach ($restrictedRoutes as $route) {
        //         if ($request->is($route)) {
        //             // Redirect based on role
        //             if ($user->role === 'Seller') {
        //                 return redirect()->route('seller')->with('error', 'You do not have access to this page.');
        //             }
        //             if ($user->role === 'stock_keeper') {
        //                 return redirect()->route('stock_keeper')->with('error', 'You do not have access to this page.');
        //             }
        //         }
        //     }
        // }

        // // Redirect Sellers to their dashboard if trying to access the Admin dashboard
        // if ($user->role === 'Seller') {
        //     return redirect()->route('seller'); // Redirect to the seller dashboard
        // }

        // // For Stock Keeper, always redirect to their own dashboard
        // if ($user->role === 'Stock Keeper') {
        //     return redirect()->route('stock_keeper');
        // }


        $user = Auth::user();

        Log::info('CheckRole Middleware: User checked', ['user' => $user]);

        // If no user is authenticated, redirect to login
        if (!$user) {

            Log::info('User not authenticated. Redirecting to login.');
            return redirect()->route('login')->with('error', 'You need to be logged in!');
        }


        // Handle role checking
        $role = $user->role;

        Log::info("User role: {$role}");

        // Admin-specific routes (Only admins can access)
        if ($role === 'Admin') {
            return $next($request); // Allow access for Admin
        }

        // Seller and Stock Keeper can access only their specific routes
        if (in_array($role, ['Seller', 'Stock Keeper'])) {
            // Define routes restricted for non-admin roles
            $restrictedRoutes = [
                'admin/*', // Block any route starting with 'admin'
                'user_managements*', 'customers*', 'items*', 'carts*', 'products*', 'sales*', 'purchases*'
            ];

            // Check if current route matches any of the restricted routes
            foreach ($restrictedRoutes as $route) {
                if ($request->is($route)) {

                   // Redirect based on role
                   if ($role === 'seller') {
                    return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
                }
                   if ($role === 'stock_keeper') {
                    return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
                }

                }
            }
        }

        // // For Seller role, redirect to their dashboard if trying to access Admin routes
        // if ($role === 'Seller') {
        //     return redirect()->route('seller.seller');
        // }

        // // For Stock Keeper, redirect to their dashboard if trying to access Admin routes
        // if ($role === 'Stock Keeper') {
        //     return redirect()->route('stock_keeper.stock_keeper');
        // }


        // // Handle admin routes
        // if ($user->role === 'Admin') {
        //     return $next($request); // Allow access for Admin
        // }

        return $next($request);
    }
}
