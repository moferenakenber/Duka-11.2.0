<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Item Variants') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- ITEM CARD --}}
            <div class="w-full mb-6 overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-lg card rounded-3xl hover:shadow-xl">
                <div class="p-5 card-body sm:p-6">

                    {{-- Top Section: Image & Info --}}
                    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">
                        <div class="flex flex-1 gap-4">
                            <div class="avatar">
                                <div class="w-20 h-20 overflow-hidden shadow-sm sm:w-24 sm:h-24 rounded-2xl ring-1 ring-gray-100">
                                    <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                                        alt="{{ $item->product_name }}" class="object-cover w-full h-full" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <h2 class="text-lg font-bold leading-tight text-gray-800 sm:text-xl">
                                    {{ $item->product_name }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                    {{ $item->product_description }}
                                </p>
                                <div class="flex gap-2 mt-1">
                                    <span class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">
                                        Price: ${{ number_format($item->price, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center ml-4">
                            <span class="px-3 py-2 text-sm font-bold text-white bg-purple-500 rounded-full">
                                Variants: {{ $item->variants->count() }}
                            </span>
                        </div>
                    </div>

                    {{-- Middle Section: Description & Attributes Grid --}}
                    <div class="grid grid-cols-1 gap-4 mt-5 md:grid-cols-2 lg:grid-cols-3">

                        {{-- Description --}}
                        <div class="relative p-4 bg-white border border-gray-200 col-span-full rounded-2xl">
                            <div class="flex items-center gap-2 mb-2 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i> Description
                            </div>
                            <input type="checkbox" id="desc-expand-{{ $item->id }}" class="hidden peer" />
                            <div class="text-sm leading-relaxed text-gray-600 transition-all duration-300 line-clamp-2 peer-checked:line-clamp-none">
                                {{ $item->product_description }}
                            </div>
                            <div class="flex justify-end mt-2">
                                <label for="desc-expand-{{ $item->id }}" class="text-xs font-bold cursor-pointer text-primary hover:underline peer-checked:hidden">
                                    Read more
                                </label>
                                <label for="desc-expand-{{ $item->id }}" class="hidden text-xs font-bold text-gray-400 cursor-pointer hover:text-gray-600 peer-checked:block">
                                    Show less
                                </label>
                            </div>
                        </div>

                        {{-- Colors --}}
                        @if ($item->colors->count())
                            <div class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl hover:border-blue-200">
                                <div class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                                    <i data-lucide="palette" class="w-3.5 h-3.5 text-blue-500"></i> Colors
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->colors as $color)
                                        @php
                                            $bgColor = $color->hex_code ? (str_starts_with($color->hex_code,'#') ? $color->hex_code : '#'.$color->hex_code) : ($color->name ?? '#ccc');
                                        @endphp
                                        <div class="tooltip" data-tip="{{ $color->name }}">
                                            <div class="w-8 h-8 border border-gray-200 rounded-full shadow-sm cursor-help hover:scale-110"
                                                 style="background-color: {{ $bgColor }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Sizes --}}
                        @if ($item->sizes->count())
                            <div class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl hover:border-indigo-200">
                                <div class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                                    <i data-lucide="ruler" class="w-3.5 h-3.5 text-indigo-500"></i> Sizes
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->sizes as $size)
                                        <span class="p-3 font-medium text-indigo-700 border-indigo-100 rounded-lg badge badge-ghost bg-indigo-50">
                                            {{ $size->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Packaging --}}
                        @if ($item->packagingTypes->count())
                            <div class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl md:col-span-2 lg:col-span-1 hover:border-purple-200">
                                <div class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                                    <i data-lucide="package" class="w-3.5 h-3.5 text-purple-500"></i> Packaging
                                </div>
                                <div class="flex flex-col gap-2">
                                    @php
                                        $runningTotal = 1;
                                        $previousName = 'pcs';
                                    @endphp
                                    @foreach ($item->packagingTypes as $index => $pack)
                                        @php
                                            $currentQty = $pack->pivot->quantity ?? 1;
                                            $absTotal = $currentQty * $runningTotal;
                                            $displayText = $index === 0
                                                ? "{$currentQty} pcs"
                                                : "{$currentQty} {$previousName}s = " . number_format($absTotal) . " pcs";
                                            $runningTotal = $absTotal;
                                            $previousName = $pack->name;
                                        @endphp
                                        <div class="flex items-center justify-between px-3 py-2 text-xs text-purple-900 border border-purple-100 rounded-lg bg-purple-50">
                                            <span class="font-bold">{{ $pack->name }}</span>
                                            <span>{{ $displayText }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- ADD VARIANT FORM --}}
            <div class="p-4 mb-6 rounded-xl bg-base-200" x-data="variantForm()">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Add Variant</h3>
                    <button type="button" class="btn btn-outline btn-sm" @click="addVariant()">+ Add Variant</button>
                </div>

                <form method="POST" action="{{ route('admin.variants.store', $item->id) }}">
                    @csrf
                    <template x-for="(variant, index) in newVariants" :key="index">
                        <div class="flex flex-wrap items-end gap-2 p-2 mb-2 border rounded-xl bg-base-100">
                            {{-- Color --}}
                            @if ($item->colors->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Color</label>
                                    <select x-model="variant.item_color_id" name="variants[][item_color_id]" class="w-full h-12 input input-sm input-bordered">
                                        <option value="">Select Color</option>
                                        @foreach ($item->colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Size --}}
                            @if ($item->sizes->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Size</label>
                                    <select x-model="variant.item_size_id" name="variants[][item_size_id]" class="w-full h-12 input input-sm input-bordered">
                                        <option value="">Select Size</option>
                                        @foreach ($item->sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Packaging --}}
                            @if ($item->packagingTypes->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Packaging</label>
                                    <select x-model="variant.item_packaging_type_id" name="variants[][item_packaging_type_id]" class="w-full h-12 input input-sm input-bordered">
                                        <option value="">Select Packaging</option>
                                        @foreach ($item->packagingTypes as $pack)
                                            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Price --}}
                            <div class="flex-1">
                                <label class="block text-xs font-medium">Price</label>
                                <input type="number" x-model="variant.price" :name="'variants[' + index + '][price]'" required class="w-full input input-sm input-bordered" step="0.01" min="0">
                            </div>

                            {{-- Stock --}}
                            <div class="flex-1">
                                <label class="block text-xs font-medium">Stock</label>
                                <input type="number" x-model="variant.stock" :name="'variants[' + index + '][stock]'" required class="w-full input input-sm input-bordered" min="0">
                            </div>

                            {{-- Inventory Location --}}
                            <div class="flex-1">
                                <label class="block text-xs font-medium">Inventory Location</label>
                                <select x-model="variant.inventory_location_id" :name="'variants[' + index + '][inventory_location_id]'" required class="w-full input input-sm input-bordered">
                                    <option value="">Select Location</option>
                                    @foreach ($inventoryLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Remove Variant --}}
                            <div class="flex items-center">
                                <button type="button" class="btn btn-error btn-sm" @click="newVariants.splice(index, 1)">Remove</button>
                            </div>
                        </div>
                    </template>

                    <button type="submit" class="mt-2 btn btn-primary">Save Variants</button>
                </form>
            </div>

            {{-- VARIANTS TABLE --}}
            <div class="overflow-x-auto rounded-xl bg-base-100">
                <table class="table w-full table-xs">
                    <thead>
                        <tr>
                            <th>#</th>
                            @if ($colors->isNotEmpty())
                                <th>Color</th>
                            @endif
                            @if ($sizes->isNotEmpty())
                                <th>Size</th>
                            @endif
                            @if ($packagingTypes->isNotEmpty())
                                <th>Packaging</th>
                            @endif
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->variants as $index => $variant)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                @if ($colors->isNotEmpty())
                                    <td>{{ $variant->itemColor->name ?? '-' }}</td>
                                @endif
                                @if ($sizes->isNotEmpty())
                                    <td>{{ optional($variant->itemSize)->name ?? '-' }}</td>
                                @endif
                                @if ($packagingTypes->isNotEmpty())
                                    <td>{{ optional($variant->itemPackagingType)->name ?? '-' }}</td>
                                @endif
                                <td>${{ number_format($variant->price, 2) }}</td>
                                <td>{{ $variant->stock }}</td>
                                <td>
                                    <span class="badge-{{ $variant->is_active ? 'success' : 'neutral' }} badge">
                                        {{ $variant->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        function variantForm() {
            return {
                newVariants: [],
                addVariant() {
                    this.newVariants.push({
                        item_color_id: null,
                        item_size_id: null,
                        item_packaging_type_id: null,
                        price: 0,
                        stock: 0,
                        inventory_location_id: '',
                        is_active: 1,
                    });
                }
            }
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</x-app-layout>
