@extends('seller.layouts.app')

@section('content')
    {{-- <div class="max-w-4xl mx-auto p-6 pb-16">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden"> --}}
    <div class="max-w-4xl mx-auto p-6 pb-16">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden overflow-y-auto max-h-[100vh]">

            {{-- Swiper Image Slider --}}
            <div class="relative">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @if ($item && $item->product_images)
                            @php $decodedImages = json_decode($item->product_images, true); @endphp
                            @if (is_array($decodedImages))
                                @foreach ($decodedImages as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ $image }}" alt="Product Image" class="w-full">
                                    </div>
                                @endforeach
                            @endif
                        @else
                            <div class="swiper-slide p-4">No images available.</div>
                        @endif
                    </div>

                    {{-- Arrows + Dots --}}
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $item->product_name }}</h2>
                <p class="text-gray-600 mt-2">{{ $item->product_description }}</p>

                <div class="mt-4">
                    <span class="text-red-500 text-3xl font-bold">฿{{ number_format($item->price, 0) }}</span>
                    @if ($item->discount_price)
                        <span class="line-through text-gray-400 ml-2">฿{{ number_format($item->original_price, 0) }}</span>
                        <span
                            class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">-{{ $item->discount_percentage }}%</span>
                    @endif
                </div>

                @if ($item->has_discount)
                    <div class="mt-4">
                        <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">Discount Available</span>
                    </div>
                @endif

                <ul class="mt-2">
                    {{-- <li class="text-gray-600">Brand: {{ $item->brand }}</li>
                    <li class="text-gray-600">Category: {{ $item->category }}</li>
                    <li class="text-gray-600">Subcategory: {{ $item->subcategory }}</li> --}}
                    <li class="text-gray-600">1 - product_images: {{ $item->product_images }}</li>
                    <li class="text-gray-600">2 - variation: {{ $item->variation }}</li>
                    <li class="text-gray-600">3 - price: {{ $item->price }}</li>
                    <li class="text-gray-600">4 - product_name: {{ $item->product_name }}</li>
                    <li class="text-gray-600">5 - product_description: {{ $item->product_description }}</li>
                    <li class="text-gray-600">6 - packaging_details: {{ $item->packaging_details }}</li>
                    <li class="text-gray-600">7 - status: {{ $item->status }}</li>
                    <li class="text-gray-600">8 - incomplete: {{ $item->incomplete }}</li>
                    <li class="text-gray-600">9 - category_id: {{ $item->category_id }}</li>
                    <li class="text-gray-600">10 - item_category_id: {{ $item->item_category_id }}</li>
                    <li class="text-gray-600">11 - selectedCategories: {{ $item->selectedCategories }}</li>
                    <li class="text-gray-600">12 - newCategoryNames: {{ $item->newCategoryNames }}</li>
                </ul>

                {{-- <div class="mt-6 flex space-x-4">
                    <button @click="showModal = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded text-lg flex-1">
                        Add to Cart
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded text-lg flex-1">Buy Now</button>
                </div> --}}
            </div>


            {{-- Alpine.js Variant Modal --}}
            <div x-data="{
                showModal: false,
                selectedColor: null,
                selectedSize: null,
                quantity: 1,
                item: {
                    price: {{ $item->price }},
                    stock: 200,

                    colors: [
                        @foreach($item->colors as $color)
                            {
                                name: '{{ $color->name }}',
                                img: '{{ asset($color->image_path) }}',
                                disabled: {{ $color->disabled ? 'true' : 'false' }}
                            }@if(!$loop->last),@endif
                        @endforeach
                    ],


                    {{-- colors: [
                        { name: 'BONE', img: '/img/colors/bone.png', disabled: false },
                        { name: 'WHITE', img: '/img/colors/white.png', disabled: false },
                        { name: 'BLACK', img: '/img/colors/black.png', disabled: false },
                        { name: 'PURPLE', img: '/img/colors/purple.png', disabled: false },
                        { name: 'BUTTER CORN', img: '/img/colors/butter-corn.png', disabled: true },
                        { name: 'QUARTZ', img: '/img/colors/quartz.png', disabled: false }
                    ], --}}

                    sizes: [
                        { value: 'W5', label: 'W5 21cm 34–35eu', disabled: false },
                        { value: 'W6', label: 'W6 22cm 36–37eu', disabled: false },
                        { value: 'W7', label: 'W7 23cm 37–38eu', disabled: false },
                        { value: 'W8', label: 'W8 24cm 38–39eu', disabled: false },
                        { value: 'W9', label: 'W9 25cm 39–40eu', disabled: false },
                        { value: 'W10', label: 'W10 26cm 41–42eu', disabled: false }
                    ],
                    packaging_details: [
                        { name: 'Piece', quantity: 1 },
                        { name: 'Packet', quantity: 10 },
                        { name: 'Case', quantity: 100 }
                    ]
                },
                addToCart() {
                    // Handle adding to cart logic here (e.g., store cart item in session or make an AJAX request)
                    this.showModal = false;
                    window.location.href = '/cart'; // Redirect to the cart page
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
                {{-- Trigger Button --}}

                <div class="mt-6 flex space-x-4">

                    <button @click="showModal = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded text-lg flex-1">
                        Add to Cart
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded text-lg flex-1">Buy Now</button>
                </div>

                {{-- Overlay --}}
                <div x-show="showModal" class="fixed inset-0 bg-black/40 z-40" @click="showModal = false"
                    x-transition.opacity>
                </div>

                {{-- Bottom Sheet Modal --}}
                <div x-show="showModal" x-transition
                    class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl">
                    <!-- Close Button -->
                    <div class="flex justify-end">
                        <button @click="showModal = false"
                            class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>

                    <!-- Product Preview -->
                    <div class="flex items-center gap-4 mb-4">
                        <img src="/img/product.jpg" alt="Product" class="w-20 h-20 rounded border object-cover">
                        <div>
                            <div class="text-lg font-semibold text-red-500">฿<span x-text="item.price"></span></div>
                            <div class="text-sm text-gray-500">Stock: <span x-text="item.stock"></span></div>
                        </div>
                    </div>

                    <!-- Color Selector -->
                    <div class="mb-4">
                        <div class="font-semibold text-sm mb-2">COLOR</div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(color, index) in item.colors" :key="index">
                                <button type="button" @click="!color.disabled && (selectedColor = color.name)"
                                    class="flex flex-col items-center border rounded-md px-2 py-1 w-20 text-xs"
                                    :class="{
                                        'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color.disabled,
                                        'border-black bg-black text-white': selectedColor === color.name && !color
                                            .disabled
                                    }">
                                    <img :src="color.img" class="w-10 h-10 object-cover rounded mb-1" alt="">
                                    <span x-text="color.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Size Selector -->
                    <div class="mb-4">
                        <div class="font-semibold text-sm mb-2">SIZE</div>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="(size, index) in item.sizes" :key="index">
                                <button type="button" @click="!size.disabled && (selectedSize = size.value)"
                                    class="border rounded-md px-3 py-2 text-xs text-left"
                                    :class="{
                                        'bg-gray-100 text-gray-400 cursor-not-allowed': size.disabled,
                                        'bg-black text-white': selectedSize === size.value && !size.disabled
                                    }"
                                    x-text="size.label"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Packaging Option Selector -->
                    <div class="mb-6">
                        <div class="font-semibold text-sm mb-2">Packaging</div>
                        <select name="packaging_details" class="form-select">
                            <template x-for="option in item.packaging_details" :key="option.name">
                                <option :value="option.name" x-text="`${option.name} (${option.quantity})`"></option>
                            </template>
                        </select>
                    </div>


                <!-- Quantity Control -->
                <div class="mb-6">
                    <div class="font-semibold text-sm mb-2">Quantity</div>
                    <div class="flex items-center border w-max px-2 rounded">
                        <button type="button" class="text-lg px-2" @click="quantity = Math.max(1, quantity - 1)">–</button>
                        <input type="number" x-model="quantity" min="1"
                            class="w-12 text-center border-x outline-none" />
                        <button type="button" class="text-lg px-2" @click="quantity++">+</button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <button :disabled="!selectedColor || !selectedSize" @click="addToCart()"
                    class="w-full py-3 font-bold rounded text-white"
                    :class="(!selectedColor || !selectedSize) ? 'bg-gray-400' : 'bg-red-500 hover:bg-red-600'">
                    ADD TO CART
                </button>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
@endsection
