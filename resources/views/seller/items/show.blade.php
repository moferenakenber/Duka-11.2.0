@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Product Image --}}
        @if ($item->product_images->isNotEmpty())
            <img src="{{ asset('storage/' . $item->product_images->first()->path) }}" alt="{{ $item->product_name }}" class="w-full h-96 object-cover">
        @else
            <img src="https://picsum.photos/400/300" alt="No Image" class="w-full h-96 object-cover">
        @endif

        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $item->product_name }}</h2>
            <p class="text-gray-600 mt-2">{{ $item->product_description }}</p>

            <div class="mt-4">
                <span class="text-red-500 text-3xl font-bold">฿{{ number_format($item->price, 0) }}</span>
            </div>

            <div class="mt-4">
                <span class="bg-green-500 text-white text-xs px-3 py-1 rounded">FREE Shipping</span>
                @if ($item->has_discount)
                    <span class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">Discount Available</span>
                @endif
            </div>

            <div class="mt-6">
                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded text-lg">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
@endsection
