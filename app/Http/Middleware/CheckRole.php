<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {
//         // $user = Auth::user();

//         // // Check if the user is authenticated
//         // if (!$user) {
//         //     return redirect('/login')->with('error', 'You need to be logged in!');
//         // }

//         // // Handle admin routes
//         // if ($user->role === 'admin') {
//         //     return $next($request); // Allow access for Admin
//         // }

//         // // Handle Seller and Stock Keeper roles
//         // if (in_array($user->role, ['Seller', 'stock_keeper'])) {
//         //     // Block access to admin routes (like items, carts, etc.)
//         //     $restrictedRoutes = [
//         //         'dashboard*', 'user_managements*', 'customers*',
//         //         'items*', 'carts*', 'products*', 'sales*', 'purchases*'
//         //     ];

//         //     foreach ($restrictedRoutes as $route) {
//         //         if ($request->is($route)) {
//         //             // Redirect based on role
//         //             if ($user->role === 'Seller') {
//         //                 return redirect()->route('seller')->with('error', 'You do not have access to this page.');
//         //             }
//         //             if ($user->role === 'stock_keeper') {
//         //                 return redirect()->route('stock_keeper')->with('error', 'You do not have access to this page.');
//         //             }
//         //         }
//         //     }
//         // }

//         // // Redirect Sellers to their dashboard if trying to access the Admin dashboard
//         // if ($user->role === 'Seller') {
//         //     return redirect()->route('seller'); // Redirect to the seller dashboard
//         // }

//         // // For Stock Keeper, always redirect to their own dashboard
//         // if ($user->role === 'Stock Keeper') {
//         //     return redirect()->route('stock_keeper');
//         // }












//         // $user = Auth::user();

//         // Log::info('CheckRole Middleware: User checked', ['user' => $user]);

//         // // If no user is authenticated, redirect to login
//         // if (!$user) {

//         //     Log::info('User not authenticated. Redirecting to login.');
//         //     return redirect()->route('login')->with('error', 'You need to be logged in!');
//         // }


//         // // Handle role checking
//         // $role = $user->role;

//         // Log::info("User role: {$role}");

//         // // Admin-specific routes (Only admins can access)
//         // if ($role === 'Admin') {
//         //     return $next($request); // Allow access for Admin
//         // }

//         // // Seller and Stock Keeper can access only their specific routes
//         // if (in_array($role, ['seller', 'stock_keeper'])) {
//         //     // Define routes restricted for non-admin roles
//         //     $restrictedRoutes = [
//         //         'admin/*', // Block any route starting with 'admin'
//         //         'user_managements*', 'customers*', 'items*', 'carts*', 'products*', 'sales*', 'purchases*'
//         //     ];

//         //     // Check if current route matches any of the restricted routes
//         //     foreach ($restrictedRoutes as $route) {
//         //         if ($request->is($route)) {

//         //            // Redirect based on role
//         //            if ($role === 'seller') {
//         //             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         //         }
//         //            if ($role === 'stock_keeper') {
//         //             return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
//         //         }

//         //         }
//         //     }
//         // }
//         // return $next($request);
//         // // For Seller role, redirect to their dashboard if trying to access Admin routes
//         // if ($role === 'Seller') {
//         //     return redirect()->route('seller.seller');
//         // }

//         // // For Stock Keeper, redirect to their dashboard if trying to access Admin routes
//         // if ($role === 'Stock Keeper') {
//         //     return redirect()->route('stock_keeper.stock_keeper');
//         // }


//         // // Handle admin routes
//         // if ($user->role === 'Admin') {
//         //     return $next($request); // Allow access for Admin
//         // }









//     }
// }
// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @param  string  $role
//      * @return \Symfony\Component\HttpFoundation\Response
//      */
//     public function handle(Request $request, Closure $next, $role): Response
//     {
//         $user = Auth::user();

//         // Log the user and role
//         Log::info('CheckRole Middleware: User checked', ['user' => $user]);

//         // If no user is authenticated, redirect to login
//         if (!$user) {
//             Log::info('User not authenticated. Redirecting to login.');
//             return redirect()->route('login')->with('error', 'You need to be logged in!');
//         }

//         // Check if the user has the correct role
//         if ($role === 'Admin' && $user->role !== 'Admin') {
//             Log::info('CheckRole Middleware: First if', ['user' => $user]);
//             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         if ($role === 'Seller' && !in_array($user->role, ['Seller', /*'Stock Keeper'*/])) {
//             Log::info('CheckRole Middleware: Second if', ['user' => $user]);
//             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         if ($role === 'Stock Keeper' && !in_array($user->role, ['Stock Keeper'])) {
//             Log::info('CheckRole Middleware: Third if', ['user' => $user]);
//             return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         return $next($request);
//     }
// }


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @param  string  $role
//      * @return \Symfony\Component\HttpFoundation\Response
//      */
//     public function handle(Request $request, Closure $next, $role): Response
//     {
//         $user = Auth::user();

//         // Check if the user is authenticated
//         if (!$user) {
//             Log::warning('Unauthenticated access attempt.');
//             return redirect()->route('login')->with('error', 'You need to be logged in!');
//         }

//         // Define role-to-route mappings
//         $roleRedirects = [
//             'Admin' => 'admin.dashboard',
//             'Seller' => 'seller.dashboard',
//             'Stock Keeper' => 'stock_keeper.dashboard',
//         ];

//         // Check if the user's role matches the required role
//         if ($user->role !== $role) {
//             Log::warning("Unauthorized access attempt by user: {$user->id}", ['required_role' => $role]);
//             return redirect()->route($roleRedirects[$user->role] ?? 'login')
//                              ->with('error', 'You do not have access to this page.');
//         }

//         return $next($request);
//     }
// }



// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// class CheckRole
// {
//     public function handle(Request $request, Closure $next, $role): Response
//     {
//         $user = Auth::user();

//         // Log user info
//         Log::info('User Info', ['user' => $user, 'role' => $role]);

//         // If no user is authenticated, redirect to login
//         if (!$user) {
//             Log::info('User not authenticated. Redirecting to login.');
//             return redirect()->route('login')->with('error', 'You need to be logged in!');
//         }

//         // Check role
//         // if ($role === 'Admin' && $user->role !== 'Admin') {
//         //     Log::info('Access denied: User role mismatch. Redirecting to seller dashboard.');
//         //     return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         // }

//         // if ($role === 'Seller' && !in_array($user->role, ['Seller', 'Stock Keeper'])) {
//         //     Log::info('Access denied: User role mismatch. Redirecting to seller dashboard.');
//         //     return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         // }

//         // if ($role === 'Stock Keeper' && !in_array($user->role, ['Stock Keeper'])) {
//         //     Log::info('Access denied: User role mismatch. Redirecting to stock keeper dashboard.');
//         //     return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
//         // }

//         if ($role === 'Admin' && $user->role !== 'Admin') {
//             Log::info('Admin check failed:', ['user_role' => $user->role, 'expected_role' => 'Admin']);
//             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         if ($role === 'Seller' && !in_array($user->role, ['Seller', 'Stock Keeper'])) {
//             Log::info('Seller check failed:', ['user_role' => $user->role, 'expected_roles' => ['Seller', 'Stock Keeper']]);
//             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         if ($role === 'Stock Keeper' && $user->role !== 'Stock Keeper') {
//             Log::info('Stock Keeper check failed:', ['user_role' => $user->role, 'expected_role' => 'Stock Keeper']);
//             return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         return $next($request);
//     }
// }

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// class CheckRole
// {
//     public function handle(Request $request, Closure $next, $role): Response
//     {
//         $user = Auth::user();

//         // Log user info
//         Log::info('User Info', ['user' => $user, 'role' => $role]);

//         // If no user is authenticated, redirect to login
//         if (!$user) {
//             Log::info('User not authenticated. Redirecting to login.');
//             return redirect()->route('login')->with('error', 'You need to be logged in!');
//         }

//         // Role check for Admin
//         if ($role === 'Admin' && $user->role !== 'Admin') {
//             Log::info('Access denied: User is not an Admin. Redirecting to seller dashboarda.');
//             Log::info('Role check', ['expected_role' => $role, 'actual_role' => $user->role]);
//             Log::info('Middleware role check:', ['role_from_route' => $role, 'user_role' => $user->role]);

//             return redirect()->route('admin.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         // Role check for Seller
//         if ($role === 'Seller' && $user->role !== 'Seller') {
//             Log::info('Access denied: User is not a Seller. Redirecting to seller dashboardb.');
//             Log::info('Role check', ['expected_role' => $role, 'actual_role' => $user->role]);
//             Log::info('Middleware role check:', ['role_from_route' => $role, 'user_role' => $user->role]);


//             return redirect()->route('seller.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         // Role check for Stock Keeper
//         if ($role === 'Stock Keeper' && $user->role !== 'Stock Keeper') {
//             Log::info('Access denied: User is not a Stock Keeper. Redirecting to stock keeper dashboardc.');
//             Log::info('Role check', ['expected_role' => $role, 'actual_role' => $user->role]);
//             Log::info('Middleware role check:', ['role_from_route' => $role, 'user_role' => $user->role]);

//             return redirect()->route('stock_keeper.dashboard')->with('error', 'You do not have access to this page.');
//         }

//         // If the user has the correct role, allow the request to proceed
//         return $next($request);
//     }
// }

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;

   class CheckRole
   {
        public function handle(Request $request, Closure $next, $role): Response
        {
            $user = Auth::user();

            // Log user info
            Log::info('User Info', ['user' => $user, 'role_from_route' => $role]);

            // If no user is authenticated, redirect to login
            if (!$user) {
                Log::info('User not authenticated. Redirecting to login.');
                return redirect()->route('login')->with('error', 'You need to be logged in!');
            }

            // Check if the authenticated user's role matches the expected role
            if ($user->role !== $role) {
                Log::info('Access denied: User role mismatch. Expected role: ' . $role . ', Actual role: ' . $user->role);

                // Redirect the user to their own dashboard based on their role
                if ($user->role === 'Admin') {
                    return redirect()->route('admin.dashboard'); // Admin dashboard
                }

                if ($user->role === 'Seller') {
                    session(['theme' => 'sellerandstock_keepertheme']);
                    Log::info('Session theme set:', ['theme' => session('theme')]);
                    session()->save(); // Explicitly save the session if necessary
                    return redirect()->route('seller.dashboard'); // Seller dashboard
                }

                if ($user->role === 'Stock Keeper') {
                    return redirect()->route('stock_keeper.dashboard'); // Stock keeper dashboard
                }

                // If no valid role is found, redirect to default Home
                return redirect()->route('home'); // Default Home
            }

            // If the user's role matches the required role, proceed with the request
            return $next($request);
        }
   }
