<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">

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

                        <!-- Select Seller -->
                        <div class="mb-4">
                            <label for="seller_id" class="block text-sm font-medium text-gray-700">Select Seller</label>
                            <select name="seller_id" id="seller_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Select a seller</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->first_name }}
                                        {{ $seller->last_name }} (Seller)</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Create
                                Cart</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
