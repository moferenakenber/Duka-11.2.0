<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Store Variant') }} - {{ $variant->item->product_name }} ({{ $store->name }})
        </h2>
    </x-slot>

    @php
        // Get the pivot row for this store
        $storePivot = $store->variants()->where('item_variant_id', $variant->id)->first()?->pivot;

        $variantData = [
            'id' => $variant->id,
            'item_id' => $variant->item_id,
            'item_color_id' => $variant->item_color_id,
            'item_size_id' => $variant->item_size_id,
            'item_packaging_type_id' => $variant->item_packaging_type_id,
            'price' => $storePivot->price ?? 0,
            'discount_price' => $storePivot->discount_price ?? null,
            'stock' => $storePivot->stock ?? 0,
            'discount_ends_at' => $storePivot?->discount_ends_at?->format('Y-m-d\TH:i') ?? null,
            'barcode' => $variant->barcode,
            'status' => $variant->status ?? 'inactive',
            'images' => $variant->images ? json_decode($variant->images) : [],
        ];
    @endphp

    <div class="p-4 mb-6 rounded-xl bg-base-200" x-data="storeVariantForm({{ json_encode($variantData) }})">

        <form method="POST" action="{{ route('admin.store.variants.update', [$store->id, $variant->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Read-only info --}}
            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2 lg:grid-cols-6">
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">ID</span>
                    <span class="font-semibold text-gray-800">{{ $variant->id }}</span>
                </div>

                <div class="p-4 border rounded-lg bg-sky-100">
                    <span class="block text-xs text-gray-500">SKU</span>
                    <span class="font-semibold text-gray-800">{{ $variant->item->sku ?? '—' }}</span>
                </div>

                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Name</span>
                    <span class="font-semibold text-gray-800">{{ $variant->item->product_name }}</span>
                </div>

                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Color</span>
                    <span class="font-semibold text-gray-800">{{ $variant->itemColor->name ?? '—' }}</span>
                </div>

                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Size</span>
                    <span class="font-semibold text-gray-800">{{ $variant->itemSize->name ?? '—' }}</span>
                </div>

                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Packaging</span>
                    <span class="font-semibold text-gray-800">{{ $variant->itemPackagingType->name ?? '—' }}</span>
                </div>

                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Barcode</span>
                    <span class="font-semibold text-gray-800">{{ $variant->barcode ?? '—' }}</span>
                </div>
            </div>

            {{-- Store-specific pricing --}}
            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4 lg:grid-cols-6">
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Price</label>
                    <input type="number" x-model="price" name="price"
                           class="w-full h-12 input input-sm input-bordered" placeholder="Price">
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Price</label>
                    <input type="number" x-model="discount_price" name="discount_price"
                           class="w-full h-12 input input-sm input-bordered" placeholder="Discount Price">
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Stock</label>
                    <input type="number" x-model="stock" name="stock"
                           class="w-full h-12 input input-sm input-bordered" placeholder="Stock">
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Ends</label>
                    <input type="datetime-local" x-model="discount_ends_at" name="discount_ends_at"
                           class="w-full h-12 input input-sm input-bordered">
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Status</label>
                    <select x-model="status" name="status" class="w-full h-12 input input-sm input-bordered">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            {{-- Images --}}
            <div x-data="fileUpload()" class="mb-4">
                <label class="label">Variant Images</label>
                <input type="file" name="images[]" multiple class="w-full file-input file-input-bordered" @change="uploadFiles($event)">

                <div class="flex gap-2 mt-2">
                    <template x-for="img in images" :key="img">
                        <img :src="imageUrl(img)" class="object-cover w-20 h-20 border rounded-lg">
                    </template>
                </div>

                <template x-for="img in images" :key="img">
                    <input type="hidden" name="image_paths[]" :value="img">
                </template>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Variant</button>
            </div>
        </form>
    </div>

    <script>
        function storeVariantForm(variant) {
            return {
                ...variant,
            }
        }

        function fileUpload() {
            return {
                images: Alpine.store('variants')?.[0]?.images || [],
                uploadFiles(event) {
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const reader = new FileReader();
                        reader.onload = e => this.images.push(e.target.result);
                        reader.readAsDataURL(files[i]);
                    }
                },
                imageUrl(path) {
                    return path.startsWith('http') ? path : '{{ asset('') }}' + path;
                }
            }
        }
    </script>
</x-app-layout>
