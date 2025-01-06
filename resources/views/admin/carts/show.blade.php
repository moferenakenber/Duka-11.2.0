<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 space-y-4">

                    <!-- Cart Items -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Items in Cart:</h3>
                        @if ($cart->items->isEmpty())
                            <p class="text-gray-600">No items in this cart.</p>
                        @else
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Item Name</th>
                                        <th class="px-4 py-2 text-left">Quantity</th>
                                        <th class="px-4 py-2 text-left">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->items as $item)
                                        <tr class="border-b">
                                            <td class="px-4 py-2">{{ $item->name }}</td>
                                            <td class="px-4 py-2">{{ $item->pivot->quantity }}</td>
                                            <td class="px-4 py-2">${{ number_format($item->pivot->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{-- <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Item Name</th>
                                    <th class="px-4 py-2 text-left">Quantity</th>
                                    <th class="px-4 py-2 text-left">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->items as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $item->name }}</td>
                                        <td class="px-4 py-2">{{ $item->pivot->quantity }}</td>
                                        <td class="px-4 py-2">${{ number_format($item->pivot->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                    </div>

                    <!-- Add to Cart Button -->
                    {{-- <div class="mt-4">
                        <a href="{{ route('admin.cartn.cart.add', $cart->id) }}" class="text-blue-600 hover:text-blue-800">Add Item to Cart</a>
                    </div> --}}

                    <!-- Redirect to Items Page -->
                    <div class="mt-4">
                        <a href="{{ route('admin.items.index', ['cart_id' => $cart->id]) }}"
                            class="text-blue-600 hover:text-blue-800">
                            Add Item to Cart
                        </a>
                    </div>


                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.carts.index') }}" class="text-blue-600 hover:text-blue-800">Back to
                            Carts List</a>
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
