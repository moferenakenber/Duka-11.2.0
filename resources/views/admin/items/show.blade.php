{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="p-6 space-y-4">
                    <!-- Item Details (same as before) -->

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="mt-4 space-y-4">
                            <!-- Select Cart -->
                            <label for="cart_id" class="font-semibold text-gray-700">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 text-gray-700 border rounded-md" onchange="toggleCartOptions()">
                                <option value="" selected>Create a New Cart</option>
                                @foreach (auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>

                            <!-- Customer Selection (appears only if 'Create a New Cart' is selected) -->
                            <div id="new_cart_customer_selector" class="hidden">
                                <label for="customer_id" class="font-semibold text-gray-700">Select Customer:</label>
                                <select name="customer_id" id="customer_id" class="w-40 p-2 text-gray-700 border rounded-md">
                                    <option value="" selected disabled>Select a Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity Selector (same as before) -->

                            <!-- Submit Button -->
                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
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
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
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
                            <img src="{{ $image }}" alt="Item Image" class="object-cover w-32 h-32 rounded-md">
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="mt-4 space-y-4">
                            <!-- Select Cart -->
                            <label for="cart_id" class="font-semibold text-gray-700">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 text-gray-700 border rounded-md">
                                <option value="" selected>Create a New Cart</option>
                                @foreach (auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity Selector -->
                            <div>
                                <label for="quantity_type" class="font-semibold text-gray-700">Choose Quantity Type:</label>
                                <select name="quantity_type" id="quantity_type" class="w-40 p-2 text-gray-700 border rounded-md" onchange="updateQuantityFields()">
                                    <option value="pieces" selected>Pieces</option>
                                    <option value="packets">Packets</option>
                                    <option value="cartons">Cartons</option>
                                </select>
                            </div>

                            <!-- Quantity Fields -->
                            <div class="flex items-center mt-4 space-x-4">
                                <!-- Pieces Quantity -->
                                <div id="pieces_field" class="w-20">
                                    <input type="number" name="pieces" id="pieces" value="1" min="1" max="{{ $item->stock }}"
                                           class="p-2 text-gray-700 border rounded-md" placeholder="Pieces" oninput="updateQuantities()">
                                    <span>pieces</span>
                                </div>

                                <!-- Packets Quantity -->
                                <div id="packets_field" class="hidden w-20">
                                    <input type="number" name="packets" id="packets" value="0" min="0" max="{{ $item->stock / $item->piecesinapacket }}"
                                           class="p-2 text-gray-700 border rounded-md" placeholder="Packets" oninput="updateQuantities()">
                                    <span>packets</span>
                                </div>

                                <!-- Cartons Quantity -->
                                <div id="cartons_field" class="hidden w-20">
                                    <input type="number" name="cartons" id="cartons" value="0" min="0" max="{{ $item->stock / ($item->piecesinapacket * $item->packetsinacartoon) }}"
                                           class="p-2 text-gray-700 border rounded-md" placeholder="Cartons" oninput="updateQuantities()">
                                    <span>cartons</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
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
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="p-4 mt-4 text-red-700 bg-red-100 border-l-4 border-red-500">
            <h3 class="font-semibold">There were some problems with your input:</h3>
            <ul class="pl-5 mt-2 list-disc">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $variantData = $item->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'color' => $variant->itemColor->name,
                'img' => asset($variant->itemColor->image_path),
                'size' => $variant->itemSize->name,
                'packaging' => $variant->itemPackagingType->name,
                'price' => $variant->price,
                'stock' => $variant->stock,
            ];
        });
    @endphp

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="p-6 space-y-4">
                    <!-- Item Name -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Name: </h3>
                        <p class="text-gray-600">{{ $item->product_name }}</p>
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
                        <p class="text-gray-600">{{ $item->piecesinapacket }} pieces per packet,
                            {{ $item->packetsinacartoon }} packets per carton</p>
                    </div>

                    <!-- Item Image -->
                    {{-- @php
                        $images = json_decode($item->images, true); // Decode JSON to array
                    @endphp --}}

                    @php
                        $variantData = $item->variants->map(function ($variant) {
                            return [
                                'id' => $variant->id,
                                'color' => $variant->itemColor->name,
                                'img' => asset($variant->itemColor->image_path),
                                'size' => $variant->itemSize->name,
                                'packaging' => $variant->itemPackagingType->name,
                                'price' => $variant->price,
                                'stock' => $variant->stock,
                            ];
                        });
                    @endphp

                    @if ($variantData->isNotEmpty())
                        @foreach ($variantData as $variant)
                            <img src="{{ $variant['img'] }}" alt="Variant Image"
                                class="object-cover w-32 h-32 rounded-md">
                        @endforeach
                    @else
                        <p>No variant images available</p>
                    @endif


                    <!-- Add to Cart Button -->
                    {{-- <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                        @csrf
                        <div class="flex items-center mt-4 space-x-4">
                            <label for="cart_id" class="font-semibold text-gray-700">Select Cart:</label>
                            <select name="cart_id" id="cart_id" class="w-40 p-2 text-gray-700 border rounded-md">
                                @foreach (auth()->user()->carts as $cart)
                                    <option value="{{ $cart->id }}">{{ $cart->name ?? 'Cart ' . $cart->id }}</option>
                                @endforeach
                            </select>
                            <label for="quantity" class="font-semibold text-gray-700">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $item->stock }}"
                                   class="w-20 p-2 text-gray-700 border rounded-md">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Add to Cart
                            </button>
                        </div>
                    </form> --}}


                    @if (auth()->user()->carts->isEmpty())
                        <div class="mt-4 font-semibold text-red-600">
                            You don't have any carts. Please <a href="{{ route('admin.carts.create') }}"
                                class="text-blue-600 underline">create a cart</a> first.
                        </div>
                    @else
                        <form method="POST" action="{{ route('admin.cart.add', $item->id) }}">
                            @csrf
                            <div class="flex items-center mt-4 space-x-4">
                                <label for="cart_id" class="font-semibold text-gray-700">Select Cart:</label>
                                <select name="cart_id" id="cart_id" class="w-40 p-2 text-gray-700 border rounded-md">
                                    @foreach (auth()->user()->carts as $cart)
                                        @if ($cart->customer)
                                            <!-- Check if the cart has a related customer -->
                                            <option value="{{ $cart->customer->id }}">
                                                {{ $cart->customer->first_name }} {{ $cart->customer->last_name }}
                                                (Created by: {{ $cart->seller->first_name }})
                                                <!-- Indicate who created the cart -->
                                            </option>
                                        @else
                                            <option value="{{ $cart->id }}">
                                                Cart {{ $cart->id }}
                                                (Created by: {{ $cart->seller->first_name }})
                                                <!-- Indicate who created the cart -->
                                            </option>
                                        @endif
                                    @endforeach


                                </select>
                                <label for="quantity" class="font-semibold text-gray-700">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    max="{{ $item->stock }}" class="w-20 p-2 text-gray-700 border rounded-md">
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    @endif


                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.items.index') }}" class="text-blue-600 hover:text-blue-800">Back to
                            Items List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h1 class="text-xl font-bold">{{ $item->name }}</h1>

    <h2 class="mt-4 text-lg font-semibold">Variants:</h2>
    @foreach ($item->variants as $variant)
        <div class="p-4 mb-2 border rounded">
            <p><strong>Color:</strong> {{ $variant->itemColor->name }}</p>
            <p><strong>Size:</strong> {{ $variant->itemSize->name }}</p>
            <p><strong>Packaging:</strong> {{ $variant->itemPackagingType->name }}</p>
            <p><strong>Price:</strong> {{ $variant->price }}</p>
            <p><strong>Stock:</strong> {{ $variant->stock }}</p>

            @if ($variant->itemColor && $variant->itemColor->image_path)
                <img src="{{ asset($variant->itemColor->image_path) }}" alt="{{ $variant->itemColor->name }}"
                    class="w-24 h-24 mt-2 rounded">
            @endif
        </div>
    @endforeach

    <div class="overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols">
            <thead>
                <tr>
                    <th>#</th>
                    <td>Item</td>
                    <td>Color</td>
                    <td>Size</td>
                    <td>Packaging</td>
                    <td>Price</td>
                    <td>Stock</td>
                    <td>Owner</td>
                    <td>Image</td>
                    <td>Status</td>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->variants as $index => $variant)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $item->product_name ?? '-' }}</td>
                        <td>{{ $variant->itemColor->name ?? '-' }}</td>
                        <td>{{ $variant->itemSize->name ?? '-' }}</td>
                        <td>{{ $variant->itemPackagingType->name ?? '-' }}</td>
                        <td>${{ number_format($variant->price, 2) }}</td>
                        <td>{{ $variant->stock }}</td>
                        <td>{{ $variant->owner->name ?? '-' }}</td>
                        <td>
                            @if ($variant->image)
                                <img src="{{ asset('storage/' . $variant->image) }}" alt="Variant Image"
                                    class="w-6 h-6 rounded" />
                            @elseif ($variant->itemColor && $variant->itemColor->image_path)
                                <img src="{{ asset($variant->itemColor->image_path) }}" alt="Color Image"
                                    class="w-6 h-6 rounded" />
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $variant->is_active ? 'success' : 'neutral' }}">
                                {{ $variant->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <th>
                            <a href="{{ route('admin.items.edit', $variant) }}" class="btn btn-xs btn-outline">Edit</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <td>Item</td>
                    <td>Color</td>
                    <td>Size</td>
                    <td>Packaging</td>
                    <td>Price</td>
                    <td>Stock</td>
                    <td>Owner</td>
                    <td>Image</td>
                    <td>Status</td>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>


    <div class="overflow-x-auto">
        <table class="table">
            <!-- Item Table Head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Sold</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if ($item)
                    <!-- Item Row -->
                    <tr class="bg-base-100">
                        <th>
                            <input type="checkbox" class="checkbox" />
                        </th>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-12 h-12 mask mask-squircle">
                                        <img
                                            src="{{ asset(json_decode($item->product_images)[0] ?? 'default.jpg') }}" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $item->product_name }}</div>
                                    <div class="text-sm opacity-50">{{ $item->product_description }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status == 'active' ? 'success' : 'neutral' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->sold_count }}</td>
                        <th>
                            <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-xs btn-outline">Edit</a>
                        </th>
                    </tr>

                    <!-- Variant Table Below Item -->
                    <tr class="bg-base-200">
                        <td colspan="6">
                            <div class="overflow-x-auto">
                                <table class="table table-xs">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Packaging</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Owner</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->variants as $index => $variant)
                                            <tr>
                                                <th>{{ $index + 1 }}</th>
                                                <td>{{ $variant->itemColor->name ?? '-' }}</td>
                                                <td>{{ $variant->itemSize->name ?? '-' }}</td>
                                                <td>{{ $variant->itemPackagingType->name ?? '-' }}</td>
                                                <td>${{ number_format($variant->price, 2) }}</td>
                                                <td>{{ $variant->stock }}</td>
                                                <td>{{ $variant->owner->name ?? '-' }}</td>
                                                <td>
                                                    @if ($variant->image)
                                                        <img src="{{ asset('storage/' . $variant->image) }}"
                                                            class="w-6 h-6 rounded" />
                                                    @elseif ($variant->itemColor && $variant->itemColor->image_path)
                                                        <img src="{{ asset($variant->itemColor->image_path) }}"
                                                            class="w-6 h-6 rounded" />
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $variant->is_active ? 'success' : 'neutral' }}">
                                                        {{ $variant->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.items.edit', $variant) }}"
                                                        class="btn btn-xs btn-outline">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- <h2 class="mt-4 text-lg font-semibold">Item Images:</h2>
    @if ($item->variants->itemColor->image_path->isNotEmpty())
        <div class="flex gap-4">
            @foreach ($item->itemImages as $image)
                <img src="{{ asset($image->path) }}" alt="Item Image" class="object-cover w-24 h-24 rounded">
            @endforeach
        </div>
    @else
        <p>No images available.</p>
    @endif --}}

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
