<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Items & Variants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <h1>Items Index Loaded</h1>
            <p>Total items: {{ $items->count() }}</p>

            @foreach ($items as $item)
                <h3>{{ $item->product_name }}</h3>
                <p>Colors: {{ $item->colors->pluck('name')->join(', ') }}</p>
                <p>Sizes: {{ $item->sizes->pluck('name')->join(', ') }}</p>
                <p>Packaging: {{ implode(', ', $item->getPackagingDisplay()) }}</p>
            @endforeach


            @if ($items->isEmpty())
                <div class="p-6 text-center bg-white shadow-md rounded-xl">
                    No items found.
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <div class="overflow-hidden bg-white shadow-md rounded-xl">
                            {{-- Item Image --}}
                            <div class="w-full h-40 overflow-hidden">
                                <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                                    class="object-cover w-full h-full" alt="{{ $item->product_name }}">
                            </div>

                            {{-- Item Info --}}
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->product_name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->product_description }}</p>

                                {{-- Colors --}}
                                @if ($item->colors->count())
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach ($item->colors as $color)
                                            <span class="px-2 py-1 text-xs text-white rounded-full"
                                                style="background-color: {{ $color->hex_code ?? '#000' }}">
                                                {{ $color->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Sizes --}}
                                @if ($item->sizes->count())
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach ($item->sizes as $size)
                                            <span class="px-2 py-1 text-xs text-gray-800 bg-gray-200 rounded-full">
                                                {{ $size->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Packaging --}}
                                @if ($item->packagingTypes->count())
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach ($item->packagingTypes as $pack)
                                            <span class="px-2 py-1 text-xs text-white bg-purple-500 rounded-full">
                                                {{ $pack->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Variants count & button --}}
                                <div class="flex items-center justify-between mt-4">
                                    <span class="px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded-full">
                                        Variants: {{ $item->variants->count() }}
                                    </span>

                                    <a href="{{ route('admin.variants.index', $item->id) }}"
                                        class="px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                                        View Variants
                                    </a>

                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
