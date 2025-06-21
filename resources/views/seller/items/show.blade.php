@extends('seller.layouts.app')


@php
    // Item-level images
    $itemImages = collect();
    if ($item->product_images) {
        $decodedImages = json_decode($item->product_images, true);
        if (is_array($decodedImages)) {
            $itemImages = collect($decodedImages);
        }
    }

    // Variant color images
    $variantColorImages = $item->variants
        ->map(function ($variant) {
            return asset($variant->itemColor->image_path);
        })
        ->unique();

    // Size-related images (assuming you have image_path in itemSize)
    $sizeImages = $item->variants
        ->map(function ($variant) {
            return optional($variant->itemSize)->image_path ? asset($variant->itemSize->image_path) : null;
        })
        ->filter()
        ->unique();

    // Packaging images (assuming you have image_path in itemPackagingType)
    $packagingImages = $item->variants
        ->map(function ($variant) {
            return optional($variant->itemPackagingType)->image_path
                ? asset($variant->itemPackagingType->image_path)
                : null;
        })
        ->filter()
        ->unique();

    // Merge them into one image collection
    $allImages = $itemImages
        ->merge($variantColorImages)
        ->merge($sizeImages)
        ->merge($packagingImages)
        ->unique()
        ->values();
@endphp




{{-- 0 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_1.jpg"
     1 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_2.jpg"
     2 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_color_1.jpg"
     3 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_color_2.jpg"
     4 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_red.jpg"
     5 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_blue.jpg"
     6 : "http://duka-11.2.0.local:8086/images/sizes/s.png"
     7 : "http://duka-11.2.0.local:8086/images/sizes/l.png" --}}

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

