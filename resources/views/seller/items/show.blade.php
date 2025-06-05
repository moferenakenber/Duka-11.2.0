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
    {{-- <div class="max-w-4xl p-6 pb-16 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg"> --}}
    {{-- <div class="max-w-4xl p-6 pb-16 mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden overflow-y-auto max-h-[100vh]"> --}}

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


            {{-- ------------------------------------------------------------------------ --}}
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
                            <th class="px-4 py-2 border whitespace-nowrap">Variant ID</th>

                            {{-- Item Color --}}
                            <th class="px-4 py-2 border whitespace-nowrap">Color ID</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Color Name</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Color Image</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Disabled</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Color Created</th>

                            {{-- Item Size --}}
                            <th class="px-4 py-2 border whitespace-nowrap">Size ID</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Size Name</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Size Description</th>

                            {{-- Packaging --}}
                            <th class="px-4 py-2 border whitespace-nowrap">Packaging ID</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Packaging Name</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Packaging Details</th>

                            {{-- Variant --}}
                            <th class="px-4 py-2 border whitespace-nowrap">Price</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Stock</th>

                            {{-- Owner --}}
                            <th class="px-4 py-2 border whitespace-nowrap">Owner ID</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Owner Name</th>
                            <th class="px-4 py-2 border whitespace-nowrap">Owner Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->variants as $variant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->id }}</td>

                                {{-- Color --}}
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->itemColor->id ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->itemColor->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    @if (!empty($variant->itemColor->image_path))
                                        <img src="{{ asset($variant->itemColor->image_path) }}"
                                            alt="{{ $variant->itemColor->name }}" class="object-cover w-8 h-8 rounded" />
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ $variant->itemColor->disabled ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ optional($variant->itemColor->created_at)->format('Y-m-d') ?? 'N/A' }}</td>

                                {{-- Size --}}
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->itemSize->id ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->itemSize->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ $variant->itemSize->description ?? 'N/A' }}</td>

                                {{-- Packaging --}}
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ $variant->itemPackagingType->id ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ $variant->itemPackagingType->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">
                                    {{ $variant->itemPackagingType->details ?? 'N/A' }}</td>

                                {{-- Variant --}}
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->price }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->stock }}</td>

                                {{-- Owner --}}
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->owner->id ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->owner->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $variant->owner->email ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


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

                                {{-- Display names --}}
                                <td class="px-4 py-2 border">{{ $variant->itemColor->name ?? '—' }}</td>
                                <td class="px-4 py-2 border">{{ $variant->itemSize->name ?? '—' }}</td>
                                <td class="px-4 py-2 border">{{ $variant->itemPackagingType->name ?? '—' }}</td>

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



            {{-- _______________________________________________________________ --}}


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
                            variants: variants,
                            selectedColor: '',

                            selectedPrice: null,

                            init() {
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
                                // const match = this.variants.find(v => v.color === this.selectedColor);
                                // this.selectedPrice = match ? match.price : null;
                                // this.selectedImg = match ? match.img : '';
                                // this.selectedDisabled = match ? match.disabled : false;

                                const match = this.variants.find(
                                    v => v.color === this.selectedColor.name &&
                                    v.size === this.selectedSize &&
                                    v.packaging === this.selectedPackaging?.name
                                );
                                this.selectedPrice = match ? match.price : null;
                                this.selectedStock = match ? match.stock : null;
                                this.selectedImg = match ? match.img : '/img/default.jpg';
                            }
                        };
                    }
                </script>

            </div>


            {{-- Alpine.js Variant Modal --}}
            <div x-data="{
                showModal: false,
                quantity: 1,
                selectedColor: null,
                selectedSize: null,
                selectedPackaging: null,
                selectedPrice: null,
                selectedStock: null,
                formattedPrice: '',


                {{-- variantSelector: {{ $variantData->toJson() }}, --}}

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

                    {{-- colors: [
                        @foreach ($item->variants as $variant)
                            {
                                name: '{{ $variant->itemColor->name }}',
                                img: '{{ asset($variant->itemColor->image_path) }}',
                                disabled: {{ $variant->itemColor->disabled ? 'true' : 'false' }}
                            }@if (!$loop->last),@endif @endforeach
                    ], --}}

                    {{-- variants: [
                        @foreach ($item->variants as $variant)
                            {
                                color: '{{ $variant->itemColor->name }}',
                                size: '{{ $variant->itemSize->name }}',
                                packaging: '{{ $variant->itemPackagingType->name }}',
                                price: {{ number_format($variant->price, 2) }},
                                stock: {{ $variant->stock }},
                                img: '{{ asset($variant->itemColor->image_path) }}',
                                disabled: {{ $variant->itemColor->disabled ? 'true' : 'false' }},
                            }@if (!$loop->last),@endif @endforeach
                    ], --}}
                    {{-- variants: [
                        @foreach ($item->variants as $variant)
                            {
                                color: '{{ $variant->itemColor->name }}',
                                size: '{{ $variant->itemSize->name }}',
                                packaging: '{{ $variant->itemPackagingType->name }}',
                                price: {{ number_format($variant->price, 2) }},
                                stock: {{ $variant->stock }},
                                img: '{{ asset($variant->itemColor->image_path) }}',
                                disabled: {{ $variant->itemColor->disabled ? 'true' : 'false' }},
                            }
                            @if (!$loop->last),@endif @endforeach
                    ], --}}


                    {{-- colors: [
                        { name: 'BONE', img: '/img/colors/bone.png', disabled: false },
                        { name: 'WHITE', img: '/img/colors/white.png', disabled: false },
                        { name: 'BLACK', img: '/img/colors/black.png', disabled: false },
                        { name: 'PURPLE', img: '/img/colors/purple.png', disabled: false },
                        { name: 'BUTTER CORN', img: '/img/colors/butter-corn.png', disabled: true },
                        { name: 'QUARTZ', img: '/img/colors/quartz.png', disabled: false }
                    ], --}}


                    sizes: [
                        @foreach ($item->variants->unique('item_size_id') as $variant)
                            {{ $variant->size }}@if (!$loop->last),@endif @endforeach
                    ],

                    {{-- sizes: [
                        { value: 'W5', label: 'W5 21cm 34–35eu', disabled: false },
                        { value: 'W6', label: 'W6 22cm 36–37eu', disabled: false },
                        { value: 'W7', label: 'W7 23cm 37–38eu', disabled: false },
                        { value: 'W8', label: 'W8 24cm 38–39eu', disabled: false },
                        { value: 'W9', label: 'W9 25cm 39–40eu', disabled: false },
                        { value: 'W10', label: 'W10 26cm 41–42eu', disabled: false }
                    ], --}}

                    {{-- packaging_details: [
                        @foreach ($item->variants as $variant)
                            {
                                name: '{{ $variant->itemPackagingType->name }}',
                                quantity: {{ $variant->itemPackagingType->quantity }}
                            }@if (!$loop->last),@endif @endforeach
                    ] --}}

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


                    {{-- packaging_details: [
                        { name: 'Piece', quantity: 1 },
                        { name: 'Packet', quantity: 10 },
                        { name: 'Case', quantity: 100 }
                    ] --}}
                },
                addToCart() {
                    // Handle adding to cart logic here (e.g., store cart item in session or make an AJAX request)
                    this.showModal = false;
                    window.location.href = '/cart'; // Redirect to the cart page
                },

                get selectedVariant() {
                    if (!this.selectedColor || !this.selectedSize) return null;
                    return this.item.variants.find(variant =>
                        variant.color === this.selectedColor && variant.size === this.selectedSize
                    );
                }
                {{-- ,

                packagingOptions: @json($item->packaging_details),
                get filteredOptions() {
                    return this.packagingOptions.filter(option => ['Piece', 'Packet', 'Case'].includes(option.name)).map(option => {
                        return {
                            name: option.name === 'Case' ? 'Carton' : option.name,
                            quantity: option.quantity
                        }
                    });
                } --}}
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
                {{-- <div x-show="showModal" x-transition
                    class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl"> --}}

                <div x-show="showModal" x-transition
                    class="fixed bottom-0 left-0 right-0 z-[51] bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl">


                    <!-- Close Button -->
                    <div class="flex justify-end">
                        <button @click="showModal = false"
                            class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
                    </div>

                    <!-- Product Preview -->
                    <div class="flex items-center gap-4 mb-4">
                        {{-- <img src="/img/product.jpg" alt="Product" class="object-cover w-20 h-20 border rounded"> --}}
                        <img :src="selectedColor ? selectedColor.img : '/img/product.jpg'" alt="Product"
                            class="object-cover w-20 h-20 border rounded">

                        <div class="text-lg font-semibold text-red-500">
                            ฿<span x-text="selectedPrice"></span>
                        </div>


                        <!------------------------------>
                        <!-- Price Display -->
                        {{-- <div x-show="selectedPrice !== null">
                            <p class="text-lg font-semibold">
                                Price: <span x-text="selectedPrice"></span>
                            </p>
                        </div> --}}
                        {{--
                        <!-- Debugging output -->
                        <p>selectedPrice: <span x-text="selectedPrice"></span></p>
                        <p>formattedPrice: <span x-text="formattedPrice"></span></p>
 --}}


                        <!------------------------------>
                        <div class="text-sm text-gray-500">
                            Stock:<span x-text="selectedStock"></span>
                        </div>


                        {{-- tryouts --}}
                        {{-- <div class="text-lg font-semibold text-red-500">
                            ฿<span x-text="selectedVariant ? selectedVariant.price : item.price"></span>
                        </div>
                        <div class="text-sm text-gray-500">
                            Stock: <span x-text="selectedVariant ? selectedVariant.stock : item.stock"></span>
                        </div> --}}

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









                    <div class="mb-4" x-show="item.sizes.length > 0">
                        <div class="mb-2 text-sm font-semibold">SIZE</div>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="(size, index) in item.sizes" :key="index">
                                <button type="button" @click="!size.disabled && (selectedSize = size.name)"
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


                    <!-- Packaging Option Selector -->
                    {{-- <div class="mb-6">
                        <div class="mb-2 text-sm font-semibold">Packaging</div>
                        <select name="packaging_details" class="form-select">
                            <template x-for="option in item.packaging_details" :key="option.name">
                                <option :value="option.name" x-text="`${option.name} (${option.quantity})`"></option>
                            </template>
                        </select>
                    </div> --}}

                    <!-- Packaging Option Selector -->
                    <!-- ---------------------------------------------------------- -->
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
                    <!-- ---------------------------------------------------------- -->



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
