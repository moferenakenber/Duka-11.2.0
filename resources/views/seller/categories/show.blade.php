@extends('seller.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl">

        {{-- Subcategory Header Section --}}
        <div class="w-full px-4 py-3 rounded-b-xl" style="background-color: #f6a45d">
            <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto">
                <a href="{{ route('seller.categories.index') }}"
                   class="text-white btn btn-circle hover:bg-white/10" title="Back to Main Categories">
                    <x-lucide-arrow-left class="w-7 h-7" />
                </a>

                <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">
                    {{ $category->category_name }}
                </h1>

                <div class="w-10 h-10 ml-auto"></div>
            </div>
        </div>

        {{-- Main Content: Subcategories or Items --}}
        <div class="flex flex-col items-center justify-center h-full px-4 pt-6 pb-16">

            @if ($subcategories->isNotEmpty())
                {{-- Show subcategories --}}
                <div class="grid w-full max-w-6xl grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($subcategories as $subcategory)
                        <div class="col-span-1 transition duration-300 border border-gray-200 rounded-lg bg-gray-50 hover:shadow-md">
                            <a href="{{ route('seller.categories.show', $subcategory->id) }}"
                               class="block p-4 text-center focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                <x-lucide-chevron-right-square class="w-8 h-8 mx-auto mb-2 text-orange-500" />
                                <h3 class="text-base font-semibold text-gray-900 whitespace-normal">
                                    {{ $subcategory->category_name }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $subcategory->items_count ?? 0 }} items
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

            @elseif($items->isNotEmpty())
                {{-- Show items directly under this category --}}
                <div class="grid w-full max-w-6xl grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($items as $item)
                        <a href="{{ route('seller.items.show', $item->id) }}"
                           class="block overflow-hidden transition-transform duration-300 transform bg-white border rounded-lg shadow-md hover:scale-105">

                            @php
                                $decoded = json_decode($item->product_images, true);
                                $images = is_array($decoded) ? array_values(array_filter($decoded, fn($img) => is_string($img))) : [];
                                $mainImage = $images[0] ?? 'images/default.jpg';
                                $minPrice = $item->variants->min('price') ?? 0;
                            @endphp

                            <div class="flex items-center justify-center w-full h-48 bg-white rounded-t-lg">
                                <img src="{{ asset($mainImage) }}" alt="{{ $item->product_name }}" class="object-contain w-full h-full" />
                            </div>

                            <div class="p-3">
                                <h2 class="font-semibold text-gray-900 truncate">{{ $item->product_name }}</h2>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-lg font-bold text-red-500">฿{{ number_format($minPrice, 0) }}</span>
                                    <span class="text-xs text-gray-500">{{ number_format($item->sold_count) }} sold</span>
                                </div>
                                @if ($item->has_discount)
                                    <div class="mt-2">
                                        <span class="px-2 py-1 text-xs text-white bg-yellow-500 rounded">Discount</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

            @else
                {{-- No subcategories or items --}}
                <div class="w-full max-w-2xl px-4 mt-8 text-center text-gray-500">
                    <x-lucide-box class="w-10 h-10 mx-auto text-gray-400" />
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No subcategories or items found</h3>
                    <p class="mt-1 text-sm">This category currently has nothing to display.</p>
                </div>
            @endif

          {{-- Total Count --}}
            <div class="flex items-center justify-center pt-6">
                <p class="relative px-4 py-2 font-semibold">
                    <span class="absolute top-0 left-0 w-full h-px bg-white dark:bg-white"></span>
                    <span class="mx-6">
                        @if($subcategories->isNotEmpty())
                            Total Active Items in Subcategories: **{{ $subcategories->sum('active_items_count') }}**
                        @elseif($items->isNotEmpty())
                            Total Active Items in This Category: **{{ $items->count() }}**
                        @else
                            Total: 0
                        @endif
                    </span>
                </p>
            </div>


        </div>
    </div>
</div>
@endsection