@section('content')
    <div class="max-w-4xl mx-auto p-6 pb-16 overflow-y-auto max-h-[100vh]">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">

            {{-- Swiper Image Slider --}}
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse ($allImages as $image)
                        <div class="swiper-slide">
                            <img src="{{ $image }}" alt="Product Image" class="object-cover w-full rounded">
                        </div>
                    @empty
                        <div class="p-4 swiper-slide">No images available.</div>
                    @endforelse
                </div>

                {{-- Arrows + Dots --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>

            {{-- Table of $variantData --}}

            <script>
                const variantData = @json($variantData);
                console.log('$variantData', @json($variantData));
                console.log('$allImages', @json($allImages));
            </script>


            <div class="p-4 overflow-x-auto">
                <table class="w-full text-sm border border-gray-300 table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Variant ID</th>
                            <th class="px-4 py-2 border">Image</th>

                            {{-- Combination --}}
                            <th class="px-4 py-2 border">Color</th>
                            <th class="px-4 py-2 border">Size</th>
                            <th class="px-4 py-2 border">Packaging</th>

                            {{-- Variant Details --}}
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Stock</th>

                            {{-- Owner --}}
                            <th class="px-4 py-2 border">Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->variants as $variant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $variant->id }}</td>

                                {{-- Variant image --}}
                                <td class="px-4 py-2 border">
                                    @if ($variant->image_path)
                                        <img src="{{ asset($variant->image_path) }}" alt="Variant Image"
                                            class="object-cover w-10 h-10 rounded" />
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- Color --}}
                                <td class="px-4 py-2 border text-center">
                                    @if (!empty($variant->itemColor))
                                        <div class="flex flex-col items-center space-y-1">
                                            <span class="text-xs text-gray-400">ID: {{ $variant->itemColor->id }}</span>
                                            <span
                                                class="text-sm font-medium text-gray-800">{{ $variant->itemColor->name }}</span>

                                            @if (!empty($variant->itemColor->image_path))
                                                <img src="{{ asset($variant->itemColor->image_path) }}"
                                                    alt="{{ $variant->itemColor->name }}"
                                                    class="w-8 h-8 rounded-full border border-gray-300 shadow-sm object-cover" />
                                            @else
                                                <span class="text-xs text-gray-400">No Image</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">N/A</span>
                                    @endif
                                </td>
                                {{-- Size --}}
                                <td class="px-4 py-2 border text-center">
                                    @if (!empty($variant->itemSize))
                                        <div class="flex flex-col items-center space-y-1">
                                            <span class="text-xs text-gray-400">ID: {{ $variant->itemSize->id }}</span>
                                            <span
                                                class="text-sm font-medium text-gray-800">{{ $variant->itemSize->name }}</span>
                                            <span class="text-xs text-gray-500 italic text-center max-w-[120px]">
                                                {{ $variant->itemSize->description ?? 'No description' }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">N/A</span>
                                    @endif
                                </td>
                                {{-- PackagingType --}}
                                <td class="px-4 py-2 border text-center">
                                    @if (!empty($variant->itemPackagingType))
                                        <div class="flex flex-col items-center space-y-1">
                                            <span class="text-xs text-gray-400">ID:
                                                {{ $variant->itemPackagingType->id }}</span>
                                            <span
                                                class="text-sm font-medium text-gray-800">{{ $variant->itemPackagingType->name }}</span>
                                            <span class="text-xs text-gray-500 italic text-center max-w-[140px]">
                                                {{ $variant->itemPackagingType->details ?? 'No details' }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">N/A</span>
                                    @endif
                                </td>


                                {{-- Variant price/stock --}}
                                <td class="px-4 py-2 border">{{ $variant->price }}</td>
                                <td class="px-4 py-2 border">{{ $variant->stock }}</td>

                                {{-- Owner --}}
                                <td class="px-4 py-2 border">
                                    {{ $variant->owner->name ?? 'N/A' }} <br>
                                    <small class="text-gray-500">{{ $variant->owner->email ?? '' }}</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Product Info --}}
            <div class="p-6">
                {{-- <h2 class="text-2xl font-semibold text-gray-800">{{ $item->product_name }}</h2> --}}
                <h2 class="text-2xl font-semibold text-gray-800 font-fancy">
                    {{ $item->product_name }}
                </h2>


                <p class="mt-2 text-gray-600 font-fancy">
                    {{ $item->product_description }}
                </p>

                <div class="flex items-center justify-between mt-4 font-fancy">

                    <!-- Left: Current Price and Original Price -->
                    <div>
                        <span class="text-3xl font-bold text-red-500">
                            ฿{{ number_format($item->price, 0) }}
                        </span>

                        @if ($item->discount_price)
                            <span class="ml-2 text-gray-400 line-through">
                                ฿{{ number_format($item->original_price, 0) }}
                            </span>
                        @endif
                    </div>

                    <!-- Right: Discount Percentage -->
                    @if ($item->discount_price)
                        <div>
                            <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-full">
                                -{{ $item->discount_percentage }}%
                            </span>
                        </div>
                    @endif

                </div>



                @if ($item->has_discount)
                    <div class="mt-4">
                        <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded">Discount Available</span>
                    </div>
                @endif

                {{-- <div class="flex mt-6 space-x-4">
                    <button @click="showModal = true"
                        class="flex-1 px-6 py-2 text-lg text-white bg-blue-500 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                    <button class="flex-1 px-6 py-2 text-lg text-white bg-red-500 rounded hover:bg-red-600">Buy Now</button>
                </div> --}}
                {{--

                <div x-data="variantSelector({{ $variantData->toJson() }})" x-init="init()" class="space-y-4">
                    <!-- Dropdown -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Choose Color:</label>
                        <select x-model="selectedColor" @change="updatePrice()"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select Color --</option>
                            <template x-for="color in colors" :key="color">
                                <option x-text="color" :value="color"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Price Display -->
                    <div x-show="selectedPrice !== null">
                        <p class="text-lg font-semibold">
                            Price: <span x-text="formattedPrice"></span>
                        </p>
                    </div>
                </div> --}}

                <div x-data="{ open: false }" class="mb-4">
                    <!-- Toggle Circle Button with More Icon -->
                    <button @click="open = !open"
                        class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full hover:bg-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v.01M12 12v.01M12 18v.01" />
                        </svg>
                    </button>

                    <!-- Details Container -->
                    <div x-show="open" x-transition
                        class="p-4 mt-3 space-y-4 border border-gray-200 rounded-lg shadow bg-gray-50">

                        <!-- Product Images -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Product Images</h4>
                            <ul class="space-y-1 text-xs text-gray-600">
                                @foreach (explode("\n", $item->product_images) as $img)
                                    <li>- {{ $img }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Variation -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Variation</h4>
                            <p class="text-xs text-gray-600 break-words">{{ $item->variation }}</p>
                        </div>

                        <!-- Price -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Price</h4>
                            <p class="text-xs text-gray-600 break-words">{{ $item->price }}</p>
                        </div>

                        <!-- Product Name -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Product Name</h4>
                            <p class="text-xs text-gray-600 break-words">{{ $item->product_name }}</p>
                        </div>

                        <!-- Product Description (line by line) -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Product Description</h4>
                            <ul class="space-y-1 text-xs text-gray-600">
                                @foreach (explode("\n", $item->product_description) as $line)
                                    <li>- {{ $line }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Packaging Details (line by line) -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Packaging Details</h4>
                            <ul class="space-y-1 text-xs text-gray-600">
                                @foreach (explode("\n", $item->packaging_details) as $pack)
                                    <li>- {{ $pack }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Colors List -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Colors</h4>
                            <ul class="space-y-1 text-xs text-gray-600">
                                @foreach (json_decode($item->colors, true) as $color)
                                    <li>- {{ $color['name'] }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Variant Colors List -->
                        <div class="p-4 bg-white rounded shadow">
                            <h4 class="mb-2 text-sm font-bold text-gray-700">Variant Colors</h4>
                            <ul class="space-y-1 text-xs text-gray-600">
                                @foreach ($item->variants as $variant)
                                    <li>- {{ $variant->itemColor->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- table of $variantData -->
                        <table class="min-w-full text-sm text-left">
                            <thead class="text-xs font-semibold text-gray-700 bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2">Color</th>
                                    <th class="px-4 py-2">Size</th>
                                    <th class="px-4 py-2">Packaging</th>
                                    <th class="px-4 py-2">Price</th>
                                    <th class="px-4 py-2">Stock</th>
                                    <th class="px-4 py-2">Owner</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($item->variants as $variant)
                                    <tr>
                                        <td class="px-4 py-2">{{ $variant->itemColor->name }}</td>
                                        <td class="px-4 py-2">{{ $variant->itemSize->name }}</td>
                                        <td class="px-4 py-2">{{ $variant->itemPackagingType->name }}</td>
                                        <td class="px-4 py-2">{{ number_format($variant->price, 2) }}</td>
                                        <td class="px-4 py-2">{{ $variant->stock }}</td>
                                        <td class="px-4 py-2">{{ $variant->owner->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>



                <script>
                    function variantSelector(variants) {
                        return {
                            showModal: false,
                            variants: variants,
                            selectedColor: '',
                            selectedSize: null,
                            selectedPackaging: null,
                            selectedPrice: null,
                            selectedStock: null,
                            selectedImg: '/img/default.jpg',
                            quantity: 1,


                            init() {
                                this.updatePrice();
                                this.selectedPrice = null;
                                this.selectedStock = null;
                            },

                            get colors() {
                                return [...new Set(this.variants.map(v => v.color))];
                            },

                            // get colors() {
                            //     // Get unique colors
                            //     const seen = new Set();
                            //     return this.variants.filter(v => {
                            //         if (seen.has(v.color)) return false;
                            //         seen.add(v.color);
                            //         return true;
                            //     });
                            // },

                            get colors() {
                                const uniqueColors = [];
                                const seen = new Set();

                                this.variants.forEach(v => {
                                    if (!seen.has(v.color)) {
                                        seen.add(v.color);
                                        uniqueColors.push({
                                            name: v.color,
                                            img: v.img,
                                            disabled: v.disabled
                                        });
                                    }
                                });

                                return uniqueColors;
                            },

                            get formattedPrice() {
                                return this.selectedPrice !== null ? this.selectedPrice.toFixed(2) : '';
                            },

                            updatePrice() {

                                const match = this.variants.find(
                                    v => v.color === this.selectedColor.name &&
                                    v.size === this.selectedSize &&
                                    v.packaging === this.selectedPackaging?.name
                                );
                                this.selectedPrice = match ? match.price : null;
                                this.selectedStock = match ? match.stock : null;
                            }
                        };
                    }
                </script>

            </div>


            {{-- Alpine.js Variant Modal --}}
            <div x-data="{
                // Merge the logic and data from variantSelector(...)
                ...variantSelector({{ $variantData->toJson() }}),


                item: {
                    {{-- price: {{ $item->price }}, --}}

                    price: {{ $variant->price }},

                    {{-- price: {{ number_format($variant->price, 2)
                   {{-- stock: 200, --}}

                    stock: [
                        @foreach ($item->variants as $variant)
                            {{ $variant->stock }}@if (!$loop->last),@endif @endforeach
                    ],


                    sizes: [
                        @foreach ($item->variants->unique('item_size_id') as $variant)
                            {{ $variant->size }}@if (!$loop->last),@endif @endforeach
                    ],

                    packaging_details: [
                        @php
                        $seen = []; @endphp

                        @foreach ($item->variants as $variant)

                        @php
                            $pkg = $variant->itemPackagingType;
                            $key = $pkg?->id;
                        @endphp

                        @if ($pkg && !in_array($key, $seen))
                            @php $seen[] = $key; @endphp
                            {
                                name: '{{ $pkg->name }}',
                                quantity: {{ $pkg->quantity ?? 1 }},
                                disabled: {{ $pkg->disabled ? 'true' : 'false' }}
                            }@if (!$loop->last),@endif
                        @endif @endforeach
                    ]

                },
                addToCart() {
                    // Handle adding to cart logic here (e.g., store cart item in session or make an AJAX request)
                    this.showModal = false;
                    window.location.href = '/cart'; // Redirect to the cart page
                },

                get selectedVariant() {
                    {{-- if (!this.selectedColor || !this.selectedSize) return null;
                    return this.item.variants.find(variant =>
                        variant.color === this.selectedColor && variant.size === this.selectedSize
                    ); --}}
                    return this.variants.find(variant =>
                        variant.color === this.selectedColor?.name &&
                        variant.size === this.selectedSize &&
                        variant.packaging === this.selectedPackaging?.name
                    );
                }

            }" x-cloak>

                <div class="flex flex-col items-center w-full max-w-xs pb-4 mx-auto mt-6 space-y-4">

                    <button @click="showModal = true" class="w-full text-lg btn btn-active btn-accent btn-lg sm:w-auto">
                        Add to Cart
                    </button>

                    <button class="w-full text-lg btn btn-active btn-lg sm:w-auto">
                        Buy Now
                    </button>

                </div>

                {{-- Overlay --}}
                <div x-show="showModal" class="fixed inset-0 z-40 bg-black/40" @click="showModal = false"
                    x-transition.opacity>
                </div>

                {{-- Bottom Sheet Modal --}}

                <div x-show="showModal" x-transition
                    class="fixed bottom-0 left-0 right-0 z-[51] bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl">


                    <!-- Close Button -->
                    <div class="flex justify-end">
                        <button @click="showModal = false"
                            class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
                    </div>

                    <!-- Product Preview -->
                    <div class="flex items-center gap-4 mb-4">
                        <img :src="selectedColor ? selectedColor.img : '/img/product.jpg'" alt="Product"
                            class="object-cover w-20 h-20 border rounded">

                        <div class="text-lg font-semibold text-red-500">
                            ฿<span x-text="selectedPrice"></span>
                        </div>

                        <!----Stock------->
                        <div class="text-sm text-gray-500">
                            Stock:<span x-text="selectedStock"></span>
                        </div>

                    </div>

                    <!-- Color Selector -->
                    <div class="mb-4">
                        <div class="mb-2 text-sm font-semibold">COLOR</div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(color, index) in colors" :key="index">
                                <button type="button" @click="!color.disabled && (selectedColor = color, updatePrice())"
                                    class="flex flex-col items-center w-20 px-2 py-1 text-xs border rounded-md"
                                    :class="{
                                        'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color
                                            .disabled,
                                        'border-black bg-black text-white': selectedColor?.name === color
                                            .name && !color
                                            .disabled
                                    }">
                                    <img :src="color.img" class="object-cover w-10 h-10 mb-1 rounded" />
                                    <span x-text="color.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>


                    <!-- Size Selector -->
                    <div class="mb-4" x-show="item.sizes.length > 0">
                        <div class="mb-2 text-sm font-semibold">SIZE</div>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="(size, index) in item.sizes" :key="index">
                                <button type="button"
                                    @click="!size.disabled && (selectedSize = size.name, updatePrice())"
                                    class="px-3 py-2 text-xs text-left border rounded-md"
                                    :class="{
                                        'bg-gray-100 text-gray-400 cursor-not-allowed': size.disabled,
                                        'bg-black text-white': selectedSize === size.name && !size.disabled
                                    }"
                                    x-text="size.name">
                                </button>
                            </template>
                        </div>
                    </div>


                    <!-- Packaging Selector -->
                    <div class="mb-6">
                        <div class="mb-2 text-sm font-semibold">Packaging</div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(option, index) in item.packaging_details" :key="option.name">
                                <button type="button"
                                    @click="!option.disabled && (selectedPackaging = option, updatePrice())"
                                    class="px-4 py-2 text-sm border rounded-md"
                                    :class="{
                                        'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': option
                                            .disabled,
                                        'border-black bg-black text-white': selectedPackaging?.name === option
                                            .name && !
                                            option.disabled
                                    }">
                                    <span x-text="`${option.name} (${option.quantity})`"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Quantity Control -->
                    <div class="mb-6">
                        <div class="mb-2 text-sm font-semibold">Quantity</div>
                        <div class="flex items-center px-2 border rounded w-max">
                            <button type="button" class="px-2 text-lg"
                                @click="quantity = Math.max(1, quantity - 1)">–</button>
                            <input type="number" x-model="quantity" min="1"
                                class="w-12 text-center outline-none border-x" />
                            <button type="button" class="px-2 text-lg" @click="quantity++">+</button>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <button :disabled="!selectedColor || !selectedSize" @click="addToCart()"
                        class="w-full py-3 font-bold text-white rounded"
                        :class="(!selectedColor || !selectedSize) ? 'bg-gray-400' : 'bg-red-500 hover:bg-red-600'">
                        ADD TO CART
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

{{-- @section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mySwiper", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection --}}


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper(".mySwiper", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });
    </script>
@endsection
