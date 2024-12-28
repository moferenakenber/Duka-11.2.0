{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <!-- Item Details (same as before) -->

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="mt-4 space-y-4">
                            <!-- Select Cart -->
                            <label for="cart_id" class="text-gray-700 font-semibold">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 border rounded-md text-gray-700" onchange="toggleCartOptions()">
                                <option value="" selected>Create a New Cart</option>
                                @foreach(auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>

                            <!-- Customer Selection (appears only if 'Create a New Cart' is selected) -->
                            <div id="new_cart_customer_selector" class="hidden">
                                <label for="customer_id" class="text-gray-700 font-semibold">Select Customer:</label>
                                <select name="customer_id" id="customer_id" class="w-40 p-2 border rounded-md text-gray-700">
                                    <option value="" selected disabled>Select a Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity Selector (same as before) -->

                            <!-- Submit Button -->
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.items.index') }}" class="text-blue-600 hover:text-blue-800">Back to Items List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to manage quantity and cart creation behavior -->
    <script>
        // Function to toggle the customer selection form based on cart selection
        function toggleCartOptions() {
            const cartSelect = document.getElementById('cart_id');
            const newCartCustomerSelector = document.getElementById('new_cart_customer_selector');

            if (cartSelect.value === "") {
                newCartCustomerSelector.classList.remove('hidden'); // Show customer selection
            } else {
                newCartCustomerSelector.classList.add('hidden'); // Hide customer selection
            }
        }

        // Initialize the state based on current cart selection
        window.onload = toggleCartOptions;
    </script>
</x-app-layout> --}}

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <!-- Item Name -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Name: </h3>
                        <p class="text-gray-600">{{ $item->name }}</p>
                    </div>

                    <!-- Item Description -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Description: </h3>
                        <p class="text-gray-600">{{ $item->description }}</p>
                    </div>

                    <!-- Item Price -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Price: </h3>
                        <p class="text-gray-600">${{ number_format($item->price, 2) }}</p>
                    </div>

                    <!-- Item Stock -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Stock: </h3>
                        <p class="text-gray-600">{{ $item->stock }}</p>
                    </div>

                    <!-- Item Status -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Status: </h3>
                        <p class="text-gray-600">{{ ucfirst($item->status) }}</p>
                    </div>

                    <!-- Item Packaging -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Packaging: </h3>
                        <p class="text-gray-600">{{ $item->piecesinapacket }} pieces per packet, {{ $item->packetsinacartoon }} packets per carton</p>
                    </div>

                    <!-- Item Image -->
                    @php
                    $images = json_decode($item->images, true); // Decode JSON to array
                    @endphp

                    @if (is_array($images) && count($images) > 0)
                        @foreach ($images as $image)
                            <img src="{{ $image }}" alt="Item Image" class="w-32 h-32 object-cover rounded-md">
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="mt-4 space-y-4">
                            <!-- Select Cart -->
                            <label for="cart_id" class="text-gray-700 font-semibold">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 border rounded-md text-gray-700">
                                <option value="" selected>Create a New Cart</option>
                                @foreach(auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity Selector -->
                            <div>
                                <label for="quantity_type" class="text-gray-700 font-semibold">Choose Quantity Type:</label>
                                <select name="quantity_type" id="quantity_type" class="w-40 p-2 border rounded-md text-gray-700" onchange="updateQuantityFields()">
                                    <option value="pieces" selected>Pieces</option>
                                    <option value="packets">Packets</option>
                                    <option value="cartons">Cartons</option>
                                </select>
                            </div>

                            <!-- Quantity Fields -->
                            <div class="mt-4 flex items-center space-x-4">
                                <!-- Pieces Quantity -->
                                <div id="pieces_field" class="w-20">
                                    <input type="number" name="pieces" id="pieces" value="1" min="1" max="{{ $item->stock }}"
                                           class="p-2 border rounded-md text-gray-700" placeholder="Pieces" oninput="updateQuantities()">
                                    <span>pieces</span>
                                </div>

                                <!-- Packets Quantity -->
                                <div id="packets_field" class="w-20 hidden">
                                    <input type="number" name="packets" id="packets" value="0" min="0" max="{{ $item->stock / $item->piecesinapacket }}"
                                           class="p-2 border rounded-md text-gray-700" placeholder="Packets" oninput="updateQuantities()">
                                    <span>packets</span>
                                </div>

                                <!-- Cartons Quantity -->
                                <div id="cartons_field" class="w-20 hidden">
                                    <input type="number" name="cartons" id="cartons" value="0" min="0" max="{{ $item->stock / ($item->piecesinapacket * $item->packetsinacartoon) }}"
                                           class="p-2 border rounded-md text-gray-700" placeholder="Cartons" oninput="updateQuantities()">
                                    <span>cartons</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.items.index') }}" class="text-blue-600 hover:text-blue-800">Back to Items List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to manage quantity updates -->
    <script>
        // Function to update the visibility of the quantity fields based on user selection
        function updateQuantityFields() {
            const quantityType = document.getElementById('quantity_type').value;
            document.getElementById('pieces_field').classList.add('hidden');
            document.getElementById('packets_field').classList.add('hidden');
            document.getElementById('cartons_field').classList.add('hidden');

            if (quantityType === 'pieces') {
                document.getElementById('pieces_field').classList.remove('hidden');
            } else if (quantityType === 'packets') {
                document.getElementById('packets_field').classList.remove('hidden');
            } else if (quantityType === 'cartons') {
                document.getElementById('cartons_field').classList.remove('hidden');
            }
            updateQuantities();
        }

        // Function to update quantities based on selected field
        function updateQuantities() {
            const pieces = document.getElementById('pieces').value;
            const packets = document.getElementById('packets').value;
            const cartons = document.getElementById('cartons').value;

            const piecesPerPacket = {{ $item->piecesinapacket }};
            const packetsPerCarton = {{ $item->packetsinacartoon }};

            // Update packets from pieces
            if (pieces) {
                document.getElementById('packets').value = Math.floor(pieces / piecesPerPacket);
                document.getElementById('cartons').value = Math.floor(pieces / (piecesPerPacket * packetsPerCarton));
            }

            // Update pieces from packets
            if (packets) {
                document.getElementById('pieces').value = packets * piecesPerPacket;
                document.getElementById('cartons').value = Math.floor(packets / packetsPerCarton);
            }

            // Update packets from cartons
            if (cartons) {
                document.getElementById('pieces').value = cartons * piecesPerPacket * packetsPerCarton;
                document.getElementById('packets').value = cartons * packetsPerCarton;
            }
        }

        // Call the update function when the page loads
        window.onload = updateQuantityFields;
    </script>
</x-app-layout>
 --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <!-- Item Name -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Name: </h3>
                        <p class="text-gray-600">{{ $item->name }}</p>
                    </div>

                    <!-- Item Description -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Description: </h3>
                        <p class="text-gray-600">{{ $item->description }}</p>
                    </div>

                    <!-- Item Price -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Price: </h3>
                        <p class="text-gray-600">${{ number_format($item->price, 2) }}</p>
                    </div>

                    <!-- Item Stock -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Stock: </h3>
                        <p class="text-gray-600">{{ $item->stock }}</p>
                    </div>

                    <!-- Item Status -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Status: </h3>
                        <p class="text-gray-600">{{ ucfirst($item->status) }}</p>
                    </div>

                    <!-- Item Packaging -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Packaging: </h3>
                        <p class="text-gray-600">{{ $item->piecesinapacket }} pieces per packet, {{ $item->packetsinacartoon }} packets per carton</p>
                    </div>

                     <!-- Item Image -->
                     @php
                     $images = json_decode($item->images, true); // Decode JSON to array
                    @endphp

                    @if (is_array($images) && count($images) > 0)
                        @foreach ($images as $image)
                            <img src="{{ $image }}" alt="Item Image" class="w-32 h-32 object-cover rounded-md">
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif


                    <!-- Add to Cart Button -->
                    {{-- <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="mt-4 flex items-center space-x-4">
                            <label for="cart_id" class="text-gray-700 font-semibold">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 border rounded-md text-gray-700">
                                @foreach(auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>
                            <label for="quantity" class="text-gray-700 font-semibold">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $item->stock }}"
                                   class="w-20 p-2 border rounded-md text-gray-700">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Add to Cart
                            </button>
                        </div>
                    </form> --}}


                    @if(auth()->user()->carts->isEmpty())
                        <div class="mt-4 text-red-600 font-semibold">
                            You don't have any carts. Please <a href="{{ route('admin.carts.create') }}" class="text-blue-600 underline">create a cart</a> first.
                        </div>
                    @else
                        <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                            @csrf
                            <div class="mt-4 flex items-center space-x-4">
                                <label for="cart_id" class="text-gray-700 font-semibold">Select Cart:</label>
                                <select name="cart_id" id="cart_id" class="w-40 p-2 border rounded-md text-gray-700">
                                    @foreach(auth()->user()->carts as $cart)
                                        <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                    @endforeach
                                </select>
                                <label for="quantity" class="text-gray-700 font-semibold">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $item->stock }}"
                                    class="w-20 p-2 border rounded-md text-gray-700">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    @endif


                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.items.index') }}" class="text-blue-600 hover:text-blue-800">Back to Items List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
