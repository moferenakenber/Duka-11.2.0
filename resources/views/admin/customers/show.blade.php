<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customer Details') }}
            </h2>

            <!-- Right side: Back to Customers Button -->
            <a href="{{ route('admin.customers.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to Customers') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <!-- Customer Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Customer Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <strong>First Name:</strong>
                                <p>{{ $customer->first_name }}</p>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <strong>Last Name:</strong>
                                <p>{{ $customer->last_name }}</p>
                            </div>

                            <!-- Email -->
                            <div>
                                <strong>Email:</strong>
                                <p>{{ $customer->email }}</p>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <strong>Phone Number:</strong>
                                <p>{{ $customer->phone_number }}</p>
                            </div>

                            <!-- City -->
                            <div>
                                <strong>City:</strong>
                                <p>{{ $customer->city }}</p>
                            </div>

                            <!-- Created By -->
                            <div>
                                <strong>Created By:</strong>
                                <p>
                                    @if ($customer->creator)
                                        {{ $customer->creator->first_name }} {{ $customer->creator->last_name }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <!-- Created At -->
                            <div>
                                <strong>Created At:</strong>
                                <p>{{ $customer->created_at->format('M d, Y H:i') }}</p>
                            </div>

                            <!-- Updated At -->
                            <div>
                                <strong>Updated At:</strong>
                                <p>{{ $customer->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex space-x-4">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.customers.edit', $customer->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
</x-app-layout>
