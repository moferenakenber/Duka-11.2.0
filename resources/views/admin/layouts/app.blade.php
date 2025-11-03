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
    <main class="min-h-screen p-4 overflow-y-auto sm:ml-64">
      <div class="min-h-screen p-2 mt-16 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <!-- Page Heading -->
        @isset($header)
          <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-4 mx-auto max-w-7xl sm:px-4 lg:px-6">
              {{ $header }}
            </div>
          </header>
        @endisset

        <!-- Page Content -->

        {{ $slot }}
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </body>
</html>
