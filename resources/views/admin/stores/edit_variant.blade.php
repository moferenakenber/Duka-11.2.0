<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Store - {{ $store->name }}
        </h2>
    </x-slot>

    <div class="p-4 mb-6 rounded-xl bg-base-200"
         x-data="storeForm({{ json_encode([$storeData]) }})">

        <form method="POST" action="{{ route('admin.stores.update', $store->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <template x-for="(store, index) in stores" :key="index">
                <div class="w-full p-5 mb-6 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-3xl">

                    {{-- Basic Info --}}
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Store Name</label>
                            <input type="text" x-model="store.name" :name="`stores[${index}][name]`"
                                   class="w-full input input-sm input-bordered" placeholder="Store Name">
                        </div>

                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Location</label>
                            <input type="text" x-model="store.location" :name="`stores[${index}][location]`"
                                   class="w-full input input-sm input-bordered" placeholder="Location">
                        </div>

                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-600">Status</label>
                            <select x-model="store.status" :name="`stores[${index}][status]`"
                                    class="w-full input input-sm input-bordered">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    {{-- Store Prices / Stock --}}
                    <div class="mt-4">
                        <h3 class="text-sm font-semibold text-gray-700">Store Prices</h3>

                        <template x-for="(sp, spIndex) in store.store_prices" :key="spIndex">
                            <div class="grid grid-cols-1 gap-2 p-2 mt-2 border rounded-lg bg-gray-50 md:grid-cols-6">

                                {{-- Item --}}
                                <div>
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Item</label>
                                    <select x-model="sp.item_id"
                                            :name="`stores[${index}][store_prices][${spIndex}][item_id]`"
                                            class="w-full input input-sm input-bordered">
                                        <option value="">Select Item</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Price --}}
                                <div>
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Price</label>
                                    <input type="number" x-model="sp.price"
                                           :name="`stores[${index}][store_prices][${spIndex}][price]`"
                                           class="w-full input input-sm input-bordered" placeholder="Price">
                                </div>

                                {{-- Discount --}}
                                <div>
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Price</label>
                                    <input type="number" x-model="sp.discount_price"
                                           :name="`stores[${index}][store_prices][${spIndex}][discount_price]`"
                                           class="w-full input input-sm input-bordered" placeholder="Discount Price">
                                </div>

                                <div>
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Discount Ends</label>
                                    <input type="datetime-local" x-model="sp.discount_ends_at"
                                           :name="`stores[${index}][store_prices][${spIndex}][discount_ends_at]`"
                                           class="w-full input input-sm input-bordered">
                                </div>

                                {{-- Stock --}}
                                <div>
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Stock</label>
                                    <input type="number" x-model="sp.stock"
                                           :name="`stores[${index}][store_prices][${spIndex}][stock]`"
                                           class="w-full input input-sm input-bordered" placeholder="Stock">
                                </div>

                                {{-- Remove --}}
                                <div class="flex items-end">
                                    <button type="button" class="w-full btn btn-error btn-sm"
                                            @click="store.store_prices.splice(spIndex, 1)">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </template>

                        <button type="button" class="mt-2 btn btn-outline btn-sm" @click="addStorePrice(index)">
                            + Add Store Price
                        </button>
                    </div>
                </div>
            </template>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Store</button>
            </div>
        </form>
    </div>

    <script>
        function storeForm(initialStores = []) {
            return {
                stores: initialStores,
                addStorePrice(index) {
                    this.stores[index].store_prices.push({
                        item_id: '',
                        price: 0,
                        discount_price: null,
                        discount_ends_at: null,
                        stock: 0
                    });
                }
            }
        }
    </script>
</x-app-layout>
