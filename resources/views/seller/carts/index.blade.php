@extends('seller.layouts.app')

@section('content')
    <div class="pt-2 flex flex-col h-full justify-center items-center">
        <div
            class="p-4 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-y-auto mx-auto max-w-2xl w-full">

            <!-- Top nav -->
            <!-- Button Container to align buttons on opposite corners -->
            <div class="flex justify-between w-full">

                <!-- Back Button aligned to the left (with gray color) -->
                <a href="javascript:history.back()"
                    class="inline-flex items-center h-10 pl-2 pr-4 py-4 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">

                    <!-- Left Arrow Icon -->
                    <svg class="w-5 h-5 mr-4 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M15.293 10.293a1 1 0 0 0 0-1.414L10.707 4.707a1 1 0 0 0-1.414 1.414L12.586 9H3a1 1 0 1 0 0 2h9.586l-3.293 3.293a1 1 0 1 0 1.414 1.414l4.586-4.586z"
                            clip-rule="evenodd" />
                    </svg>
                    Back
                </a>

                <!-- Edit Button aligned to the right (with blue color) -->
                <a href="{{ route('seller.carts.create') }}"
                    class="inline-flex items-center h-10 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Add
                </a>

            </div>

        </div>
    </div>


    <div class="flex flex-col h-full pb-16 pt-4 justify-center items-center">
        <!-- Full screen container for vertical space -->
        <!-- Scrollable and Alphabetically Sorted Customer List -->
        <ul class="divide-y divide-gray-200 dark:divide-gray-700 flex-1 overflow-y-auto mx-auto w-full max-w-2xl">
            @foreach ($carts as $cart)
                <li class="py-3 sm:py-4">
                    <!-- Wrap each customer in an anchor tag for clickability -->
                    <a href="{{ route('seller.carts.show', $cart->id) }}"
                        class="flex items-center space-x-4 rtl:space-x-reverse pl-4">
                        <!-- Placeholder Circle Instead of Image -->
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                        <div class="flex-1 min-w-0">
                            <!-- Increased Font Size for First and Last Name -->
                            <p class="text-lg font-semibold text-gray-900 truncate dark:text-white">
                                @if ($cart->customer)
                                    {{ $cart->customer->first_name }}'s Cart
                                @else
                                    No customer assigned
                                @endif
                            </p>
                            <p class="text-lg font-semibold text-gray-900 truncate dark:text-white">
                                @if ($cart->seller)
                                {{ $cart->seller->first_name }} {{ $cart->seller->last_name }}
                            @elseif ($cart->user)
                                {{ $cart->user->name }} (User)
                            @else
                                N/A
                            @endif
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
                <span class="mx-6">Total {{ $carts->count() }}</span>
                <span class="absolute right-0 top-0 w-full h-px bg-gray-300 dark:bg-gray-600"></span>
            </p>
        </div>





    </div>
@endsection
