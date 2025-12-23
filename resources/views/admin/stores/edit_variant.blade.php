<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Store Variant — {{ $variant->item->product_name }} ({{ $store->name }})
        </h2>
    </x-slot>

<div class="p-6 mb-6 rounded-xl bg-base-200"
     x-data="storeVariantForm({
        ...@js($variantData),
        storeId: {{ $store->id }},
        itemId: {{ $item->id }},
        variantId: {{ $variant->id }}
     })">


    <div x-show="showMessage"
        x-transition
        :class="messageType === 'success' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'"
        class="fixed z-50 px-4 py-2 font-semibold rounded shadow top-4 right-4">
        <span x-text="message"></span>
    </div>


        <form
            method="POST"
            action="{{ route('admin.stores.items.variants.update', [$store->id, $variant->item_id, $variant->id]) }}"
            @submit.prevent="
                if (!isDiscountValid(store_price, store_discount_price)) {
                    showTempMessage('Discount price cannot exceed price', 'error');
                    return;
                }

                if (store_discount_price > 0 && !store_discount_ends_at) {
                    showTempMessage('Discount end date is required when a discount is set', 'error');
                    return;
                }

                $el.submit();
            "
        >



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
                <span class="text-sm font-semibold" x-text="variantPackaging"></span>
            </div>
            <div class="p-4 border rounded-lg">
                <span class="block text-xs text-gray-500">Barcode</span>
                <span class="font-semibold">{{ $variant->barcode ?? '—' }}</span>
            </div>
        </div>

        {{-- STORE PRICE --}}
        <div class="mb-4">
            <label class="block mb-1 text-xs font-semibold text-gray-600">Store Price</label>
            <input type="number" step="0.01" name="store_price" x-model.number="store_price" class="w-full input input-sm input-bordered">
        </div>

        <div class="mb-6">
            <label class="block mb-1 text-xs font-semibold text-gray-600">Store Discount Price</label>
            <input type="number"
                step="0.01"
                name="store_discount_price"
                x-model.number="store_discount_price"
                :class="!isDiscountValid(store_price, store_discount_price) ? 'border-red-500' : ''"
                class="w-full input input-sm input-bordered">

            <p x-show="!isDiscountValid(store_price, store_discount_price)"
            class="mt-1 text-xs text-red-600">
            Discount cannot be higher than price
            </p>

        </div>

        {{-- STORE DISCOUNT ENDS --}}
        <div class="mb-4" x-show="store_discount_price > 0">
            <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Ends</label>
            <input type="datetime-local"
                name="store_discount_ends_at"
                x-model="store_discount_ends_at"
                class="w-full input input-sm input-bordered">
        </div>

        {{-- SELLERS --}}
       <div class="mb-6">
            <label class="block mb-2 text-xs font-semibold text-gray-600">Sellers Prices</label>


            <template x-for="(seller, index) in sellers" :key="seller.id">
                <div
                    class="relative p-4 mb-2 space-y-2 border rounded-lg bg-sky-50"
                    x-show="!seller._deleted_ui"

                >
                    <!-- Toast Notification above card -->
                    <div
                        x-show="seller.saved"
                        x-transition
                        class="absolute px-3 py-1 text-sm text-green-700 -translate-x-1/2 bg-green-100 rounded shadow -top-8 left-1/2"
                    >
                        Saved successfully!
                    </div>


                    <!-- Seller Header -->
                    <div class="flex items-center justify-between">
                        <span class="font-semibold" x-text="seller.name"></span>

                        <div class="flex gap-1">
                            <button type="button" class="btn btn-xs btn-outline" x-show="!seller.editing"
                                    @click="seller._backup = JSON.parse(JSON.stringify(seller)); seller.editing = true">
                                Edit
                            </button>

                            <button type="button" class="btn btn-xs btn-success" x-show="seller.editing"
                                    @click="saveSeller(index)">
                                Save
                            </button>

                            <button type="button" class="btn btn-xs btn-warning" x-show="seller.editing"
                                    @click="Object.assign(seller, seller._backup); seller.editing = false">
                                Cancel
                            </button>

                            <button type="button" class="btn btn-xs btn-error" x-show="seller.editing"
                                    @click="deleteSeller(index)">
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Seller info -->
                    <div x-show="!seller.editing" class="space-y-1 text-gray-700">
                        <div>Price: <span x-text="seller.price"></span></div>
                        <div>Discount Price: <span x-text="seller.discount_price ?? '—'"></span></div>
                        <div>Discount Ends: <span x-text="seller.discount_ends_at ?? '—'"></span></div>
                    </div>

                    <!-- Edit mode inputs -->
                    <div x-show="seller.editing" class="space-y-2">
                        <input type="number" :name="`seller_price[${index}]`" x-model.number="seller.price" placeholder="Price" class="w-full input input-sm input-bordered">
                        <input type="number" :name="`seller_discount_price[${index}]`" x-model.number="seller.discount_price" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                        <input type="datetime-local" :name="`seller_discount_ends_at[${index}]`" x-model="seller.discount_ends_at" class="w-full input input-sm input-bordered" :min="new Date().toISOString().slice(0,16)">
                    </div>
                </div>
            </template>



            {{-- Add Seller Toggle --}}
            <div class="mt-4">
                <button type="button" class="btn btn-xs btn-outline" @click="showAddSeller = !showAddSeller">
                    Add Seller
                </button>

                <div x-show="showAddSeller" x-cloak class="p-4 mt-2 space-y-2 border rounded-lg bg-sky-100">
                    {{-- Label for select --}}
                    <label class="block text-xs font-semibold text-gray-600">Select Seller</label>
                    <select x-model="newSellerId" class="w-full input input-bordered input-lg">
                        <option value="">Select Seller</option>
                        <template x-for="seller in availableSellers" :key="seller.id">
                            <option :value="seller.id" x-text="seller.name"></option>
                        </template>
                    </select>

                    <div x-show="newSellerId" class="grid grid-cols-1 gap-2 mt-2 md:grid-cols-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Price</label>
                            <input type="number" x-model.number="newSellerPrice" placeholder="Price" class="w-full input input-sm input-bordered">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Discount Price</label>
                            <input type="number" x-model.number="newSellerDiscountPrice" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Discount Ends</label>
                            <input type="datetime-local" x-model="newSellerDiscountEndsAt" class="w-full input input-sm input-bordered">
                        </div>

                        <div class="md:col-span-3">
                            <button type="button" class="w-full py-2 text-sm btn btn-outline"
                                @click="
                                    let s = availableSellers.find(s => s.id == newSellerId);
                                    sellers.push({
                                        ...s,
                                        new: true,
                                        editing: false,
                                        price: newSellerPrice || 0,
                                        discount_price: newSellerDiscountPrice ? Number(newSellerDiscountPrice) : null,
                                        discount_ends_at: newSellerDiscountEndsAt || null,
                                    });
                                    newSellerId = '';
                                    newSellerPrice = 0;
                                    newSellerDiscountPrice = 0;
                                    newSellerDiscountEndsAt = null;
                                    showAddSeller = false;
                                ">
                                Confirm Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- CUSTOMERS --}}
       <div class="mb-6">
            <label class="block mb-2 text-xs font-semibold text-gray-600">Customers Prices</label>

           <template x-for="(customer, index) in customers" :key="customer.id">
                <div
                    class="relative p-4 mb-2 space-y-2 border rounded-lg bg-green-50"
                    x-show="!customer._deleted_ui"
                >
                    <!-- Toast Notification -->
                    <div
                        x-show="customer.saved"
                        x-transition
                        class="absolute px-3 py-1 text-sm text-green-700 -translate-x-1/2 bg-green-100 rounded shadow -top-8 left-1/2"
                    >
                        Saved successfully!
                    </div>

                    <!-- Customer Header -->
                    <div class="flex items-center justify-between">
                        <span class="font-semibold" x-text="customer.name"></span>

                        <div class="flex gap-1">
                            <button type="button" class="btn btn-xs btn-outline" x-show="!customer.editing"
                                    @click="customer._backup = JSON.parse(JSON.stringify(customer)); customer.editing = true">
                                Edit
                            </button>

                            <button type="button" class="btn btn-xs btn-success" x-show="customer.editing"
                                    @click="saveCustomer(index)">
                                Save
                            </button>

                            <button type="button" class="btn btn-xs btn-warning" x-show="customer.editing"
                                    @click="Object.assign(customer, customer._backup); customer.editing = false">
                                Cancel
                            </button>

                            <button type="button" class="btn btn-xs btn-error" x-show="customer.editing"
                                    @click="deleteCustomer(index)">
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Customer info -->
                    <div x-show="!customer.editing" class="space-y-1 text-gray-700">
                        <div>Price: <span x-text="customer.price"></span></div>
                        <div>Discount Price: <span x-text="customer.discount_price ?? '—'"></span></div>
                        <div>Discount Ends: <span x-text="customer.discount_ends_at ?? '—'"></span></div>
                    </div>

                    <!-- Edit mode inputs -->
                    <div x-show="customer.editing" class="space-y-2">
                        <input type="number" :name="`customer_price[${index}]`" x-model.number="customer.price" placeholder="Price" class="w-full input input-sm input-bordered">
                        <input type="number" :name="`customer_discount_price[${index}]`" x-model.number="customer.discount_price" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                        <input type="datetime-local"
                            :name="`customer_discount_ends_at[${index}]`"
                            x-model="customer.discount_ends_at"
                            class="w-full input input-sm input-bordered"
                            :min="new Date().toISOString().slice(0,16)">
                    </div>
                </div>
            </template>


            {{-- Add Customer Toggle --}}
           {{-- Add Customer Toggle --}}
            <div class="mt-4">
                <button type="button" class="btn btn-xs btn-outline" @click="showAddCustomer = !showAddCustomer">
                    Add Customer
                </button>

                <div x-show="showAddCustomer" x-cloak class="p-4 mt-2 space-y-2 bg-green-100 border rounded-lg">
                    {{-- Label for select --}}
                    <label class="block text-xs font-semibold text-gray-600">Select Customer</label>
                    <select x-model="newCustomerId" class="w-full input input-bordered input-lg">
                        <option value="">Select Customer</option>
                        <template x-for="customer in availableCustomers" :key="customer.id">
                            <option :value="customer.id" x-text="customer.name"></option>
                        </template>
                    </select>

                    <!-- Inputs appear only when a customer is selected -->
                    <div x-show="newCustomerId" class="grid grid-cols-1 gap-2 mt-2 md:grid-cols-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Price</label>
                            <input type="number" x-model.number="newCustomerPrice" placeholder="Price" class="w-full input input-sm input-bordered">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Discount Price</label>
                            <input type="number" x-model.number="newCustomerDiscountPrice" placeholder="Discount Price" class="w-full input input-sm input-bordered">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600">Discount Ends</label>
                            <input type="datetime-local" x-model="newCustomerDiscountEndsAt" class="w-full input input-sm input-bordered">
                        </div>

                        <div class="md:col-span-3">
                            <button type="button" class="w-full py-2 text-sm btn btn-outline"
                                @click="
                                    let c = availableCustomers.find(c => c.id == newCustomerId);
                                    customers.push({
                                        ...c,
                                        new: true,
                                        editing: false,
                                        price: newCustomerPrice || 0,
                                        discount_price: newCustomerDiscountPrice ? Number(newCustomerDiscountPrice) : null,
                                        discount_ends_at: newCustomerDiscountEndsAt || null,
                                    });
                                    // reset
                                    newCustomerId = '';
                                    newCustomerPrice = 0;
                                    newCustomerDiscountPrice = 0;
                                    newCustomerDiscountEndsAt = null;
                                    showAddCustomer = false;
                                ">
                                Confirm Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        {{-- STATUS --}}
        {{-- STATUS MODE --}}
        <div class="mb-4">
            <label class="block mb-1 text-base font-semibold text-gray-600">
                Status Mode
            </label>

            <select
                name="manual_status"
                x-model="manual_status"
                class="w-full input input-bordered"
            >
                <option value="auto">Automatic (System Managed)</option>
                <option value="forced">Forced (Manual)</option>
            </select>

            <p class="mt-1 text-xs text-gray-500">
                Automatic = system decides based on stock & rules
            </p>
        </div>

        {{-- FORCED STATUS --}}
        <div class="mb-6" x-show="manual_status === 'forced'" x-transition>
            <label class="block mb-1 text-base font-semibold text-gray-600">
                Forced Status
            </label>

            <select
                name="forced_status"
                x-model="forced_status"
                class="w-full input input-bordered"
            >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="out_of_stock">Out of Stock</option>
                <option value="unavailable">Unavailable</option>
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

        storeId: data.storeId,
        itemId: data.itemId,
        variantId: data.variantId,
        store_price: data.store_price ?? 0,
        store_discount_price: data.store_discount_price ?? 0,
        //store_discount_ends_at: data.store_discount_ends_at ?? '',
        store_discount_ends_at: data.store_discount_ends_at ?? null,


        manual_status: data.manual_status ?? 'auto',
        forced_status: data.forced_status ?? null,

        active: data.active,



        sellers: data.sellers.map(s => ({ ...s, new: false, editing: false, saved: false })),
        customers: data.customers.map(c => ({ ...c, new: false, editing: false, saved: false })),


        activeSellerId: '',
        activeCustomerId: '',

        availableSellers: data.available_sellers ?? [],
        availableCustomers: data.available_customers ?? [],

        variantPackaging: data.packaging_name ?? '—',

                showAddSeller: false,
                newSellerId: '',
                newSellerPrice: 0,
                newSellerDiscountPrice: 0,
                newSellerDiscountEndsAt: null,

                showAddCustomer: false,
                newCustomerId: '',
                newCustomerPrice: 0,
                newCustomerDiscountPrice: 0,
                newCustomerDiscountEndsAt: null,


        get activeSeller() {
            return this.sellers.find(s => s.id == this.activeSellerId)
        },

        get activeCustomer() {
            return this.customers.find(c => c.id == this.activeCustomerId)
        },

        async updateSellerPrice() {
    try {
        const res = await fetch(`/admin/stores/${this.storeId}/items/${this.itemId}/variants/${this.variantId}/seller-price`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ seller_price: this.sellerPrice })
        });

        if (!res.ok) throw new Error('Request failed');
        const data = await res.json();
        console.log('Updated:', data);
    } catch (e) {
        console.error(e);
    }
},

        // Log function
        logAll() {
            console.group('Store Variant Edit');
            console.log('Store', {
                price: this.store_price,
                discount_price: this.store_discount_price,
                discount_ends_at: this.store_discount_ends_at,
                status: this.status,
            });

            if (this.activeSeller) {
                console.log('Seller', {
                    id: this.activeSeller.id,
                    price: this.activeSeller.price,
                    discount_price: this.activeSeller.discount_price,
                    discount_ends_at: this.activeSeller.discount_ends_at,
                });
            } else {
                console.log('Seller', 'No seller selected');
            }

            if (this.activeCustomer) {
                console.log('Customer', {
                    id: this.activeCustomer.id,
                    price: this.activeCustomer.price,
                    discount_price: this.activeCustomer.discount_price,
                    discount_ends_at: this.activeCustomer.discount_ends_at,
                });
            } else {
                console.log('Customer', 'No customer selected');
            }
            console.groupEnd();
        },

        isDiscountValid(price, discount) {
            if (discount === null || discount === '' || discount === 0) return true;
            return Number(discount) <= Number(price);
        },




        message: '',           // global message
        messageType: 'success', // 'success' | 'error'
        showMessage: false,

        showTempMessage(msg, type = 'success') {
            this.message = msg;
            this.messageType = type;
            this.showMessage = true;
            setTimeout(() => this.showMessage = false, 3000); // hide after 3s
        },

        deleteSeller(index) {
            if (!confirm('Delete this seller price?')) return;

            this.sellers[index]._delete = true;
            this.sellers[index]._deleted_ui = true;
        },




        saveSeller(index) {
            let seller = this.sellers[index];

            if (!this.isDiscountValid(seller.price, seller.discount_price)) {
                this.showTempMessage('Seller discount cannot exceed price', 'error');
                return;
            }

            if (seller.discount_price > 0 && !seller.discount_ends_at) {
                this.showTempMessage('Seller discount requires an end date', 'error');
                return;
            }

            fetch(`/admin/stores/${this.storeId}/items/${this.itemId}/variants/${this.variantId}/seller-price`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    seller_id: seller.id,
                    price: seller.price,
                    discount_price: seller.discount_price,
                    discount_ends_at: seller.discount_ends_at
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    seller.editing = false;
                    seller.saved = true; // ✅ show notification
                    setTimeout(() => seller.saved = false, 3000); // hide after 3s
                } else {
                    this.showTempMessage('Failed to update seller price.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                this.showTempMessage('Failed to update seller price.', 'error');
            });
        },


        deleteCustomer(index) {
    if (!confirm('Delete this customer price?')) return;
    this.customers[index]._delete = true;
    this.customers[index]._deleted_ui = true;
},

saveCustomer(index) {
    let customer = this.customers[index];

    // Validate discount
    if (!this.isDiscountValid(customer.price, customer.discount_price)) {
        this.showTempMessage('Customer discount cannot exceed price', 'error');
        return;
    }

    // Discount end date must exist if discount > 0
    if (customer.discount_price > 0 && !customer.discount_ends_at) {
        this.showTempMessage('Customer discount requires an end date', 'error');
        return;
    }

    // Discount end date must be in the future
    if (customer.discount_ends_at && new Date(customer.discount_ends_at) <= new Date()) {
        this.showTempMessage('Discount end date must be in the future', 'error');
        return;
    }

    fetch(`/admin/stores/${this.storeId}/items/${this.itemId}/variants/${this.variantId}/customer-price`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            customer_id: customer.id,
            price: customer.price,
            discount_price: customer.discount_price,
            discount_ends_at: customer.discount_ends_at
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            customer.editing = false;
            customer.saved = true; // show notification
            setTimeout(() => customer.saved = false, 3000);
        } else {
            this.showTempMessage('Failed to update customer price', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        this.showTempMessage('Failed to update customer price', 'error');
    });
},

    }
}
</script>



</x-app-layout>
