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
    <main class="min-h-screen overflow-y-auto p-4 sm:ml-64">
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

</body>

</html>
