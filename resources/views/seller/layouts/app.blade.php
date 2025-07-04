<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="retro">
    {{-- data-theme="light" --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">


    {{-- <!-- Sidebar -->
                @include('layouts.sidebar') --}}

    <!-- Main Content - p-4 exept the top - -->

    <main>
        <!-- Page Content -->
        @yield('content')
        @include('seller.layouts.navigation')
    </main>

{{-- Scripts go at the bottom of body --}}
@yield('scripts')
</body>

</html>
