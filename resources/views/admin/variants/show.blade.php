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

            {{-- Item Summary --}}
            <div class="flex items-start justify-between p-4 mb-6 bg-white shadow-md rounded-xl">
                <div class="flex flex-1 gap-4">
                    <div class="w-20 h-20 overflow-hidden rounded">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                            class="object-cover w-full h-full" alt="{{ $item->product_name }}">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->product_name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->product_description }}</p>
                        <div class="flex gap-2 mt-1">
                            <span class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">Price:
                                ${{ number_format($item->price, 2) }}</span>
                        </div>
                    </div>
                </div>
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
                                    <select x-model="variant.item_color_id" name="variants[][item_color_id]"
                                        class="w-full h-12 input input-sm input-bordered">
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
                                    <select x-model="variant.item_size_id" name="variants[][item_size_id]"
                                        class="w-full h-12 input input-sm input-bordered">
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
                                    <select x-model="variant.item_packaging_type_id" name="variants[][item_packaging_type_id]"
                                        class="w-full h-12 input input-sm input-bordered">
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
                                <input type="number" x-model="variant.price" :name="'variants[' + index + '][price]'" required
                                    class="w-full input input-sm input-bordered" step="0.01" min="0">
                            </div>

                            {{-- Stock --}}
                            <div class="flex-1">
                                <label class="block text-xs font-medium">Stock</label>
                                <input type="number" x-model="variant.stock" :name="'variants[' + index + '][stock]'" required
                                    class="w-full input input-sm input-bordered" min="0">
                            </div>

                            {{-- Inventory Location --}}
                            <div class="flex-1">
                                <label class="block text-xs font-medium">Inventory Location</label>
                                <select x-model="variant.inventory_location_id"
                                    :name="'variants[' + index + '][inventory_location_id]'" required
                                    class="w-full input input-sm input-bordered">
                                    <option value="">Select Location</option>
                                    @foreach ($inventoryLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Remove Variant --}}
                            <div class="flex items-center">
                                <button type="button" class="btn btn-error btn-sm"
                                    @click="newVariants.splice(index, 1)">Remove</button>
                            </div>
                        </div>
                    </template>

                    <button type="submit" class="mt-2 btn btn-primary">Save Variants</button>
                </form>
            </div>

            {{-- Variant Table --}}
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
                        item_packaging_type_ids: [],
                        price: 0,
                        stock: 0,
                        inventory_location_id: '',
                        is_active: 1,
                        barcode: '',
                        image: null,
                    });
                }
            }
        }
    </script>
</x-app-layout>
