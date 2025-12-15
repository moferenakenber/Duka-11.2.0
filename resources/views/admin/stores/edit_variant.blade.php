<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Store Variant — {{ $variant->item->product_name }} ({{ $store->name }})
        </h2>
    </x-slot>

    @php
        // Packaging rendering helper
        function renderPackagingHierarchy($variant) {
            if (!$variant->itemPackagingType) return '—';
            $pack = $variant->itemPackagingType;
            $pivot = $variant->item->packagingTypes->firstWhere('id', $pack->id)?->pivot;
            $qty = $pivot->quantity ?? 1;
            $totalPieces = method_exists($variant, 'calculateTotalPieces') ? $variant->calculateTotalPieces() : 0;

            return match(strtolower($pack->name)) {
                'piece' => "Piece ($qty pcs)",
                'packet' => "Packet ($qty pcs)",
                'cartoon' => "Cartoon ($qty pkt) ($totalPieces pcs)",
                default => $pack->name . " ($qty pcs)",
            };
        }

        // Store-specific pivot
        $pivot = $store->variants()->where('item_variant_id', $variant->id)->first()?->pivot;

        // Example seller & customer pivot (adjust according to your DB structure)
        $sellerPivot = $pivot?->seller ?? null;
        $customerPivot = $pivot?->customer ?? null;

        $variantData = [
            'store_price' => $pivot->price ?? 0,
            'store_discount_price' => $pivot->discount_price ?? null,
            'store_discount_ends_at' => optional($pivot)?->discount_ends_at?->format('Y-m-d\TH:i'),

            'seller_price' => $sellerPivot->price ?? null,
            'seller_discount_price' => $sellerPivot->discount_price ?? null,
            'seller_discount_ends_at' => optional($sellerPivot)?->discount_ends_at?->format('Y-m-d\TH:i'),

            'customer_price' => $customerPivot->price ?? null,
            'customer_discount_price' => $customerPivot->discount_price ?? null,
            'customer_discount_ends_at' => optional($customerPivot)?->discount_ends_at?->format('Y-m-d\TH:i'),

            'status' => $pivot->status ?? 'inactive',
        ];

    @endphp

    <div class="p-6 mb-6 rounded-xl bg-base-200" x-data="storeVariantForm({{ json_encode($variantData) }})">

       <form method="POST" action="{{ route('admin.stores.items.variants.update', [$store->id, $variant->item_id, $variant->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')




            {{-- ================= READ-ONLY VARIANT INFO ================= --}}
            <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2 lg:grid-cols-6">
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Variant ID</span>
                    <span class="font-semibold">{{ $variant->id }}</span>
                </div>
                <div class="p-4 border rounded-lg bg-sky-50">
                    <span class="block text-xs text-gray-500">SKU</span>
                    <span class="font-semibold">{{ $variant->item->sku ?? '—' }}</span>
                </div>
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Product</span>
                    <span class="font-semibold">{{ $variant->item->product_name }}</span>
                </div>
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Color</span>
                    <span class="font-semibold">{{ $variant->itemColor->name ?? '—' }}</span>
                </div>
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Size</span>
                    <span class="font-semibold">{{ $variant->itemSize->name ?? '—' }}</span>
                </div>
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Packaging</span>
                    <span class="text-sm font-semibold">{!! renderPackagingHierarchy($variant) !!}</span>
                </div>
                <div class="p-4 border rounded-lg">
                    <span class="block text-xs text-gray-500">Barcode</span>
                    <span class="font-semibold">{{ $variant->barcode ?? '—' }}</span>
                </div>
            </div>

            {{-- ================= VARIANT IMAGES (READ-ONLY) ================= --}}
            <div class="mb-6">
                <label class="block mb-2 text-xs font-semibold text-gray-600">
                    Variant Images (Global)
                </label>
                <div class="flex gap-2">
                    @foreach($variant->images ?? [] as $img)
                        <img src="{{ asset($img) }}" class="object-cover w-20 h-20 border rounded-lg">
                    @endforeach
                    @if(empty($variant->images))
                        <span class="text-xs text-gray-400">No images</span>
                    @endif
                </div>
            </div>

            {{-- ================= EDITABLE FIELDS ================= --}}
            <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3 lg:grid-cols-6">

                {{-- Store price (read-only) --}}
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Store Price</label>
                    <input type="number" step="0.01" name="store_price" x-model.number="store_price" class="w-full input input-sm input-bordered">

                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Store Discount Price</label>
                    <input type="number" step="0.01" value="{{ $variantData['store_discount_price'] }}" class="w-full bg-gray-100 input input-sm input-bordered" readonly>
                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Store Discount Ends</label>
                    <input type="datetime-local" value="{{ $variantData['store_discount_ends_at'] }}" class="w-full bg-gray-100 input input-sm input-bordered" readonly>
                </div>

                {{-- Seller Price --}}
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Seller Price</label>
                    <input type="number" step="0.01" name="seller_price" x-model.number="seller_price" class="w-full input input-sm input-bordered">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Seller Discount Price</label>
                    <input type="number" step="0.01" name="seller_discount_price" x-model.number="seller_discount_price" class="w-full input input-sm input-bordered">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Seller Discount Ends</label>
                    <input type="datetime-local" name="seller_discount_ends_at" x-model="seller_discount_ends_at" class="w-full input input-sm input-bordered">
                </div>

                {{-- Customer Price --}}
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Customer Price</label>
                    <input type="number" step="0.01" name="customer_price" x-model.number="customer_price" class="w-full input input-sm input-bordered">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Customer Discount Price</label>
                    <input type="number" step="0.01" name="customer_discount_price" x-model.number="customer_discount_price" class="w-full input input-sm input-bordered">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Customer Discount Ends</label>
                    <input type="datetime-local" name="customer_discount_ends_at" x-model="customer_discount_ends_at" class="w-full input input-sm input-bordered">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block mb-1 text-xs font-semibold text-gray-600">Status</label>
                    <select name="status" x-model="status" class="w-full input input-sm input-bordered">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

            </div>

            {{-- ================= ACTIONS ================= --}}
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.stores.items.variants', [$store->id, $variant->item_id]) }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Store Variant</button>
            </div>

        </form>
    </div>

    {{-- ================= ALPINE ================= --}}
    <script>
function storeVariantForm(data) {
    return {
        store_price: data.store_price,
        store_discount_price: data.store_discount_price,
        store_discount_ends_at: data.store_discount_ends_at,

        seller_price: data.seller_price,
        seller_discount_price: data.seller_discount_price,
        seller_discount_ends_at: data.seller_discount_ends_at,

        customer_price: data.customer_price,
        customer_discount_price: data.customer_discount_price,
        customer_discount_ends_at: data.customer_discount_ends_at,

        status: data.status,
    }
}

    </script>
</x-app-layout>
