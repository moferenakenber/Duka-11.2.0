<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Variants') }}
            </h2>
            {{-- <a href="{{ route('admin.items.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Add Item') }}
            </a> --}}
        </div>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Item Summary --}}
            <div class="flex items-start justify-between p-4 mb-6 bg-white shadow-md rounded-xl">
                {{-- Left: Image + Info --}}
                <div class="flex flex-1 gap-4">
                    {{-- Image --}}
                    <div class="w-20 h-20 overflow-hidden rounded">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                            class="object-cover w-full h-full" alt="{{ $item->product_name }}">
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->product_name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->product_description }}</p>

                        {{-- Price --}}
                        <div class="flex gap-2 mt-1">
                            <span class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">Price:
                                ${{ number_format($item->price, 2) }}</span>
                        </div>

                        {{-- Variation Options --}}
                        <div class="mt-2 space-y-1">
                            {{-- Colors --}}
                            @if ($item->colors && $item->colors->count())
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Colors:</span>
                                    @foreach ($item->colors as $color)
                                        <span class="px-2 py-1 text-xs text-white rounded-full"
                                            style="background-color: {{ $color->hex_code ?? '#000' }}">
                                            {{ $color->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Sizes --}}
                            @if ($item->sizes && $item->sizes->count())
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sizes:</span>
                                    @foreach ($item->sizes as $size)
                                        <span class="px-2 py-1 text-xs text-gray-800 bg-gray-200 rounded-full">
                                            {{ $size->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Packaging --}}
                            @if ($item->packagingTypes && $item->packagingTypes->count())
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Packaging:</span>
                                    @foreach ($item->packagingTypes as $pack)
                                        <span class="px-2 py-1 text-xs text-white bg-purple-500 rounded-full">
                                            {{ $pack->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right: Variants Count --}}
                <div class="flex items-center ml-4">
                    <span class="px-3 py-2 text-sm font-bold text-white bg-purple-500 rounded-full">
                        Variants: {{ $item->variants->count() }}
                    </span>
                </div>
            </div>


            {{-- Add Variant Form --}}
            <div class="p-4 mb-6 rounded-xl bg-base-200" x-data="variantForm()">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Add Variant</h3>
                    <button type="button" class="btn btn-outline btn-sm"
                        @click="variants.push({ item_color_id: '', item_size_id: '', item_packaging_type_id: '' })">
                        + Add Variant
                    </button>
                </div>

                <template x-for="(variant, index) in variants" :key="index">
                    <div class="flex flex-wrap items-end gap-2 p-2 border rounded-xl bg-base-100">
                        <!-- Color, Size, Packaging, Price, Stock, Image, Active toggle, etc -->
                        <!-- Same as your current form code -->
                    </div>
                </template>
            </div>

            {{-- Variant Table --}}
            <div class="overflow-x-auto rounded-xl bg-base-100">
                <table class="table w-full table-xs">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox" /></th>
                            <th>#</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Packaging</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Owner</th>
                            <th>Image</th>
                            <th>Bar Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->variants as $index => $variant)
                            <tr>
                                <th><input type="checkbox" class="checkbox" /></th>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $variant->itemColor->name ?? '-' }}</td>
                                <td>{{ optional($variant->itemSize)->name ?? '-' }}</td>
                                <td>{{ $variant->itemPackagingType->name ?? '-' }}</td>
                                <td>${{ number_format($variant->price, 2) }}</td>
                                <td>{{ $variant->totalStock() }}</td>
                                <td>{{ $variant->owner->name ?? '-' }}</td>
                                <td>
                                    @if ($variant->image)
                                        <img src="{{ asset('storage/' . $variant->image) }}" class="w-6 h-6 rounded" />
                                    @elseif ($variant->itemColor && $variant->itemColor->image_path)
                                        <img src="{{ asset($variant->itemColor->image_path) }}" class="w-6 h-6 rounded" />
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <input type="text" name="variants[{{ $index }}][barcode]"
                                        value="{{ $variant->barcode ?? '' }}" placeholder="Enter or scan barcode"
                                        class="w-full form-control input input-sm input-bordered">
                                </td>
                                <td>
                                    <span class="badge-{{ $variant->is_active ? 'success' : 'neutral' }} badge">
                                        {{ $variant->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.items.edit', $variant) }}" class="btn btn-outline btn-xs">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
