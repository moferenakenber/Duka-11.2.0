@extends('seller.layouts.app')

@section('content')
{{--
    <div class="flex flex-col items-center justify-center h-full pt-2">
        <div
            class="w-full max-w-2xl p-4 mx-auto overflow-y-auto text-gray-900 bg-white shadow-sm dark:text-gray-100 dark:bg-gray-800 sm:rounded-lg">

            <!-- Top nav -->
            <!-- Button Container to align buttons on opposite corners -->
            <div class="flex justify-between w-full">

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

            </div>

        </div>
    </div>--}}

    <div class="min-h-screen bg-gray-100">
        <div class="container mx-auto p-2.5">
            <div class="relative flex items-center justify-between mb-4">
                <!-- Back Button -->
                <a href="/seller/carts" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <!-- Title -->
                <h1 class="absolute text-xl font-semibold transform -translate-x-1/2 left-1/2">Add Cart</h1>
                <!-- Right Arrow Icon -->
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
                </svg> --}}
            </div>

    <div class="flex flex-col items-center justify-center h-full pt-4 pb-16">
        <!-- Full screen container for vertical space -->
        <!-- Scrollable and Alphabetically Sorted Customer List -->
        <form action="{{ route('seller.carts.store') }}" method="POST">
            @csrf

            <!-- Select Customer -->
            <div class="mb-4">
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Select
                    Customer</label>
                <select name="customer_id" id="customer_id"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="">Select a customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="seller_id" value="{{ auth()->id() }}">


            <!-- Creat Cart Button -->
            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Create
                    Cart</button>
            </div>


        </form>

    </div>
@endsection
