@extends('seller.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="container p-4 mx-auto">
            <div class="relative flex items-center justify-between pt-1 mb-4">
                {{-- <button class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button> --}}
                <h1 class="absolute w-6 h-6 text-xl font-semibold transform -translate-x-1/2 left-1/2">More</h1>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
                </svg> --}}
            </div>

            <div class="grid gap-4">
                <div class="flex items-center">
                    <img src="user_profile.jpg" alt="User Profile" class="w-12 h-12 mr-4 rounded-full">
                    <div>
                        <h2 class="text-lg font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                        <button class="text-blue-500 hover:underline">View your profile</button>
                    </div>


                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">

                <a href="#"
                    class="flex items-center p-4 transition duration-200 bg-white rounded-lg shadow-sm hover:bg-gray-100">

                    <!-- Image styled like SVG icon -->
                    <img src="http://duka-11.2.0.local:8086/images/1828533.png" alt="Dashboard Icon"
                        class="object-contain w-6 h-6 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-3 font-medium text-gray-800">Dashboard</span>

                    <!-- Optional Badge -->
                    {{-- <span class="ml-auto bg-blue-500 text-white text-xs font-semibold rounded-full px-2 py-0.5">3</span> --}}
                    <span
                        class="ml-auto bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">3</span>
                </a>

                <button type="button"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Dashboard</button>

                <a href="#"
                    class="flex items-center p-4 transition duration-200 bg-white rounded-lg shadow-sm hover:bg-gray-100">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7m0 0L3 12m4 0v6h10v-6" />
                    </svg>


                    <!-- Label -->
                    <span class="ml-3 font-medium text-gray-800">Dashboard</span>

                    <!-- Optional Badge -->
                    {{-- <span class="ml-auto bg-blue-500 text-white text-xs font-semibold rounded-full px-2 py-0.5">3</span> --}}
                    <span class="px-2 py-1 ml-2 text-white bg-blue-500 rounded-full">2</span>
                </a>

                <button class="btn">
                    <img src="{{ asset('images/icons8-dashboard-50.png') }}" alt="Dashboard Icon"
                        class="inline-block w-5 h-5 mr-2">
                    Dashboard
                </button>





                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 16h10M2 9h20M2 20h20" />
                    </svg>
                    <span class="ml-2">Messages</span>
                    <span class="px-2 py-1 ml-2 text-white bg-red-500 rounded-full">9</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25l6-6 4 4 8-8" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 7h18" />
                    </svg>

                    <span class="ml-2">Sales</span>
                </a>

                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-10a1 1 0 00-1-1H7a1 1 0 00-1 1v10h5" />
                    </svg>
                    <span class="ml-2">Purchases</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Orders</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Balance</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 0a9 9 0 1118 0" />
                    </svg>
                    <span class="ml-2">Tasks</span>
                </a>
                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Calandar</span>
                </a>



                {{-- {/* Add more menu items here */} --}}

            </div>



            <form action="{{ route('logout') }}" method="POST"
                class="block px-4 pb-16 text-sm text-gray-700 pt-72 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                role="menuitem">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">Sign
                    out</button>
            </form>
        </div>
    </div>
@endsection
