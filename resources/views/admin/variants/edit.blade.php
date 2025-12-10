<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit Variant') }} - {{ $variant->item->product_name }}
            </h2>
        </div>
    </x-slot>

    @php
        $variantData = [
            'id' => $variant->id,
            'item_id' => $variant->item_id,
            'item_color_id' => $variant->item_color_id,
            'item_size_id' => $variant->item_size_id,
            'item_packaging_type_id' => $variant->item_packaging_type_id,
            'price' => $variant->price ?? 0,
            'discount_price' => $variant->discount_price,
            'barcode' => $variant->barcode,
            'status' => $variant->status ?? 'inactive',
            'images' => $variant->images ? json_decode($variant->images) : [],
            'store_prices' => [], // start empty, only added via the button

            'customer_prices' => $variant->customerPrices->map(fn($cp) => [
                'customer_id' => $cp->customer_id,
                'price' => $cp->price,
                'discount_price' => $cp->discount_price,
                'discount_ends_at' => $cp->discount_ends_at?->format('Y-m-d H:i:s'),
            ]),
            'seller_prices' => $variant->sellerPrices->map(fn($sp) => [
                'seller_id' => $sp->seller_id,
                'price' => $sp->price,
                'discount_price' => $sp->discount_price,
                'discount_ends_at' => $sp->discount_ends_at?->format('Y-m-d H:i:s'),
            ]),
        ];
    @endphp

    <div class="p-4 mb-6 rounded-xl bg-base-200"
         x-data="variantForm({{ json_encode([$variantData]) }})">

        <form method="POST" action="{{ route('admin.variants.crud.update', $variant->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <template x-for="(variant, index) in variants" :key="index">
                <div class="w-full p-5 mb-6 overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-lg card rounded-3xl hover:shadow-xl">

