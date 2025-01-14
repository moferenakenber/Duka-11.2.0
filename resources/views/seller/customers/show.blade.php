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
                <a href="{{ route('seller.customers.edit', $customer->id) }}"
                    class="inline-flex items-center h-10 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Edit
                </a>
            </div>

        </div>
    </div>


    <!-- Customer Details-->
    <div class="pt-2 pb-2 flex flex-col h-full justify-center items-center">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg flex-1 overflow-y-auto mx-auto w-full max-w-2xl">
            <div class="p-4 text-gray-900 dark:text-gray-100">

                <!-- Customer Details -->
                <div class="min-h-[140vh] overflow-y-auto flex flex-col">
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md flex-grow">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Customer Details</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">First Name</strong>
                                <p class="text-gray-900 dark:text-gray-100">{{ $customer->first_name }}</p>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Last Name</strong>
                                <p class="text-gray-900 dark:text-gray-100">{{ $customer->last_name }}</p>
                            </div>

                            <!-- Email -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Email</strong>
                                <p class="text-gray-900 dark:text-gray-100">{{ $customer->email }}</p>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Phone Number</strong>
                                <p class="text-gray-900 dark:text-gray-100">
                                    <a href="tel:{{ $customer->phone_number }}" class="text-blue-500 hover:underline">
                                        {{ $customer->phone_number }}
                                    </a>
                                </p>
                            </div>


                            <!-- City -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">City</strong>
                                <p class="text-gray-900 dark:text-gray-100">{{ $customer->city }}</p>
                            </div>

                            <!-- Created By -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Created By</strong>
                                <p class="text-gray-900 dark:text-gray-100">
                                    @if ($customer->creator)
                                        {{ $customer->creator->first_name }} {{ $customer->creator->last_name }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <!-- Created At -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Created At</strong>
                                <p class="text-gray-900 dark:text-gray-100">
                                    {{ $customer->created_at->format('M d, Y H:i') }}</p>
                            </div>

                            <!-- Updated At -->
                            <div>
                                <strong class="block text-gray-700 dark:text-gray-300">Updated At</strong>
                                <p class="text-gray-900 dark:text-gray-100">
                                    {{ $customer->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    </div>
    @if ($errors->any())
        <div class="mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="pt-2 pb-16 flex flex-col h-full justify-center items-center">
        <div
            class="p-4 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-y-auto mx-auto max-w-2xl w-full">

            <!-- Delete Button -->
            <div class="w-full mx-auto">
                <!-- Delete Button -->
                <form action="{{ route('seller.customers.destroy', $customer->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center w-full py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Delete
                    </button>

                </form>
            </div>

        </div>
    </div>





@endsection
