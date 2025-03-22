@extends('seller.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        {{-- Swiper Image Slider (Horizontal Swiping) --}}
        <div class="relative">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    {{-- 10 Static Images for Horizontal Swipe --}}
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
                    </div>
                </div>

                {{-- Navigation Arrows --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                {{-- Pagination Dots --}}
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
                    <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">-{{ $item->discount_percentage }}%</span>
                @endif
            </div>

            <div class="mt-4 flex items-center space-x-2">
                <span class="bg-green-500 text-white text-xs px-3 py-1 rounded">FREE Shipping</span>
                @if ($item->has_discount)
                    <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">Discount Available</span>
                @endif
            </div>

            <div class="mt-6 flex space-x-4">
                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded text-lg flex-1">Chat Now</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded text-lg flex-1">Add to Cart</button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded text-lg flex-1">Buy Now</button>
            </div>
        </div>
    </div>
</div>

{{-- Swiper.js --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,            // Infinite loop for smooth swiping
        slidesPerView: 1,       // Show one image at a time
        spaceBetween: 10,       // Small spacing between images
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