{{-- Read-only info cards --}}
<div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2 lg:grid-cols-6">

    {{-- ID --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">ID</span>
        <span class="font-semibold text-gray-800">{{ $variant->id }}</span>
    </div>

    {{-- SKU --}}
    <div class="p-4 border rounded-lg bg-sky-100">
        <span class="block text-xs text-gray-500">SKU</span>
        <span class="font-semibold text-gray-800">{{ $variant->item->sku ?? '—' }}</span>
    </div>

    {{-- Name --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">Name</span>
        <span class="font-semibold text-gray-800">{{ $variant->item->product_name }}</span>
    </div>

    {{-- Color --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">Color</span>
        <span class="font-semibold text-gray-800">{{ $variant->itemColor->name ?? '—' }}</span>
    </div>

    {{-- Size --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">Size</span>
        <span class="font-semibold text-gray-800">{{ $variant->itemSize->name ?? '—' }}</span>
    </div>

    {{-- Packaging --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">Packaging</span>
        <span class="font-semibold text-gray-800">{{ $variant->itemPackagingType->name ?? '—' }}</span>
    </div>

    {{-- Barcode --}}
    <div class="p-4 border rounded-lg">
        <span class="block text-xs text-gray-500">Barcode</span>
        <span class="font-semibold text-gray-800">{{ $variant->barcode ?? '—' }}</span>
    </div>
</div>

                    {{-- Images --}}
                    <div x-data="variantFileUpload(index)" class="mb-4">
                        <label class="label">Variant Images</label>
                        <input type="file" :name="`variants[${index}][image][]`" multiple
                               class="w-full file-input file-input-bordered" @change="uploadFiles($event)">

                        <div class="flex gap-2 mt-2">
                            <template x-for="img in variant.images" :key="img">
                                <img :src="imageUrl(img)" class="object-cover w-20 h-20 border rounded-lg">
                            </template>
                        </div>

                        <template x-for="img in variant.images" :key="img">
                            <input type="hidden" :name="`variants[${index}][image_paths][]`" :value="img">
                        </template>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                        {{-- Price --}}
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Price</label>
                            <input type="number" x-model="variant.price" :name="`variants[${index}][price]`"
                                   class="w-full h-12 input input-sm input-bordered" placeholder="Price">
                        </div>

                        {{-- Discount Price --}}
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Price</label>
                            <input type="number" x-model="variant.discount_price" :name="`variants[${index}][discount_price]`"
                                   class="w-full h-12 input input-sm input-bordered" placeholder="Discount Price">
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Status</label>
                            <select x-model="variant.status" :name="`variants[${index}][status]`"
                                    class="w-full h-12 input input-sm input-bordered">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

           {{-- Store-specific prices --}}
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700">Store Prices</h3>

    <template x-for="(st, stIndex) in variant.store_prices" :key="stIndex">
        <div class="grid grid-cols-1 gap-2 p-2 mt-2 border rounded-lg bg-gray-50 md:grid-cols-6">

            {{-- Store dropdown --}}
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-600">Store</label>
                <select x-model="st.store_id"
                        :name="`variants[${index}][store_prices][${stIndex}][store_id]`"
                        class="w-full h-10 text-sm input input-sm input-bordered">
                    <option value="">Select Store</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-600">Price</label>
                <input type="number"
                       x-model="st.price"
                       :name="`variants[${index}][store_prices][${stIndex}][price]`"
                       class="w-full h-10 text-sm input input-sm input-bordered"
                       placeholder="Price">
            </div>

            {{-- Discount Price --}}
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Price</label>
                <input type="number"
                       x-model="st.discount_price"
                       :name="`variants[${index}][store_prices][${stIndex}][discount_price]`"
                       class="w-full h-10 text-sm input input-sm input-bordered"
                       placeholder="Discount Price">
            </div>

            {{-- Discount Ends --}}
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Ends</label>
                <input type="datetime-local"
                       x-model="st.discount_ends_at"
                       :name="`variants[${index}][store_prices][${stIndex}][discount_ends_at]`"
                       class="w-full h-10 text-sm input input-sm input-bordered">
            </div>

            {{-- Stock --}}
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-600">Stock</label>
                <input type="number"
                       x-model="st.stock"
                       :name="`variants[${index}][store_prices][${stIndex}][stock]`"
                       class="w-full h-10 text-sm input input-sm input-bordered"
                       placeholder="Stock">
            </div>

            {{-- Remove Button --}}
            <div class="flex items-end">
                <button type="button"
                        class="w-full h-10 btn btn-error btn-sm"
                        @click="variant.store_prices.splice(stIndex, 1)">
                    Remove
                </button>
            </div>

        </div>
    </template>

    <button type="button"
            class="mt-2 btn btn-outline btn-sm"
            @click="addStorePrice(index)">
        + Add Store Price
    </button>
</div>


{{-- Seller-specific prices --}}
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700">Seller Prices</h3>
    <template x-for="(sp, sIndex) in variant.seller_prices" :key="sIndex">
        <div class="flex gap-2 p-2 mt-2 border rounded-lg bg-gray-50">
            <select x-model="sp.seller_id"
                    :name="`variants[${index}][seller_prices][${sIndex}][seller_id]`"
                    class="flex-1 text-base text-black input input-sm input-bordered">
                <option value="">Select Seller</option>
                @foreach($sellers as $seller)
                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                @endforeach
            </select>
            <input type="number" x-model="sp.price"
                   :name="`variants[${index}][seller_prices][${sIndex}][price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Price">
            <input type="number" x-model="sp.discount_price"
                   :name="`variants[${index}][seller_prices][${sIndex}][discount_price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Discount Price">
            <input type="datetime-local" x-model="sp.discount_ends_at"
                   :name="`variants[${index}][seller_prices][${sIndex}][discount_ends_at]`"
                   class="text-base text-black input input-sm input-bordered">
            <button type="button" class="btn btn-error btn-sm" @click="variant.seller_prices.splice(sIndex, 1)">Remove</button>
        </div>
    </template>
    <button type="button" class="mt-2 btn btn-outline btn-sm"
            @click="variant.seller_prices.push({seller_id:'', price:0, discount_price:null, discount_ends_at:null})">
        + Add Seller Price
    </button>
</div>

{{-- Customer-specific prices --}}
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700">Customer Prices</h3>
    <template x-for="(cp, cIndex) in variant.customer_prices" :key="cIndex">
        <div class="flex gap-2 p-2 mt-2 border rounded-lg bg-gray-50">
            <select x-model="cp.customer_id"
                    :name="`variants[${index}][customer_prices][${cIndex}][customer_id]`"
                    class="flex-1 text-base text-black input input-sm input-bordered">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            <input type="number" x-model="cp.price"
                   :name="`variants[${index}][customer_prices][${cIndex}][price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Price">
            <input type="number" x-model="cp.discount_price"
                   :name="`variants[${index}][customer_prices][${cIndex}][discount_price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Discount Price">
            <input type="datetime-local" x-model="cp.discount_ends_at"
                   :name="`variants[${index}][customer_prices][${cIndex}][discount_ends_at]`"
                   class="text-base text-black input input-sm input-bordered">
            <button type="button" class="btn btn-error btn-sm" @click="variant.customer_prices.splice(cIndex, 1)">Remove</button>
        </div>
    </template>
    <button type="button" class="mt-2 btn btn-outline btn-sm"
            @click="variant.customer_prices.push({customer_id:'', price:0, discount_price:null, discount_ends_at:null})">
        + Add Customer Price
    </button>
</div>

{{-- Online-specific prices --}}
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700">Online Prices</h3>
    <template x-for="(op, oIndex) in variant.online_prices" :key="oIndex">
        <div class="flex gap-2 p-2 mt-2 border rounded-lg bg-gray-50">
            <input type="number" x-model="op.price"
                   :name="`variants[${index}][online_prices][${oIndex}][price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Price">
            <input type="number" x-model="op.discount_price"
                   :name="`variants[${index}][online_prices][${oIndex}][discount_price]`"
                   class="text-base text-black input input-sm input-bordered"
                   placeholder="Discount Price">
            <input type="datetime-local" x-model="op.discount_ends_at"
                   :name="`variants[${index}][online_prices][${oIndex}][discount_ends_at]`"
                   class="text-base text-black input input-sm input-bordered">
            <button type="button" class="btn btn-error btn-sm" @click="variant.online_prices.splice(oIndex, 1)">Remove</button>
        </div>
    </template>
    <button type="button" class="mt-2 btn btn-outline btn-sm"
            @click="variant.online_prices.push({price:0, discount_price:null, discount_ends_at:null})">
        + Add Online Price
    </button>
</div>


                </div>
            </template>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Variant</button>
            </div>
        </form>
    </div>

    <script>
        function variantForm(initialVariants = []) {
            return {
                variants: initialVariants,
                addVariant() {
                    this.variants.push({
                        item_color_id: '',
                        item_size_id: '',
                        item_packaging_type_id: '',
                        price: 0,
                        discount_price: null,
                        barcode: null,
                        status: 'inactive',
                        images: [],
                        store_prices: [],
                        seller_prices: [],
                        customer_prices: [],
                    });
                },
                updateCapacity(index, event) {
                    const selected = event.target.selectedOptions[0];
                    const quantity = selected ? selected.dataset.quantity : 0;
                    this.variants[index].capacityText = quantity ? quantity + ' pcs' : '';
                    this.variants[index].totalPieces = quantity || 0;
                },
                imageUrl(path) {
                    return path.startsWith('http') ? path : '{{ asset('') }}' + path;
                },
                addStorePrice(index) {
                    this.variants[index].store_prices.push({
                        store_id: '',
                        price: 0,
                        discount_price: null,
                        discount_ends_at: null,
                        stock: 0
                    });
                }

            }
        }

        function variantFileUpload(index) {
            return {
                images: Alpine.store('variants')?.[index]?.images || [],
                uploading: false,
                progress: 0,
                uploadFiles(event) {
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const reader = new FileReader();
                        reader.onload = e => this.images.push(e.target.result);
                        reader.readAsDataURL(files[i]);
                    }
                }
            }
        }
    </script>
</x-app-layout>
