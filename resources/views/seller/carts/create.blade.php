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

            </div>

        </div>
    </div>


    <div class="flex flex-col h-full pb-16 pt-4 justify-center items-center">
        <!-- Full screen container for vertical space -->
        <!-- Scrollable and Alphabetically Sorted Customer List -->
        <form action="{{ route('admin.carts.store') }}" method="POST">
            @csrf

            <!-- Select Customer -->
            <div class="mb-4">
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Select
                    Customer</label>
                <select name="customer_id" id="customer_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select a customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Creat Cart Button -->
            <div class="mt-4">
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Create
                    Cart</button>
            </div>
        </form>

    </div>
@endsection
