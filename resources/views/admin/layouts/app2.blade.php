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
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <div class="flex flex-1 flex-col">
          @include('admin.layouts.navigation')
          <!-- Main Content -->
          <div class="flex-1 flex flex-col">
            <!-- Page Heading -->
            @isset($header)
              <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                  {{ $header }}
                </div>
              </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-4">
              {{ $slot }}
            </main>
          </div>
        </div>
      </div>
    </div>
  </body>

  <footer class="footer bg-base-200 text-base-content p-10">
    <aside>
      <svg
        width="50"
        height="50"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        fill-rule="evenodd"
        clip-rule="evenodd"
        class="fill-current"
      >
        <path
          d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"
        ></path>
      </svg>
      <p>
        ACME Industries Ltd.
        <br />
        Providing reliable tech since 1992
      </p>
    </aside>
    <nav>
      <h6 class="footer-title">Services</h6>
      <a class="link link-hover">Branding</a>
      <a class="link link-hover">Design</a>
      <a class="link link-hover">Marketing</a>
      <a class="link link-hover">Advertisement</a>
    </nav>
    <nav>
      <h6 class="footer-title">Company</h6>
      <a class="link link-hover">About us</a>
      <a class="link link-hover">Contact</a>
      <a class="link link-hover">Jobs</a>
      <a class="link link-hover">Press kit</a>
    </nav>
    <nav>
      <h6 class="footer-title">Legal</h6>
      <a class="link link-hover">Terms of use</a>
      <a class="link link-hover">Privacy policy</a>
      <a class="link link-hover">Cookie policy</a>
    </nav>
  </footer>
</html>

{{--
  <div class="min-h-screen flex">
  <!-- Sidebar -->
  @include('layouts.sidebar')
  
  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
  <!-- Top Navigation -->
  @include('layouts.navigation')
  
  <!-- Page Heading -->
  @isset($header)
  <header class="bg-white dark:bg-gray-800 shadow">
  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  {{ $header }}
  </div>
  </header>
  @endisset
  
  <!-- Page Content -->
  <main class="flex-1 p-4">
  {{ $slot }}
  </main>
  </div>
  </div>
--}}

{{--
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
  
  @include('layouts.navigation')
  
  <!-- Page Heading -->
  @isset($header)
  <header class="bg-white dark:bg-gray-800 shadow">
  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  {{ $header }}
  </div>
  </header>
  @endisset
  
  <!-- Page Content -->
  <main>
  {{ $slot }}
  {{--@yield('content') <!-- Fallback for views that don't pass content through $slot -->
  </main>
  </div>
--}}
