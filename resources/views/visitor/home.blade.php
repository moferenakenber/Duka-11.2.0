<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ request()->routeIs(['seller.dashboard', 'user.profile']) ? '' : 'dark' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mezgebe Dirijit - Best Online Solution for Business Management</title>
    <meta name="description"
        content="Your one-stop platform for innovative POS systems, efficient inventory management, and seamless sales tracking. Explore our comprehensive tools, shop, and enjoy exceptional service designed to simplify your business operations.">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Mezgebedirijit - Best Online Solution for Business Management">
    <meta property="og:description"
        content="one-stop platform for quality and convenience, offering advanced POS systems, streamlined inventory management tools, and comprehensive sales tracking solutions..">
    <meta property="og:image" content="https://mezgebedirijit.com/images/social-share.jpg">
    <meta property="og:url" content="https://mezgebedirijit.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mezgebe Dirijit - Best Online Solution for Business Management">
    <meta name="twitter:description"
        content="One-stop platform for quality and convenience, offering advanced POS systems, streamlined inventory management tools, and comprehensive sales tracking solutions..">
    <meta name="twitter:image" content="https://mezgebedirijit.com/images/social-share.jpg">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Mezgebedirijit - Best Online Solution for Business Management",
      "description": "One-stop platform for quality and convenience, offering advanced POS systems, streamlined inventory management tools, and comprehensive sales tracking solutions..",
      "url": "https://mezgebedirijit.com",
      "publisher": {
        "@type": "Organization",
        "name": "Mezgebedirijit",
        "logo": {
          "@type": "ImageObject",
          "url": "https://mezgebedirijit.com/images/logo.jpg"
        }
      }
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<nav class="antialiased bg-white dark:bg-gray-800">
    <div class="max-w-screen-xl px-4 py-4 mx-auto 2xl:px-0">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="shrink-0">
                    <a href="#" title="" class="flex items-center">
                        <img class="block w-auto h-8 dark:hidden" src="..." alt=""> {{-- src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" --}}
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Mezgebe
                            Dirijit</span>
                    </a>
                </div>

                <ul class="items-center justify-start hidden gap-6 py-3 ml-auto lg:flex md:gap-8 sm:justify-center">
                    <li>
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Home
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Best Sellers
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Gift Ideas
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Today's Deals
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Sell
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center lg:space-x-2">

                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button"
                    class="inline-flex items-center justify-center p-2 text-sm font-medium leading-none text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white">
                    <span class="sr-only">
                        Cart
                    </span>
                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    <span class="hidden sm:flex">My Cart</span>
                    <svg class="hidden w-4 h-4 text-gray-900 sm:flex dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="myCartDropdown1"
                    class="z-10 hidden max-w-sm p-4 mx-auto space-y-4 overflow-hidden antialiased bg-white rounded-lg shadow-lg dark:bg-gray-800">


                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="text-sm font-semibold leading-none text-gray-900 truncate dark:text-white hover:underline">
                                Explore</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">Cart
                                empty</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            {{-- <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>

                            <button data-tooltip-target="tooltipRemoveItem1a" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem1a" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div> --}}
                        </div>
                    </div>


                    {{--

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="text-sm font-semibold leading-none text-gray-900 truncate dark:text-white hover:underline">Apple
                                iPad Air</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$499</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>

                            <button data-tooltip-target="tooltipRemoveItem2a" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem2a" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="text-sm font-semibold leading-none text-gray-900 truncate dark:text-white hover:underline">Apple
                                Watch SE</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$598</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 2</p>

                            <button data-tooltip-target="tooltipRemoveItem3b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem3b" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="text-sm font-semibold leading-none text-gray-900 truncate dark:text-white hover:underline">Sony
                                Playstation 5</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$799</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>

                            <button data-tooltip-target="tooltipRemoveItem4b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem4b" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="text-sm font-semibold leading-none text-gray-900 truncate dark:text-white hover:underline">Apple
                                iMac 20"</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$8,997</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 3</p>

                            <button data-tooltip-target="tooltipRemoveItem5b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem5b" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    --}}

                    <a href="#" title=""
                        class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        role="button"> Proceed to Checkout
                    </a>
                </div>



                <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                    class="inline-flex items-center justify-center p-2 text-sm font-medium leading-none text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white">
                    <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Account
                    <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="userDropdown1"
                    class="z-10 hidden w-56 overflow-hidden overflow-y-auto antialiased bg-white divide-y divide-gray-100 rounded-lg shadow dark:divide-gray-600 dark:bg-gray-700">
                    <ul class="p-2 text-sm font-medium text-gray-900 text-start dark:text-white">
                        <li><a href="#" title=""
                                class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                Favourites </a></li>

                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ url('/dashboard') }}" title=""
                                        class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Dashboard </a></li>



                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">Sign
                                        out</button>
                                </form>
                            @else
                                <li><a href="{{ route('login') }}" title=""
                                        class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Log in </a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" title=""
                                            class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Register </a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>

                </div>



                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
                    aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                    class="inline-flex items-center justify-center p-2 text-gray-900 rounded-md lg:hidden hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white">
                    <span class="sr-only">
                        Open Menu
                    </span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="ecommerce-navbar-menu-1"
            class="hidden px-4 py-3 mt-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <ul class="space-y-3 text-sm font-medium text-gray-900 dark:text-white">
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home</a>
                </li>
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Best Sellers</a>
                </li>
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Gift Ideas</a>
                </li>
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Games</a>
                </li>
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Electronics</a>
                </li>
                <li>
                    <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home & Garden</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<body class="text-gray-900 font-figtree bg-gray-50 dark:bg-black dark:text-white">

    <!-- Header Section -->

    <!-- Main Section -->

    <main class="px-4 pt-24 pb-12 sm:px-6 lg:px-8">

        <section class="bg-white dark:bg-gray-900">
            <div class="items-center max-w-screen-xl gap-16 px-4 py-8 mx-auto lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">We Didn't
                        Just Create a System</h2>
                    <p class="mb-4">We are experts in inventory management, sales tracking, and seamless POS
                        solutions. Problem solvers driven by innovation. Agile enough to adapt to your business needs
                        quickly, yet robust enough to deliver comprehensive solutions at scale.</p>
                    <p>Our mission is to empower businesses with tools that simplify operations and drive growth
                        efficiently.</p>

                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <img class="w-full rounded-lg" src="{{ asset('images/homepage/office-long-1.png') }}"
                        alt="office content 1">
                    <img class="w-full mt-4 rounded-lg lg:mt-10"
                        src="{{ asset('images/homepage/office-long-2.png') }}" alt="office content 2">
                </div>
            </div>
        </section>



        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-screen-xl px-4 py-8 mx-auto sm:py-16 lg:px-6">
                <div class="max-w-screen-md mb-8 lg:mb-16">
                    <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Designed for
                        business teams like yours, Mezgebe Dirijit focuses on empowering companies with innovative
                        technology and POS solutions to manage their inventory, sales, and staff more efficiently. By
                        leveraging cutting-edge tools, we help businesses unlock long-term value, drive operational
                        growth, and enhance overall performance.</p>
                </div>
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Sales & Marketing</h3>
                        <p class="text-gray-500 dark:text-gray-400">Plan, manage, and optimize your sales strategies.
                            Seamlessly collaborate across teams to boost your sales performance and achieve monthly
                            revenue targets with our all-in-one system.</p>

                    </div>
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Operations</h3>
                        <p class="text-gray-500 dark:text-gray-400">Simplify your processes, manage your sales and
                            inventory seamlessly, and stay efficient with our tailored workflows and real-time tracking
                            tools.</p>

                    </div>
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path
                                    d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Business Automation</h3>
                        <p class="text-gray-500 dark:text-gray-400">Streamline your operations by automating inventory
                            tracking, sales reports, and customer notifications. Get started with powerful templates
                            designed to simplify your workflows and save time.</p>
                    </div>
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Finance</h3>
                        <p class="text-gray-500 dark:text-gray-400">Audit-proof software built for critical financial
                            operations like month-end close and quarterly budgeting.</p>
                    </div>
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Enterprise Design</h3>
                        <p class="text-gray-500 dark:text-gray-400">Craft beautiful, delightful experiences for both
                            marketing and product with real cross-company collaboration.</p>
                    </div>
                    <div>
                        <div
                            class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Operations</h3>
                        <p class="text-gray-500 dark:text-gray-400">Keep your company’s lights on with customizable,
                            iterative, and structured workflows built for all efficient teams and individual.</p>
                    </div>
                </div>
            </div>
        </section>


        <div id="accordion-collapse" data-accordion="collapse">
            <h2 id="accordion-collapse-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                    data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                    aria-controls="accordion-collapse-body-1">
                    <span>What is Mezgebe Dirijit?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Mezgebe Dirijit is a comprehensive solution for
                        businesses, offering tools to streamline inventory management, track sales, and enhance POS
                        functionality with ease.</p>
                    <p class="text-gray-500 dark:text-gray-400">Discover how to <a href="{{-- /docs/getting-started/introduction/ --}}#"
                            class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and simplify your
                        business operations with our intuitive and powerful tools.</p>
                </div>
            </div>
            <h2 id="accordion-collapse-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                    aria-controls="accordion-collapse-body-2">
                    <span>Is Mezgebe Dirijit available now?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Mezgebe Dirijit is designed with a focus on
                        simplicity and efficiency, ensuring businesses can easily manage inventory, sales, and POS
                        operations from a single platform.</p>
                    <p class="text-gray-500 dark:text-gray-400">Learn more about our intuitive tools and how they can
                        help streamline your business by exploring the <a href="{{-- /design-system --}}"
                            class="text-blue-600 dark:text-blue-500 hover:underline">design system</a> powered by
                        Tailwind CSS and our advanced components.</p>
                </div>
            </div>
            <h2 id="accordion-collapse-heading-3">
                <button type="button"
                    class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-gray-200 rtl:text-right focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                    data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                    aria-controls="accordion-collapse-body-3">
                    <span>What are the differences between a regularly managed company and a company that uses Mezgebe
                        Dirijit?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
                <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">The key difference lies in efficiency and control.
                        Regularly managed companies often rely on manual processes, which can lead to inefficiencies,
                        errors, and lack of real-time insights. In contrast, companies using Mezgebe Dirijit benefit
                        from automated inventory tracking, seamless sales management, and comprehensive reporting tools
                        that empower smarter decision-making.</p>
                    <p class="mb-2 text-gray-500 dark:text-gray-400">With Mezgebe Dirijit, businesses streamline their
                        operations, reduce errors, and improve overall productivity by leveraging our intuitive platform
                        tailored for modern business needs.</p>
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Discover how Mezgebe Dirijit can transform your
                        business:</p>
                    <ul class="text-gray-500 list-disc ps-5 dark:text-gray-400">
                        <li><a href="{{-- /features --}}#"
                                class="text-blue-600 dark:text-blue-500 hover:underline">Explore Our
                                Features</a></li>
                        <li><a href="{{-- /case-studies --}}#"
                                class="text-blue-600 dark:text-blue-500 hover:underline">Success
                                Stories</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Company Info Section -->
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-12">
                <a href="#"
                    class="inline-flex items-center justify-between px-1 py-1 pr-4 text-sm text-gray-700 bg-gray-100 rounded-full mb-7 dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                    role="alert">
                    <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span> <span
                        class="text-sm font-medium">Mezgebe Dirijit is out! See what's new</span>
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    We help keep your campany run smoothly</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here
                    at Mezgebe Dirijit, we focus on helping businesses streamline their inventory, sales, and staff
                    management through advanced point-of-sale (POS) systems. By leveraging technology and innovation, we
                    empower companies to efficiently manage their operations, optimize their processes, and unlock
                    long-term growth and success.</p>
                <div
                    class="flex flex-col mb-8 space-y-4 lg:mb-16 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        Learn more
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                            </path>
                        </svg>
                        Watch video
                    </a>
                </div>
                <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                    <span class="font-semibold text-gray-400 uppercase">Explore</span>
                    <div class="flex flex-wrap items-center justify-center mt-8 text-gray-500 sm:justify-between">
                        <a href="#" class="mb-5 mr-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                            <svg class="h-8" viewBox="0 0 132 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.4555 5.17846C38.9976 3.47767 37.6566 2.13667 35.9558 1.67876C32.8486 0.828369 20.4198 0.828369 20.4198 0.828369C20.4198 0.828369 7.99099 0.828369 4.88379 1.64606C3.21571 2.10396 1.842 3.47767 1.38409 5.17846C0.566406 8.28567 0.566406 14.729 0.566406 14.729C0.566406 14.729 0.566406 21.2051 1.38409 24.2796C1.842 25.9804 3.183 27.3214 4.88379 27.7793C8.0237 28.6297 20.4198 28.6297 20.4198 28.6297C20.4198 28.6297 32.8486 28.6297 35.9558 27.812C37.6566 27.3541 38.9976 26.0131 39.4555 24.3123C40.2732 21.2051 40.2732 14.7618 40.2732 14.7618C40.2732 14.7618 40.3059 8.28567 39.4555 5.17846Z"
                                    fill="currentColor" />
                                <path d="M16.4609 8.77612V20.6816L26.7966 14.7289L16.4609 8.77612Z" fill="white" />
                                <path
                                    d="M64.272 25.0647C63.487 24.5413 62.931 23.7237 62.6039 22.5789C62.2768 21.4669 62.1133 19.9623 62.1133 18.1307V15.6122C62.1133 13.7479 62.3095 12.2434 62.6693 11.0986C63.0618 9.95386 63.6505 9.13618 64.4355 8.61286C65.2532 8.08954 66.2998 7.82788 67.6081 7.82788C68.8837 7.82788 69.9304 8.08954 70.7153 8.61286C71.5003 9.13618 72.0564 9.98657 72.4161 11.0986C72.7759 12.2107 72.9722 13.7152 72.9722 15.6122V18.1307C72.9722 19.995 72.8086 21.4669 72.4488 22.6116C72.0891 23.7237 71.533 24.5741 70.7481 25.0974C69.9631 25.6207 68.8837 25.8824 67.5427 25.8824C66.169 25.8496 65.057 25.588 64.272 25.0647ZM68.6875 22.3172C68.9164 21.7612 69.0146 20.8127 69.0146 19.5371V14.1077C69.0146 12.8648 68.9164 11.949 68.6875 11.3603C68.4585 10.7715 68.0988 10.5099 67.5427 10.5099C67.0194 10.5099 66.6269 10.8043 66.4307 11.3603C66.2017 11.949 66.1036 12.8648 66.1036 14.1077V19.5371C66.1036 20.8127 66.2017 21.7612 66.4307 22.3172C66.6269 22.8733 67.0194 23.1676 67.5754 23.1676C68.0987 23.1676 68.4585 22.906 68.6875 22.3172Z"
                                    fill="currentColor" />
                                <path
                                    d="M124.649 18.1634V19.0465C124.649 20.1586 124.682 21.009 124.748 21.565C124.813 22.121 124.944 22.5462 125.173 22.7752C125.369 23.0368 125.696 23.1677 126.154 23.1677C126.743 23.1677 127.135 22.9387 127.364 22.4808C127.593 22.0229 127.691 21.2706 127.724 20.1913L131.093 20.3875C131.125 20.5511 131.125 20.7473 131.125 21.009C131.125 22.6117 130.7 23.8218 129.817 24.6068C128.934 25.3918 127.691 25.7843 126.089 25.7843C124.159 25.7843 122.818 25.1628 122.033 23.9527C121.248 22.7425 120.855 20.8782 120.855 18.327V15.2852C120.855 12.6686 121.248 10.7715 122.066 9.56136C122.883 8.35119 124.257 7.76245 126.187 7.76245C127.528 7.76245 128.574 8.02411 129.294 8.51472C130.013 9.00534 130.504 9.79032 130.798 10.8042C131.093 11.8509 131.223 13.29 131.223 15.1216V18.098H124.649V18.1634ZM125.14 10.837C124.944 11.0986 124.813 11.4911 124.748 12.0471C124.682 12.6032 124.649 13.4536 124.649 14.5983V15.8412H127.528V14.5983C127.528 13.4863 127.495 12.6359 127.43 12.0471C127.364 11.4584 127.201 11.0659 127.004 10.837C126.808 10.608 126.481 10.4772 126.089 10.4772C125.631 10.4445 125.336 10.5753 125.14 10.837Z"
                                    fill="currentColor" />
                                <path
                                    d="M54.7216 17.8362L50.2734 1.71143H54.1656L55.7356 9.0052C56.1281 10.8041 56.4224 12.3414 56.6187 13.617H56.7168C56.8476 12.7011 57.142 11.1966 57.5999 9.0379L59.2353 1.71143H63.1274L58.6138 17.8362V25.5552H54.7543V17.8362H54.7216Z"
                                    fill="currentColor" />
                                <path
                                    d="M85.6299 8.15479V25.5878H82.5554L82.2283 23.4619H82.1302C81.3125 25.0645 80.0369 25.8822 78.3688 25.8822C77.2241 25.8822 76.3737 25.4897 75.8177 24.7375C75.2617 23.9852 75 22.8077 75 21.1723V8.15479H78.9249V20.9434C78.9249 21.7284 79.023 22.2844 79.1865 22.6115C79.3501 22.9385 79.6444 23.1021 80.0369 23.1021C80.364 23.1021 80.6911 23.004 81.0181 22.775C81.3452 22.5788 81.5742 22.3171 81.705 21.99V8.15479H85.6299Z"
                                    fill="currentColor" />
                                <path
                                    d="M105.747 8.15479V25.5878H102.673L102.346 23.4619H102.247C101.43 25.0645 100.154 25.8822 98.4861 25.8822C97.3413 25.8822 96.4909 25.4897 95.9349 24.7375C95.3788 23.9852 95.1172 22.8077 95.1172 21.1723V8.15479H99.0421V20.9434C99.0421 21.7284 99.1402 22.2844 99.3038 22.6115C99.4673 22.9385 99.7617 23.1021 100.154 23.1021C100.481 23.1021 100.808 23.004 101.135 22.775C101.462 22.5788 101.691 22.3171 101.822 21.99V8.15479H105.747Z"
                                    fill="currentColor" />
                                <path
                                    d="M96.2907 4.88405H92.3986V25.5552H88.5718V4.88405H84.6797V1.71143H96.2907V4.88405Z"
                                    fill="currentColor" />
                                <path
                                    d="M118.731 10.935C118.502 9.82293 118.11 9.03795 117.587 8.54734C117.063 8.05672 116.311 7.79506 115.395 7.79506C114.676 7.79506 113.989 7.99131 113.367 8.41651C112.746 8.809 112.255 9.36502 111.928 10.0192H111.896V0.828369H108.102V25.5552H111.34L111.732 23.9199H111.83C112.125 24.5086 112.582 24.9665 113.204 25.3263C113.825 25.6533 114.479 25.8496 115.232 25.8496C116.573 25.8496 117.521 25.2281 118.143 24.018C118.764 22.8078 119.091 20.8781 119.091 18.2942V15.5467C119.059 13.5516 118.96 12.0143 118.731 10.935ZM115.134 18.0325C115.134 19.3081 115.068 20.2893 114.97 21.0089C114.872 21.7285 114.676 22.2518 114.447 22.5461C114.185 22.8405 113.858 23.004 113.466 23.004C113.138 23.004 112.844 22.9386 112.582 22.7751C112.321 22.6116 112.092 22.3826 111.928 22.0882V12.2106C112.059 11.7527 112.288 11.3602 112.615 11.0331C112.942 10.7387 113.302 10.5752 113.662 10.5752C114.054 10.5752 114.381 10.7387 114.578 11.0331C114.807 11.3602 114.937 11.8835 115.036 12.6031C115.134 13.3553 115.166 14.402 115.166 15.743V18.0325H115.134Z"
                                    fill="currentColor" />
                            </svg>
                        </a>
                        <a href="#" class="mb-5 mr-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                            <svg class="h-11" viewBox="0 0 208 42" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M42.7714 20.729C42.7714 31.9343 33.6867 41.019 22.4814 41.019C11.2747 41.019 2.19141 31.9343 2.19141 20.729C2.19141 9.52228 11.2754 0.438965 22.4814 0.438965C33.6867 0.438965 42.7714 9.52297 42.7714 20.729Z"
                                    fill="currentColor" />
                                <path
                                    d="M25.1775 21.3312H20.1389V15.9959H25.1775C25.5278 15.9959 25.8747 16.0649 26.1983 16.1989C26.522 16.333 26.8161 16.5295 27.0638 16.7772C27.3115 17.0249 27.508 17.319 27.6421 17.6427C27.7761 17.9663 27.8451 18.3132 27.8451 18.6635C27.8451 19.0139 27.7761 19.3608 27.6421 19.6844C27.508 20.0081 27.3115 20.3021 27.0638 20.5499C26.8161 20.7976 26.522 20.9941 26.1983 21.1281C25.8747 21.2622 25.5278 21.3312 25.1775 21.3312ZM25.1775 12.439H16.582V30.2234H20.1389V24.8881H25.1775C28.6151 24.8881 31.402 22.1012 31.402 18.6635C31.402 15.2258 28.6151 12.439 25.1775 12.439Z"
                                    fill="white" />
                                <path
                                    d="M74.9361 17.4611C74.9361 16.1521 73.9305 15.3588 72.6239 15.3588H69.1216V19.5389H72.6248C73.9313 19.5389 74.9369 18.7457 74.9369 17.4611H74.9361ZM65.8047 28.2977V12.439H73.0901C76.4778 12.439 78.3213 14.7283 78.3213 17.4611C78.3213 20.1702 76.4542 22.4588 73.0901 22.4588H69.1216V28.2977H65.8055H65.8047ZM80.3406 28.2977V16.7362H83.3044V18.2543C84.122 17.2731 85.501 16.4563 86.9027 16.4563V19.3518C86.6912 19.3054 86.4349 19.2826 86.0851 19.2826C85.1039 19.2826 83.7949 19.8424 83.3044 20.5681V28.2977H80.3397H80.3406ZM96.8802 22.3652C96.8802 20.6136 95.8503 19.0955 93.9823 19.0955C92.1364 19.0955 91.1105 20.6136 91.1105 22.366C91.1105 24.1404 92.1364 25.6585 93.9823 25.6585C95.8503 25.6585 96.8794 24.1404 96.8794 22.3652H96.8802ZM88.0263 22.3652C88.0263 19.1663 90.2684 16.4563 93.9823 16.4563C97.7198 16.4563 99.962 19.1655 99.962 22.3652C99.962 25.5649 97.7198 28.2977 93.9823 28.2977C90.2684 28.2977 88.0263 25.5649 88.0263 22.3652ZM109.943 24.3739V20.3801C109.452 19.6316 108.378 19.0955 107.396 19.0955C105.693 19.0955 104.524 20.4265 104.524 22.366C104.524 24.3267 105.693 25.6585 107.396 25.6585C108.378 25.6585 109.452 25.1215 109.943 24.3731V24.3739ZM109.943 28.2977V26.5697C109.054 27.6899 107.841 28.2977 106.462 28.2977C103.637 28.2977 101.465 26.1499 101.465 22.3652C101.465 18.6993 103.59 16.4563 106.462 16.4563C107.793 16.4563 109.054 17.0177 109.943 18.1843V12.439H112.932V28.2977H109.943ZM123.497 28.2977V26.5925C122.727 27.4337 121.372 28.2977 119.526 28.2977C117.052 28.2977 115.884 26.9431 115.884 24.7473V16.7362H118.849V23.5798C118.849 25.1451 119.666 25.6585 120.927 25.6585C122.071 25.6585 122.983 25.028 123.497 24.3731V16.7362H126.463V28.2977H123.497ZM128.69 22.3652C128.69 18.9092 131.212 16.4563 134.67 16.4563C136.982 16.4563 138.383 17.4611 139.131 18.4886L137.191 20.3093C136.655 19.5153 135.838 19.0955 134.81 19.0955C133.011 19.0955 131.751 20.4037 131.751 22.366C131.751 24.3267 133.011 25.6585 134.81 25.6585C135.838 25.6585 136.655 25.1915 137.191 24.4203L139.131 26.2426C138.383 27.2702 136.982 28.2977 134.67 28.2977C131.212 28.2977 128.69 25.8456 128.69 22.3652ZM141.681 25.1915V19.329H139.813V16.7362H141.681V13.6528H144.648V16.7362H146.935V19.329H144.648V24.3975C144.648 25.1215 145.02 25.6585 145.675 25.6585C146.118 25.6585 146.541 25.495 146.702 25.3087L147.334 27.5728C146.891 27.9714 146.096 28.2977 144.857 28.2977C142.779 28.2977 141.681 27.2238 141.681 25.1915ZM165.935 28.2977V21.454H158.577V28.2977H155.263V12.439H158.577V18.5577H165.935V12.4398H169.275V28.2977H165.935ZM179.889 28.2977V26.5925C179.119 27.4337 177.764 28.2977 175.919 28.2977C173.443 28.2977 172.276 26.9431 172.276 24.7473V16.7362H175.241V23.5798C175.241 25.1451 176.058 25.6585 177.32 25.6585C178.464 25.6585 179.376 25.028 179.889 24.3731V16.7362H182.856V28.2977H179.889ZM193.417 28.2977V21.1986C193.417 19.6333 192.602 19.0963 191.339 19.0963C190.172 19.0963 189.285 19.7504 188.77 20.4045V28.2985H185.806V16.7362H188.77V18.1843C189.495 17.3439 190.896 16.4563 192.718 16.4563C195.217 16.4563 196.408 17.8573 196.408 20.0523V28.2977H193.418H193.417ZM199.942 25.1915V19.329H198.076V16.7362H199.943V13.6528H202.91V16.7362H205.198V19.329H202.91V24.3975C202.91 25.1215 203.282 25.6585 203.936 25.6585C204.38 25.6585 204.802 25.495 204.965 25.3087L205.595 27.5728C205.152 27.9714 204.356 28.2977 203.119 28.2977C201.04 28.2977 199.943 27.2238 199.943 25.1915"
                                    fill="currentColor" />
                            </svg>
                        </a>
                        <a href="#" class="mb-5 mr-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                            <svg class="h-11" viewBox="0 0 120 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.058 40.5994C31.0322 40.5994 39.9286 31.7031 39.9286 20.7289C39.9286 9.75473 31.0322 0.858398 20.058 0.858398C9.08385 0.858398 0.1875 9.75473 0.1875 20.7289C0.1875 31.7031 9.08385 40.5994 20.058 40.5994Z"
                                    fill="currentColor" />
                                <path
                                    d="M33.3139 20.729C33.3139 19.1166 32.0101 17.8362 30.4211 17.8362C29.6388 17.8362 28.9272 18.1442 28.4056 18.6424C26.414 17.2196 23.687 16.2949 20.6518 16.1765L21.9796 9.96387L26.2951 10.8885C26.3429 11.9793 27.2437 12.8567 28.3584 12.8567C29.4965 12.8567 30.4211 11.9321 30.4211 10.7935C30.4211 9.65536 29.4965 8.73071 28.3584 8.73071C27.5522 8.73071 26.8406 9.20497 26.5086 9.89271L21.6954 8.87303C21.553 8.84917 21.4107 8.87303 21.3157 8.94419C21.1972 9.01535 21.1261 9.13381 21.1026 9.27613L19.6321 16.1999C16.5497 16.2949 13.7753 17.2196 11.7599 18.6662C11.2171 18.1478 10.495 17.8589 9.74439 17.86C8.13201 17.86 6.85156 19.1639 6.85156 20.7529C6.85156 21.9383 7.56272 22.9341 8.55897 23.3849C8.51123 23.6691 8.48781 23.9538 8.48781 24.2623C8.48781 28.7197 13.6807 32.348 20.083 32.348C26.4852 32.348 31.6781 28.7436 31.6781 24.2623C31.6781 23.9776 31.6543 23.6691 31.607 23.3849C32.6028 22.9341 33.3139 21.9144 33.3139 20.729ZM13.4434 22.7918C13.4434 21.6536 14.368 20.729 15.5066 20.729C16.6447 20.729 17.5694 21.6536 17.5694 22.7918C17.5694 23.9299 16.6447 24.855 15.5066 24.855C14.368 24.8784 13.4434 23.9299 13.4434 22.7918ZM24.9913 28.2694C23.5685 29.6921 20.8653 29.7872 20.083 29.7872C19.2768 29.7872 16.5736 29.6683 15.1742 28.2694C14.9612 28.0559 14.9612 27.7239 15.1742 27.5105C15.3877 27.2974 15.7196 27.2974 15.9331 27.5105C16.8343 28.4117 18.7314 28.7197 20.083 28.7197C21.4346 28.7197 23.355 28.4117 24.2324 27.5105C24.4459 27.2974 24.7778 27.2974 24.9913 27.5105C25.1809 27.7239 25.1809 28.0559 24.9913 28.2694ZM24.6116 24.8784C23.4735 24.8784 22.5488 23.9538 22.5488 22.8156C22.5488 21.6775 23.4735 20.7529 24.6116 20.7529C25.7502 20.7529 26.6748 21.6775 26.6748 22.8156C26.6748 23.9299 25.7502 24.8784 24.6116 24.8784Z"
                                    fill="white" />
                                <path
                                    d="M108.412 16.6268C109.8 16.6268 110.926 15.5014 110.926 14.1132C110.926 12.725 109.8 11.5996 108.412 11.5996C107.024 11.5996 105.898 12.725 105.898 14.1132C105.898 15.5014 107.024 16.6268 108.412 16.6268Z"
                                    fill="currentColor" />
                                <path
                                    d="M72.5114 24.8309C73.7446 24.8309 74.4557 23.9063 74.4084 23.0051C74.385 22.5308 74.3373 22.2223 74.29 21.9854C73.5311 18.7133 70.8756 16.2943 67.7216 16.2943C63.9753 16.2943 60.9401 19.6853 60.9401 23.8586C60.9401 28.0318 63.9753 31.4228 67.7216 31.4228C70.0694 31.4228 71.753 30.5693 72.9622 29.2177C73.5549 28.5538 73.4365 27.5341 72.7249 27.036C72.1322 26.6329 71.3972 26.7752 70.8517 27.2256C70.3302 27.6765 69.3344 28.5772 67.7216 28.5772C65.825 28.5772 64.2126 26.941 63.8568 24.7832H72.5114V24.8309ZM67.6981 19.1637C69.4051 19.1637 70.8756 20.4915 71.421 22.3173H63.9752C64.5207 20.468 65.9907 19.1637 67.6981 19.1637ZM61.0824 17.7883C61.0824 17.0771 60.5609 16.5078 59.897 16.3894C57.8338 16.0813 55.8895 16.8397 54.7752 18.2391V18.049C54.7752 17.1717 54.0636 16.6267 53.3525 16.6267C52.5697 16.6267 51.9297 17.2667 51.9297 18.049V29.6681C51.9297 30.427 52.4985 31.0908 53.2574 31.1381C54.0875 31.1854 54.7752 30.5454 54.7752 29.7154V23.7162C54.7752 21.0608 56.7668 18.8791 59.5173 19.1876H59.802C60.5131 19.1399 61.0824 18.5233 61.0824 17.7883ZM109.834 19.306C109.834 18.5233 109.194 17.8833 108.412 17.8833C107.629 17.8833 106.989 18.5233 106.989 19.306V29.7154C106.989 30.4981 107.629 31.1381 108.412 31.1381C109.194 31.1381 109.834 30.4981 109.834 29.7154V19.306ZM88.6829 11.4338C88.6829 10.651 88.0429 10.011 87.2602 10.011C86.4779 10.011 85.8379 10.651 85.8379 11.4338V17.7648C84.8655 16.7924 83.6562 16.3182 82.2096 16.3182C78.4632 16.3182 75.4281 19.7091 75.4281 23.8824C75.4281 28.0557 78.4632 31.4466 82.2096 31.4466C83.6562 31.4466 84.8893 30.9485 85.8613 29.9761C85.9797 30.6405 86.5729 31.1381 87.2602 31.1381C88.0429 31.1381 88.6829 30.4981 88.6829 29.7154V11.4338ZM82.2334 28.6245C80.0518 28.6245 78.2971 26.5145 78.2971 23.8824C78.2971 21.2742 80.0518 19.1399 82.2334 19.1399C84.4151 19.1399 86.1698 21.2504 86.1698 23.8824C86.1698 26.5145 84.3912 28.6245 82.2334 28.6245ZM103.527 11.4338C103.527 10.651 102.887 10.011 102.104 10.011C101.322 10.011 100.681 10.651 100.681 11.4338V17.7648C99.7093 16.7924 98.5 16.3182 97.0534 16.3182C93.307 16.3182 90.2719 19.7091 90.2719 23.8824C90.2719 28.0557 93.307 31.4466 97.0534 31.4466C98.5 31.4466 99.7327 30.9485 100.705 29.9761C100.824 30.6405 101.416 31.1381 102.104 31.1381C102.887 31.1381 103.527 30.4981 103.527 29.7154V11.4338ZM97.0534 28.6245C94.8717 28.6245 93.1174 26.5145 93.1174 23.8824C93.1174 21.2742 94.8717 19.1399 97.0534 19.1399C99.235 19.1399 100.99 21.2504 100.99 23.8824C100.99 26.5145 99.235 28.6245 97.0534 28.6245ZM117.042 29.7392V19.1637H118.299C118.963 19.1637 119.556 18.6656 119.603 17.9779C119.651 17.2428 119.058 16.6267 118.347 16.6267H117.042V14.6347C117.042 13.8758 116.474 13.2119 115.715 13.1646C114.885 13.1173 114.197 13.7573 114.197 14.5874V16.6501H113.011C112.348 16.6501 111.755 17.1483 111.708 17.836C111.66 18.571 112.253 19.1876 112.964 19.1876H114.173V29.7631C114.173 30.5454 114.814 31.1854 115.596 31.1854C116.426 31.1381 117.042 30.5216 117.042 29.7392Z"
                                    fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>

    <!-- Footer Section -->
    {{-- <footer class="bg-white dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto">
            <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4"> --}}

                <footer class="bg-white dark:bg-gray-900">
                    <div class="w-full max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
                        <div class="grid grid-cols-2 gap-8 py-6 lg:py-8 md:grid-cols-4">
                            <div class="flex flex-col items-center text-center">
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company
                                </h2>
                                <ul class="font-medium text-gray-500 dark:text-gray-400">
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">About Us</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Our Story</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Careers</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Blog</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Customer
                                    Service
                                </h2>
                                <ul class="font-medium text-gray-500 dark:text-gray-400">
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Contact Us</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Shipping & Delivery</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Returns & Exchanges</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal
                                </h2>
                                <ul class="font-medium text-gray-500 dark:text-gray-400">
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Privacy Policy</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Terms & Conditions</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline">Cookie Policy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow
                                    Us</h2>
                                <ul
                                    class="flex space-x-4 font-medium text-gray-500 dark:text-gray-400 rtl:space-x-reverse">
                                    <li>
                                        <a href="#" class="hover:underline">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path
                                                    d="M12 2.043c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm-1.6 14h-2.4v-6h2.4v6zm-1.2-7.2c-.8 0-1.2-.8-1.2-1.2s.4-1.2 1.2-1.2 1.2.4 1.2 1.2-.4 1.2-1.2 1.2zM12 4.5c-3.8 0-6.9 3.1-6.9 6.9h1.9c0-2.7 2.2-4.9 4.9-4.9 2.7 0 4.9 2.2 4.9 4.9h1.9c0-3.8-3.1-6.9-6.9-6.9z" />
                                            </svg>
                                            <span class="sr-only">Facebook</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="hover:underline">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path
                                                    d="M19 3h-2c-1.1 0-2 .9-2 2v2h-2v3h2v7h3v-7h2.9l.1-3h-3v-2c0-.6.5-1 1-1h2v-3h-2c-2.2 0-4 1.8-4 4v2h-2v3h2v7h3v-7h2v-3h-2v-2c0-2.2 1.8-4 4-4h2v3h-2c-.6 0-1 .4-1 1v2h3.1l.1 3h-3v7h3v-7h2v-3h-2v-2c0-3.3-2.7-6-6-6z" />
                                            </svg>
                                            <span class="sr-only">Instagram</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="px-4 py-6 bg-gray-100 dark:bg-gray-700 md:flex md:items-center md:justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">
                                © 2023 Mezgebedirijit.com - All Rights Reserved.
                            </span>
                            <span class="ml-4 text-sm text-gray-500 dark:text-gray-300 sm:text-center rtl:ml-0"
                                id="timestamp"></span>
                        </div>
                    </div>
                </footer>

                <script>
                    function updateTimestamp() {
                        const timestampElement = document.getElementById('timestamp');
                        const now = new Date().toLocaleString('en-US', {
                            timeZone: 'Africa/Addis_Ababa',
                            hour12: false,
                        });
                        timestampElement.textContent = now;
                    }

                    setInterval(updateTimestamp, 1000); // Update every second
                    updateTimestamp(); // Initial call to set the timestamp immediately
                </script>



</body>

</html>








{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mezgebedirijit - Best Online Store for Unique Products</title>
    <meta name="description" content="Discover a wide range of unique products at Mezgebedirijit, your one-stop online store for quality and convenience. Browse, shop, and enjoy amazing deals!">

    <!-- Open Graph Meta Tags (for social media sharing) -->
    <meta property="og:title" content="Mezgebedirijit - Best Online Store for Unique Products">
    <meta property="og:description" content="Discover a wide range of unique products at Mezgebedirijit, your one-stop online store for quality and convenience.">
    <meta property="og:image" content="https://mezgebedirijit.com/images/social-share.jpg">
    <meta property="og:url" content="https://mezgebedirijit.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mezgebedirijit - Best Online Store for Unique Products">
    <meta name="twitter:description" content="Discover a wide range of unique products at Mezgebedirijit, your one-stop online store for quality and convenience.">
    <meta name="twitter:image" content="https://mezgebedirijit.com/images/social-share.jpg">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Mezgebedirijit - Best Online Store for Unique Products",
      "description": "Browse through a wide range of products at Mezgebedirijit. Your one-stop online store for quality and convenience.",
      "url": "https://mezgebedirijit.com",
      "publisher": {
        "@type": "Organization",
        "name": "Mezgebedirijit",
        "logo": {
          "@type": "ImageObject",
          "url": "https://mezgebedirijit.com/images/logo.jpg"
        }
      }
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-900 font-figtree bg-gray-50 dark:bg-black dark:text-white">

    <div class="flex flex-col min-h-screen">
        <!-- Header Section -->
        <header class="py-4 text-white bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl">
                <h1 class="text-3xl font-extrabold text-center">Welcome to Mezgebedirijit</h1>
                <p class="mt-2 text-xl text-center">The Best Online Store for Unique Products</p>
            </div>
        </header>

        <!-- Main Section -->
        <main class="flex items-center justify-center flex-1 px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-4xl text-center">
                <h2 class="mb-6 text-3xl font-semibold text-gray-800 dark:text-white">Explore Our Collection</h2>
                <p class="mb-8 text-lg text-gray-600 dark:text-gray-300">Browse through a wide range of unique products and enjoy your shopping experience!</p>

                <div class="flex items-center justify-center gap-6">
                    @if (Route::has('login'))
                        <div class="flex gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                   class="inline-block px-4 py-2 rounded-md text-black border border-transparent hover:border-[#FF2D20] focus:outline-none focus:ring-2 focus:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="inline-block px-4 py-2 rounded-md text-black border border-transparent hover:border-[#FF2D20] focus:outline-none focus:ring-2 focus:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus:ring-white">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="inline-block px-4 py-2 rounded-md text-black border border-transparent hover:border-[#FF2D20] focus:outline-none focus:ring-2 focus:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <!-- Featured Products Section (Optional, can be populated dynamically) -->
        <section class="py-12 bg-gray-100">
            <div class="px-4 mx-auto text-center max-w-7xl">
                <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-white">Featured Products</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Example Product Card -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                        <img src="https://mezgebedirijit.com/images/product1.jpg" alt="Product 1" class="object-cover w-full h-64">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Stylish Leather Handbag</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">Perfect for any occasion</p>
                            <a href="/product/1" class="mt-4 inline-block px-6 py-2 text-white bg-[#FF2D20] rounded-md hover:bg-[#FF2D20]/80">
                                View Product
                            </a>
                        </div>
                    </div>
                    <!-- Repeat for other products -->
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="py-4 mt-auto text-center text-white bg-gray-800">
            <p>Mezgebedirijit.com - {{ now()->setTimezone('Africa/Addis_Ababa')->format('l, F j, Y, g:i A') }}</p>
        </footer>
    </div>
</body>

</html>



 --}}



{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mezgebedirijit</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-white">
    <div class="relative flex flex-col items-center justify-between min-h-screen">
        <!-- Header Section -->
        <header class="w-full bg-gradient-to-r from-[#FF2D20] to-[#FF5E20] text-white py-6">
            <h2 class="text-3xl font-semibold text-center">Welcome to Mezgebedirijit</h2>
        </header>

        <!-- Main Content Section -->
        <main class="flex flex-col items-center justify-center flex-1 px-4 py-10 sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="mb-8 text-center">
                <h1 class="mb-4 text-4xl font-extrabold text-gray-800 dark:text-white">Welcome to our store!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">Browse through our wide range of products and enjoy your shopping experience!</p>
            </div>

            <!-- Auth Navigation Section -->
            <div class="flex justify-center space-x-6">
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-block px-6 py-3 bg-[#FF2D20] text-white font-medium rounded-lg transition-colors hover:bg-[#FF5E20] dark:bg-[#FF5E20] dark:hover:bg-[#FF2D20]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-[#FF2D20] text-white font-medium rounded-lg transition-colors hover:bg-[#FF5E20] dark:bg-[#FF5E20] dark:hover:bg-[#FF2D20]">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-[#FF2D20] text-white font-medium rounded-lg transition-colors hover:bg-[#FF5E20] dark:bg-[#FF5E20] dark:hover:bg-[#FF2D20]">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="w-full py-4 mt-10 text-center text-white bg-gray-800">
            <p class="text-sm">Mezgebedirijit.com - {{ now()->setTimezone('Africa/Addis_Ababa')->format('l, F j, Y, g:i A') }}</p>
        </footer>
    </div>
</body>

</html> --}}
