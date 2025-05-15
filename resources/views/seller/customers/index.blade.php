@extends('seller.layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto p-2.5">
            <div class="relative flex items-center justify-between mb-4 pt-1">
                <!-- Back Button -->
                {{-- <a href="/seller/customers" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a> --}}
                <!-- Title -->
                <h1 class="absolute left-1/2 transform -translate-x-1/2 text-xl font-semibold">Customers</h1>
                <!-- Right Arrow Icon -->
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
            </svg> --}}
                <a href="{{ route('seller.customers.create') }}" class="ml-auto text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                    </svg>
                </a>

            </div>


            <div class="flex flex-col h-full pb-16 justify-center items-center">
                <!-- Full screen container for vertical space -->
                <!-- Scrollable and Alphabetically Sorted Customer List -->
                <ul
                    class="divide-y {{-- divide-gray-400/50 dark:divide-gray-400/50 --}} bg-white flex-1 overflow-y-auto mx-auto w-full max-w-2xl m rounded-lg shadow-lg">
                    @foreach ($customers->sortBy('first_name') as $customer)
                        {{-- <li class="py-3 sm:py-4 hover:bg-gray-100"> --}}
                        <li class="py-3 sm:py-4 hover:bg-gray-100 focus:outline-none active:bg-gray-100">

                            <!-- Wrap each customer in an anchor tag for clickability -->
                            <a href="{{ route('seller.customers.show', $customer->id) }}"
                                class="flex items-center space-x-4 rtl:space-x-reverse pl-4">
                                <!-- Placeholder Circle Instead of Image -->
                                <!-- Customer Icon -->
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11c2.28 0 4-1.72 4-4s-1.72-4-4-4-4 1.72-4 4 1.72 4 4 4zm2 2H14a4 4 0 00-8 0H2a10 10 0 0112-10c5.52 0 10 4.48 10 10v5h-4a4 4 0 01-8 0H6a4 4 0 008 0h2a4 4 0 014 4v2h-4a4 4 0 01-8 0H6a4 4 0 008 0h2v2z" />
                                    </svg>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <!-- Increased Font Size for First and Last Name -->
                                    <p class="text-lg font-semibold text-gray-900 truncate {{-- dark:text-white --}}">
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                    </p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Display Total with horizontal lines on the top and bottom -->
                <div class="flex justify-center items-center pt-2">
                    <p class="font-semibold px-4 py-2 relative">
                        <span class="absolute left-0 top-0 w-full h-px bg-white dark:bg-white"></span>
                        <span class="mx-6">Total {{ $customers->count() }}</span>

                    </p>
                </div>

                @foreach ($types as $typeName => $items)
                    <h2>{{ $typeName }}</h2>
                    <ul>
                        @foreach ($items as $item)
                            <li>{{ $item['name'] }}</li>
                        @endforeach
                    </ul>
                @endforeach






            </div>
        </div>
    @endsection
