<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Carts') }}
            {{-- {{dd(__('Your Carts'))}}
           {{ dd(Lang::get('cart.Your Carts'));}} --}}
            {{__('cart.Your Carts')}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="mb-4">
                        <a href="{{ route('admin.carts.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Create New Cart</a>
                    </div>
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Cart</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr class="border-b">
                                    <td class="px-4 py-2">
                                        @if ($cart->customer)
                                            <!-- Display customer's full name (stored in 'name' attribute) -->
                                            {{ $cart->customer->name }}'s Cart
                                        @else
                                            No customer assigned
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.carts.show', $cart->id) }}" class="text-blue-600 hover:text-blue-800">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
