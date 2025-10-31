@extends('seller.layouts.app')

@section('content')
  <div class="min-h-screen bg-gray-100">
    <div class="container p-4 mx-auto">
        <!-- Header -->
          <!-- Header with "More" and Gear -->
        <div class="w-full px-4 py-3 rounded-b-xl" style="background-color:#F6A45D;">
            <div class="relative flex items-center justify-between">

                <!-- Center Title -->
                <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">
                    More
                </h1>

                <!-- Gear Icon on Right -->
                <a href="{{ route('seller.settings.index') }}"
                    class="ml-auto text-white border-2 border-white btn btn-circle hover:bg-white/10"
                    title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09A1.65 1.65 0 0012 3h0a1.65 1.65 0 001-.09h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                    </svg>
                </a>

            </div>
        </div>


            <div class="grid grid-cols-2 gap-4 mt-4">

                <a href="#"
                class="flex items-center justify-between p-4 transition duration-200 bg-white rounded-lg shadow-sm hover:bg-gray-100">

                <!-- Left: Icon + Label -->
                <div class="flex items-center">
                    <!-- Lucide Icon -->
                    <x-lucide-layout-dashboard class="w-6 h-6 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-3 font-medium text-gray-800">Dashboard</span>
                </div>

                <!-- Right: Badge -->
                <span class="px-2 py-1 text-white bg-blue-500 rounded-full">2</span>
                </a>



                <a href="#" class="flex items-center justify-between p-4 bg-white rounded-lg hover:bg-gray-100">

                    <!-- Left: Icon + Label -->
                    <div class="flex items-center">
                        <!-- Lucide Icon -->
                        <x-lucide-message-square-more class="w-6 h-6 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Messages</span>
                    </div>

                    <!-- Right: Badge -->
                    <span class="px-2 py-1 text-white bg-red-500 rounded-full">9</span>
                </a>

            </div>

              {{-- <hr class="my-4 border-gray-300"> --}}
              <div class="h-px my-4 bg-gray-300"></div>





            <div class="grid grid-cols-2 gap-4 mt-4">


                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-trending-up class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Sales</span>
                </a>

            <a href="#" class="flex items-center justify-between p-4 bg-white rounded-lg hover:bg-gray-100">
                <!-- Left section: Icon + Label -->
                <div class="flex items-center">
                    <!-- Lucide Icon -->
                    <x-lucide-circle-check-big class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Tasks</span>
                </div>

                <!-- Right section: Badge -->
                <span class="px-2 py-1 text-white bg-blue-500 rounded-full">1</span>
            </a>


                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-boxes class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Stock</span>
                </a>

                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-calendar-arrow-down class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Orders</span>
                </a>


                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-barcode class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Purchases</span>
                </a>

                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-wallet class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Balance</span>
                </a>


                <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                    <!-- Lucide Icon -->
                    <x-lucide-calendar-days class="w-6 h-6 mr-2 text-gray-600" />

                    <!-- Label -->
                    <span class="ml-2">Calandar</span>
                </a>
                {{-- {/* Add more menu items here */} --}}

            </div>




        </div>
    </div>
@endsection
