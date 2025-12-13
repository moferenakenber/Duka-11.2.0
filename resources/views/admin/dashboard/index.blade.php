<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex-col overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <?php
                    // PHP logic to prepare the data structure for the cards:
                    $productOptionSummary = $activeVariants->groupBy('item.product_name')->map(function ($variants, $productName) {
                        // 1. Collect all unique size names (e.g., ['Small', 'Medium', 'Large', 'XL', 'XXL', '3XL'])
                        $uniqueSizesArray = $variants->pluck('size')->filter()->unique('name')->pluck('name')->all();

                        // 2. Format the size display string
                        $formattedSizeDisplay = '';
                        if (count($uniqueSizesArray) > 5) {
                            // Find the minimum and maximum sizes
                            // Assuming size names are strings that can be reasonably sorted or treated as numbers for min/max
                            sort($uniqueSizesArray);
                            $minSize = reset($uniqueSizesArray);
                            $maxSize = end($uniqueSizesArray);

                            $formattedSizeDisplay = $minSize . ' - ' . $maxSize;
                        } else {
                            // If 5 or fewer, display all, separated by a comma
                            $formattedSizeDisplay = implode(', ', $uniqueSizesArray);
                        }

                        return [
                            'total_variants_count' => count($variants),
                            'unique_colors' => $variants->pluck('color')->filter()->unique('name')->values()->all(),
                            'formatted_size_display' => $formattedSizeDisplay, // <-- New formatted string
                            'unique_packaging' => $variants->pluck('itemPackagingType')->filter()->unique('name')->pluck('name')->all(),
                        ];
                    });
                    ?>

                    <p>Welcome, {{ Auth::user()->first_name }}! You are now logged in.</p>
                    {{-- {{ __("You're logged in!") }} --}}

                    <div class="flex flex-wrap gap-4 mt-4">

                        {{-- <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
              <span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>
              Visitors
            </span> --}}

                        {{-- @foreach ($activeVariants as $variant)
            <div>
                {{ $variant->item->product_name }} – Variant

                @foreach ($variant->packagingQuantities as $pq)
                    <span class="text-xs">
                        {{ $pq->packagingType->name }}
                        ({{ $pq->quantity }} pcs)
                    </span>
                @endforeach
            </div>
            @endforeach --}}

                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                            <span class="me-1.5 flex h-2.5 w-2.5 shrink-0 rounded-full bg-indigo-500"></span>
                            Customers: {{ $customersCount }}
                        </span>

                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                            <span class="me-1.5 flex h-2.5 w-2.5 shrink-0 rounded-full bg-green-500"></span>
                            Products: {{ $productsCount }}
                        </span>

                        {{-- <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                <span class="flex w-2.5 h-2.5 bg-orange-500 rounded-full me-1.5 shrink-0"></span>
                Items: {{ $itemsCount ?? 0 }}
            </span> --}}

                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                            <span class="me-1.5 flex h-2.5 w-2.5 shrink-0 rounded-full bg-yellow-500"></span>
                            Active Variants: {{ $activeVariantsCount ?? 0 }}
                        </span>

                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                            <span class="me-1.5 flex h-2.5 w-2.5 shrink-0 rounded-full bg-purple-500"></span>
                            Sessions: <strong class="ml-1">{{ $sessionsCount }}</strong>
                        </span>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($lowStockItems as $item)
                                <div class="p-4 transition border rounded shadow hover:shadow-md">
                                    <h3 class="text-lg font-semibold">{{ $item['product_name'] }}</h3>
                                    <p>Total Stock: <span class="font-medium">{{ $item['total_stock'] }}</span></p>
                                    <p>Low Stock Quantity:
                                        <span class="font-bold text-red-600">
                                            {{ $item['low_stock_total'] }}
                                        </span>
                                    </p>
                                    @if ($item['is_low'])
                                        <p class="mt-2 font-semibold text-yellow-800">⚠️ Item is critically low!</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>






                        {{--
            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                <span class="flex w-2.5 h-2.5 bg-yellow-500 rounded-full me-1.5 shrink-0"></span>
                Active Variants: {{ $activeVariantsCount }}
            </span> --}}


                        {{-- <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
              <span class="flex w-2.5 h-2.5 bg-blue-200 rounded-full me-1.5 shrink-0"></span>
              Sales
            </span> --}}

                        {{-- <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
              <span class="flex w-2.5 h-2.5 bg-teal-500 rounded-full me-1.5 shrink-0"></span>
              Revenue
            </span> --}}

                        {{-- <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
              <span class="flex w-2.5 h-2.5 bg-teal-200 rounded-full me-1.5 shrink-0"></span>
              Purchases
            </span> --}}

                        {{-- <h3 class="mt-4 text-lg font-semibold">Active Variants</h3> --}}



                        {{-- <div class="max-w-xs p-2 mx-auto">


    <div class="carousel w-full rounded-lg shadow-xl mb-3 h-[18rem]">


        @foreach ($productOptionSummary as $productName => $data)
            <div
                id="slide-{{ $loop->iteration }}"
                class="w-full carousel-item"
            >

                <div class="w-full h-full card card-bordered bg-base-100">
                    <div class="p-2 card-body">


                        <div class="flex items-start justify-between mb-1">
                            <h2 class="card-title text-sm font-bold max-w-[60%] truncate leading-tight">
                                {{ $productName }}
                            </h2>
                            <div class="flex-shrink-0 p-1 ml-1 text-xs font-extrabold badge badge-primary badge-sm">
                                {{ $data['total_variants_count'] }}
                            </div>
                        </div>

                        <div class="my-0 text-xs divider">Options</div>


                        <div class="pt-1 space-y-2 overflow-y-auto text-xs">


                            <div>
                                <span class="block mb-1 font-semibold text-gray-600">Colors:</span>
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($data['unique_colors'] as $color)
                                        <div
                                            class="w-4 h-4 border border-gray-300 rounded-full shadow-sm"
                                            style="background-color: {{ $color->hex_code ?? $color->name ?? 'gray' }};"
                                            title="{{ $color->name ?? 'Unknown Color' }}">
                                        </div>
                                    @empty
                                        <span class="text-xs text-gray-400">N/A</span>
                                    @endforelse
                                </div>
                            </div>


                            <div>
                                <span class="block mb-1 font-semibold text-gray-600">Sizes:</span>
                                <div class="flex flex-wrap gap-1">
                                    @if ($data['formatted_size_display'])
                                        <span class="font-medium badge badge-secondary badge-xs">
                                            {{ $data['formatted_size_display'] }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">N/A</span>
                                    @endif
                                </div>
                            </div>


                            <div>
                                <span class="block mb-1 font-semibold text-gray-600">Packaging:</span>
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($data['unique_packaging'] as $pkgName)
                                        <span class="badge badge-success badge-xs">
                                            {{ $pkgName }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400">N/A</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="flex justify-center w-full gap-1 py-1">
        @foreach ($productOptionSummary as $productName => $data)
            <a
                href="#slide-{{ $loop->iteration }}"
                class="btn btn-xs btn-circle transition-all duration-300 {{ $loop->first ? 'btn-primary' : '' }}"
                title="{{ $productName }}">
                {{ $loop->iteration }}
            </a>
        @endforeach
    </div>
</div> --}}






                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
