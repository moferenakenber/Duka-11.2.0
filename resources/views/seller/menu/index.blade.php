@extends('seller.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl">
            <!-- Header with "More" and Gear -->
            <div class="w-full px-4 py-3 rounded-b-xl" style="background-color: #f6a45d">
                <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto">
                    <!-- Center Title -->
                    <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">More</h1>

                    <!-- Settings Button on Right -->
                    <a href="{{ route('seller.settings.index') }}"
                        class="ml-auto text-white border-2 border-white btn btn-circle hover:bg-white/10" title="Settings">
                        <x-lucide-settings class="w-6 h-6" />
                    </a>
                </div>
            </div>

            <div class="container p-4 mx-auto">
                <!-- Header -->

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

                    <!-- Customers -->
                    <a href="/seller/customers" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <x-lucide-users class="w-6 h-6 mr-2 text-gray-600" />
                        <span class="ml-2">Customers</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-trending-up class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Sales</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-truck class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Delivery</span>
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
                        <span class="ml-2">Transfers</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-scan-barcode class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Purchase Orders</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-wallet class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Balance</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-file class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Documents</span>
                    </a>

                    <a href="#" class="flex items-center p-4 bg-white rounded-lg hover:bg-gray-100">
                        <!-- Lucide Icon -->
                        <x-lucide-calendar-days class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Calandar</span>
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
                        <x-lucide-calendar-days class="w-6 h-6 mr-2 text-gray-600" />

                        <!-- Label -->
                        <span class="ml-2">Payments</span>
                    </a>
                    {{-- {/* Add more menu items here */} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
