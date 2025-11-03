@extends('seller.layouts.app')

@section('content')
    {{--
        <div class="flex flex-col items-center justify-center h-full p-2">
            <div
                class="p-2 text-gray-900 bg-gray-100 {{-- dark:text-gray-100 --}} {{-- bg-white --}} {{-- dark:bg-gray-800  shadow-sm sm:rounded-lg overflow-y-auto mx-auto max-w-2xl w-full rounded-lg border-b border-gray-400/50">

                <!-- Top nav -->
                <!-- Button Container to align buttons on opposite corners -->
                {{-- <div class="flex justify-between w-full">

                    <!-- Back Button aligned to the left (with gray color) -->
                    <a href="javascript:history.back()"
                        class="inline-flex items-center h-10 py-4 pl-2 pr-4 text-xs font-semibold tracking-widest text-white uppercase bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">

                        <!-- Left Arrow Icon -->
                        <svg class="w-5 h-5 mr-4 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M15.293 10.293a1 1 0 0 0 0-1.414L10.707 4.707a1 1 0 0 0-1.414 1.414L12.586 9H3a1 1 0 1 0 0 2h9.586l-3.293 3.293a1 1 0 1 0 1.414 1.414l4.586-4.586z"
                                clip-rule="evenodd" />
                        </svg>
                        Back
                    </a>

                <div class="relative flex justify-between w-full">

                    <h2 class="absolute text-lg font-semibold transform -translate-x-1/2 left-1/2">Carts</h2>



                    <!-- Edit Button aligned to the right (with blue color) -->
                    <a href="{{ route('seller.carts.create') }}"
                        class="inline-flex items-center h-8 px-4 py-2 ml-auto text-xs font-semibold tracking-widest text-white uppercase bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Add
                    </a>

                </div>

            </div>
        </div> --}}
    <div class="min-h-screen bg-gray-100">
        {{-- <div class="container mx-auto p-2.5">
            <div class="flex flex-col items-center justify-center h-full pb-16 bg-gray-100"> --}}

        <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl ">

            <!-- Carts Header -->
            <div class="w-full px-4 py-3 rounded-b-xl" style="background-color:#F6A45D;">
                <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto">
                    <!-- Center Title -->
                    <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">
                        Carts
                    </h1>

                    <!-- Add Cart Button on Right -->
                    <a href="{{ route('seller.carts.create') }}"
                        class="ml-auto text-white border-2 border-white btn btn-circle hover:bg-white/10" title="Add Cart">
                        <x-lucide-circle-plus class="w-7 h-7" />
                    </a>
                </div>
            </div>

            {{-- <div class="w-full px-4 py-3 rounded-b-xl" style="background-color:#F6A45D;"> --}}
            <!-- Back Button -->
            {{-- <a href="/seller/customers" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a> --}}
            <!-- Title -->
            {{-- <h1 class="absolute text-xl font-semibold transform -translate-x-1/2 left-1/2">Carts</h1> --}}
            <!-- Right Arrow Icon -->
            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
                </svg> --}}
            {{-- <a href="{{ route('seller.carts.create') }}" class="ml-auto text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                    </svg>
                </a>




            </div> --}}






            {{-- <div class="w-full px-4 py-3 rounded-b-xl" style="background-color:#F6A45D;">
                <form method="GET" action="{{ route('seller.items.index') }}" class="flex w-full max-w-2xl gap-2 mx-auto">
                    <!-- Search Input -->
                    <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}"
                        class="flex-1 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">

                    <!-- Search Button -->
                    <button type="submit" class="text-white border-2 border-white btn btn-circle hover:bg-white/10">
                        <x-lucide-search class="w-5 h-5" />
                    </button>

                    <!-- Scan Button -->
                    <button type="button" class="text-white border-2 border-white btn btn-circle hover:bg-white/10"
                        @click="startScan()">
                        <x-lucide-scan-barcode class="w-5 h-5" />
                    </button>
                </form>
            </div> --}}



            <div class="flex flex-col items-center justify-center h-full px-4 pt-4 pb-16">
                <!-- Full screen container for vertical space -->
                <!-- Scrollable and Alphabetically Sorted Customer List -->
                <ul
                    class="flex-1 w-full max-w-2xl mx-auto overflow-y-auto divide-y rounded-lg divide-gray-400/50 dark:divide-gray-400/50">
                    @foreach ($carts as $cart)
                        <li class="py-3 sm:py-4">
                            <!-- Wrap each customer in an anchor tag for clickability -->
                            <a href="{{ route('seller.carts.show', $cart->id) }}"
                                class="flex items-center pl-4 space-x-4 rtl:space-x-reverse">
                                <!-- Placeholder Circle Instead of Image -->
                                {{-- <div class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full dark:bg-gray-700"></div> --}}

                                <div class="avatar">
                                    <div class="w-16 rounded-full">
                                        <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                                    </div>
                                </div>


                                <div class="flex-1 min-w-0">
                                    <!-- Increased Font Size for First and Last Name -->
                                    <p class="text-lg font-semibold text-gray-900 truncate">
                                        @if ($cart->customer)
                                            {{ $cart->customer->first_name }}'s Cart
                                        @else
                                            No customer assigned
                                        @endif
                                    </p>
                                    <p class="text-lg font-semibold text-gray-900 truncate">
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
                <div class="flex items-center justify-center pt-2">
                    <p class="relative px-4 py-2 font-semibold">
                        <span class="absolute top-0 left-0 w-full h-px bg-white dark:bg-white"></span>
                        <span class="mx-6">Total {{ $carts->count() }}</span>

                    </p>
                </div>

                <div class="Izwocg" style="width: 377.2px; height: 238.036px; transform: translate(0px, 0px) rotate(0deg);">
                    <img class="_7_i_XA" crossorigin="anonymous"
                        src="https://media.canva.com/v2/image-resize/format:PNG/height:768/quality:100/uri:ifs%3A%2F%2FM%2F052178d2-311a-42ef-92a3-d932e73f4f9e/watermark:F/width:1217?csig=AAAAAAAAAAAAAAAAAAAAAEj9SgBZ29TUGk9F_YcI9YIvotF3s5xjv6HKbVfZqVdM&amp;exp=1748715465&amp;osig=AAAAAAAAAAAAAAAAAAAAAKi74QT3LEUxeKsXoiratWkIQXc70lgdpabw4LkIHFYa&amp;signer=media-rpc&amp;x-canva-quality=screen_3x"
                        draggable="false" alt="">
                </div>
            </div>
        </div>
    @endsection
