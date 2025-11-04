@extends('seller.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl">




            <div class="w-full px-4 py-3 rounded-b-xl" style="background-color: #f6a45d">
                <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto">
                    <!-- Center Title -->
                    <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">Customers</h1>

                    <!-- Settings Button on Right -->
                    <a href="{{ route('seller.customers.create') }}"
                        class="ml-auto text-white border-2 border-white btn btn-circle hover:bg-white/10" title="Settings">
                        <x-lucide-circle-plus class="w-7 h-7" />
                    </a>
                </div>
            </div>



            <div class="flex flex-col items-center justify-center h-full pb-16">
                <!-- Full screen container for vertical space -->
                <!-- Scrollable and Alphabetically Sorted Customer List -->
                <ul
                    class="divide-y {{-- divide-gray-400/50 dark:divide-gray-400/50 --}} bg-white flex-1 overflow-y-auto mx-auto w-full max-w-2xl m rounded-lg shadow-lg">
                    @foreach ($customers->sortBy('first_name') as $customer)
                        {{-- <li class="py-3 sm:py-4 hover:bg-gray-100"> --}}
                        <li class="py-3 sm:py-4 hover:bg-gray-100 focus:outline-none active:bg-gray-100">

                            <!-- Wrap each customer in an anchor tag for clickability -->
                            <a href="{{ route('seller.customers.show', $customer->id) }}"
                                class="flex items-center pl-4 space-x-4 rtl:space-x-reverse">
                                <!-- Placeholder Circle Instead of Image -->
                                <!-- Customer Icon -->
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full dark:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 dark:text-gray-300"
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
                <div class="flex items-center justify-center pt-2">
                    <p class="relative px-4 py-2 font-semibold">
                        <span class="absolute top-0 left-0 w-full h-px bg-white dark:bg-white"></span>
                        <span class="mx-6">Total {{ $customers->count() }}</span>

                    </p>
                </div>

                {{-- @foreach ($types as $typeName => $items)
                    <h2>{{ $typeName }}</h2>
                    <ul>
                        @foreach ($items as $item)
                            <li>{{ $item['name'] }}</li>
                        @endforeach
                    </ul>
                @endforeach --}}






            </div>
        </div>
    @endsection
