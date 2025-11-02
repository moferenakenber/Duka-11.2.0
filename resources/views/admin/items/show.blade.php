
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

    <div class="py-12" x-data="{ variants: [], showVariants: false }">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="p-6 space-y-4">

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

                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($item)
                                    <!-- Item Row -->
                                    <tr class="bg-base-100">

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
                                                    <div class="text-sm opacity-50">{{ $item->product_description }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add a Button Somewhere -->
                                            <div class="mb-4 text-right">
                                                <button type="button"
                                                    class="px-4 py-2 btn btn-primary"
                                                    @click="showVariants = !showVariants">
                                                    Add Variant
                                                </button>
                                            </div>

                                        </td>
                                    </tr>

                                    <!-- Variant Table Below Item -->
                                    <tr class="bg-base-200">
                                        <td colspan="6">
                                            <div class="overflow-x-auto">
                                                <table class="table table-xs">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" class="checkbox" />
                                                            </th>
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
                                                                <th>
                                                                    <input type="checkbox" class="checkbox" />
                                                                </th>
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

                                                        <!-- Variant Section (Initially Hidden) -->
<div x-show="showVariants" x-transition class="p-4 mt-4 bg-base-200 rounded-xl">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Variants</h3>
        <button type="button" class="btn btn-outline btn-sm" @click="variants.push({})">+ Add New Variant</button>
    </div>

    <template x-for="(variant, index) in variants" :key="index">
        <div class="p-4 mb-4 border bg-base-100 rounded-xl border-base-300">
            <div class="grid items-end grid-cols-1 gap-3 md:grid-cols-6">
                <!-- Color -->
                <div>
                    <label class="label"><span class="label-text">Color</span></label>
                    {{-- <select :name="'variants['+index+'][item_color_id]'" class="w-full select select-bordered">
                        <option value="">--</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select> --}}
                </div>

                <!-- Size -->
                <div>
                    <label class="label"><span class="label-text">Size</span></label>
                    <select :name="'variants['+index+'][item_size_id]'" class="w-full select select-bordered">
                        <option value="">--</option>
                        {{-- @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <!-- Packaging -->
                <div>
                    <label class="label"><span class="label-text">Packaging</span></label>
                    <select :name="'variants['+index+'][item_packaging_type_id]'" class="w-full select select-bordered">
                        <option value="">--</option>
                        {{-- @foreach ($packagingTypes as $pack)
                            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <!-- Stock -->
                <div>
                    <label class="label"><span class="label-text">Stock</span></label>
                    <input type="number" min="0" :name="'variants['+index+'][stock]'" class="w-full input input-bordered">
                </div>

                <!-- Price -->
                <div>
                    <label class="label"><span class="label-text">Price</span></label>
                    <input type="number" step="0.01" :name="'variants['+index+'][price]'" class="w-full input input-bordered">
                </div>

                <!-- Owner -->
                <div class="flex gap-2">
                    <div class="w-full">
                        <label class="label"><span class="label-text">Owner</span></label>
                        <select :name="'variants['+index+'][owner_id]'" class="w-full select select-bordered">
                            <option value="">--</option>
                            @foreach ($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-8">
                        <button type="button" class="btn btn-error btn-sm" @click="variants.splice(index, 1)">✕</button>
                    </div>
                </div>

            </div>
        </div>
    </template>
</div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


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
