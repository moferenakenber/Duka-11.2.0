<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('admin.layouts.navigation')
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <main class="ml-0 min-h-screen overflow-y-auto p-4 transition-all duration-300 md:ml-0 xl:ml-64">
        <div class="dark:border-gray-700 mt-16 min-h-screen rounded-lg border-2 border-dashed border-gray-200 p-2">
            <!-- Page Heading -->
            @isset($header)
                <header class="dark:bg-gray-800 bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-4 lg:px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->

            {{ $slot }}
        </div>
    </main>

    {{-- <main class="min-h-screen p-4 overflow-y-auto sm:ml-64">
        {{ $slot }}
    </main> --}}

    <!-- Mobile bottom nav -->
    {{-- <div
        class="fixed bottom-0 left-0 z-50 flex items-center justify-around block w-full h-16 bg-white border-t dark:bg-gray-800 dark:border-gray-700 xl:hidden">

        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'text-orange-500' : 'text-gray-500' }} flex flex-col items-center justify-center">
            <x-lucide-layout-dashboard class="size-[1.2em]" />
            <span class="text-xs">Home</span>
        </a>

        <a href="{{ route('admin.items.index') }}"
            class="{{ request()->routeIs('admin.items.*') ? 'text-orange-500' : 'text-gray-500' }} flex flex-col items-center justify-center">
            <x-lucide-box class="size-[1.2em]" />
            <span class="text-xs">Items</span>
        </a>

        <a href="{{ route('admin.customers.index') }}"
            class="{{ request()->routeIs('admin.customers.*') ? 'text-orange-500' : 'text-gray-500' }} flex flex-col items-center justify-center">
            <x-lucide-users class="size-[1.2em]" />
            <span class="text-xs">Customers</span>
        </a>

        <a href="{{ route('admin.carts.index') }}"
            class="{{ request()->routeIs('admin.carts.*') ? 'text-orange-500' : 'text-gray-500' }} flex flex-col items-center justify-center">
            <x-lucide-shopping-cart class="size-[1.2em]" />
            <span class="text-xs">Carts</span>
        </a>

    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

</body>

</html>
