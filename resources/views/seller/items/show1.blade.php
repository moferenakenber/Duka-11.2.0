@extends('seller.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 pb-16">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    {{-- Swiper Image Slider (Horizontal Swiping) --}}
    <div class="relative">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          {{-- 10 Static Images for Horizontal Swipe --}}
          <div class="swiper-slide">
            @if ($item && $item->product_images)
              @php
                $decodedImages = json_decode($item->product_images, true);
              @endphp

              @if (is_array($decodedImages) && ! empty($decodedImages))
                <img src="{{ $decodedImages[0] }}" alt="First Product Image" />
              @else
                <p>No images available.</p>
              @endif
            @else
              <p>Product images not found.</p>
            @endif
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
        {{-- <span class="bg-green-500 text-white text-xs px-3 py-1 rounded">FREE Shipping</span> --}}
        @if ($item->has_discount)
          <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">Discount Available</span>
        @endif
      </div>

      <div class="mt-4">
        <h3 class="text-lg font-semibold text-gray-800">Product Details</h3>
        <ul class="mt-2">
          {{--
            <li class="text-gray-600">Brand: {{ $item->brand }}</li>
            <li class="text-gray-600">Category: {{ $item->category }}</li>
            <li class="text-gray-600">Subcategory: {{ $item->subcategory }}</li>
          --}}
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

        <div class="mt-6 flex space-x-4">
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
      var swiper = new Swiper('.mySwiper', {
        loop: true, // Infinite loop for smooth swiping
        slidesPerView: 1, // Show one image at a time
        spaceBetween: 10, // Small spacing between images
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });
    </script>
  @endsection
</div>
