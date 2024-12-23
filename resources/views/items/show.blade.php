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

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('items.index') }}" class="text-blue-600 hover:text-blue-800">Back to Items List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
