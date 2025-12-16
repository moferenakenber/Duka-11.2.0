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

        $sellerPivot = $pivot?->seller ?? null;
        $customerPivot = $pivot?->customer ?? null;

        $storeDiscountEnds = $pivot?->discount_ends_at ? \Carbon\Carbon::parse($pivot->discount_ends_at)->format('Y-m-d\TH:i') : null;
        $sellerDiscountEnds = $sellerPivot?->discount_ends_at ? \Carbon\Carbon::parse($sellerPivot->discount_ends_at)->format('Y-m-d\TH:i') : null;
        $customerDiscountEnds = $customerPivot?->discount_ends_at ? \Carbon\Carbon::parse($customerPivot->discount_ends_at)->format('Y-m-d\TH:i') : null;

        $variantData = [
            'store_price' => $pivot->price ?? 0,
            'store_discount_price' => $pivot->discount_price ?? null,
            'store_discount_ends_at' => $storeDiscountEnds,

            'seller_price' => $sellerPivot?->price,
            'seller_discount_price' => $sellerPivot?->discount_price,
            'seller_discount_ends_at' => $sellerDiscountEnds,

            'customer_price' => $customerPivot?->price,
            'customer_discount_price' => $customerPivot?->discount_price,
            'customer_discount_ends_at' => $customerDiscountEnds,

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


        {{-- STORE PRICE --}}
        <div>
            <label class="block mb-1 text-xs font-semibold text-gray-600">Store Price</label>
            <input type="number" step="0.01" name="store_price" x-model.number="store_price" class="w-full input input-sm input-bordered">
        </div>

        <div>
            <label class="block mb-1 text-xs font-semibold text-gray-600">Store Discount Price</label>
            <input type="number" step="0.01" x-model.number="store_discount_price" class="w-full input input-sm input-bordered" readonly>
        </div>


        {{-- SELLER PRICE --}}
        <div x-data="{ showSeller: {{ $sellerPivot ? 'true' : 'false' }} }">
            <label class="block mb-1 text-xs font-semibold text-gray-600">Seller Price</label>

            <template x-if="showSeller">
                <div class="space-y-1">
                    <input type="number" step="0.01" name="seller_price" x-model.number="seller_price" class="w-full input input-sm input-bordered">
                    <input type="number" step="0.01" name="seller_discount_price" x-model.number="seller_discount_price" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                    <input type="datetime-local" name="seller_discount_ends_at" x-model="seller_discount_ends_at" class="w-full input input-sm input-bordered">
                </div>
            </template>

            <template x-if="!showSeller">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">No Seller Price</span>
                    <button type="button" class="btn btn-xs btn-outline" @click="showSeller = true; seller_price = 0;">Add Seller Price</button>
                </div>
            </template>
        </div>

        {{-- CUSTOMER PRICE --}}
        <div x-data="{ showCustomer: {{ $customerPivot ? 'true' : 'false' }} }" class="mt-4">
            <label class="block mb-1 text-xs font-semibold text-gray-600">Customer Price</label>

            <template x-if="showCustomer">
                <div class="space-y-1">
                    <input type="number" step="0.01" name="customer_price" x-model.number="customer_price" class="w-full input input-sm input-bordered">
                    <input type="number" step="0.01" name="customer_discount_price" x-model.number="customer_discount_price" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                    <input type="datetime-local" name="customer_discount_ends_at" x-model="customer_discount_ends_at" class="w-full input input-sm input-bordered">
                </div>
            </template>

            <template x-if="!showCustomer">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">No Customer Price</span>
                    <button type="button" class="btn btn-xs btn-outline" @click="showCustomer = true; customer_price = 0;">Add Customer Price</button>
                </div>
            </template>
        </div>

        {{-- STATUS --}}
<div class="mt-4">
    <label class="block mb-1 text-base font-semibold text-gray-600">Status</label>
    <select name="status" x-model="status" class="w-full input input-bordered !text-2xl !py-2">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
</div>



        {{-- ACTIONS --}}
        <div class="flex justify-end gap-3 pt-4 mt-4 border-t">
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

        // Log everything in one place
        logAll() {
            console.log('--- Variant Prices & Status ---');
            console.log('Store:', {
                price: this.store_price,
                discount_price: this.store_discount_price,
                discount_ends_at: this.store_discount_ends_at,
            });
            console.log('Seller:', {
                price: this.seller_price,
                discount_price: this.seller_discount_price,
                discount_ends_at: this.seller_discount_ends_at,
            });
            console.log('Customer:', {
                price: this.customer_price,
                discount_price: this.customer_discount_price,
                discount_ends_at: this.customer_discount_ends_at,
            });
            console.log('Status:', this.status);
            console.log('------------------------------');
        }
    }
}
    </script>
</x-app-layout>
