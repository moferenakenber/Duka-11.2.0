<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl p-4 mx-auto" x-data="{ variants: [] }">
        <div class="p-6 shadow-xl bg-base-100 rounded-xl">
            <form action="{{ route('admin.saveDraft') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Info -->
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Name</span>
                        </label>
                        <input type="text" name="product_name" class="w-full input input-bordered" placeholder="Product name">
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text">Base Price</span>
                        </label>
                        <input type="number" step="0.01" name="price" class="w-full input input-bordered" placeholder="Base price">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Product Description</span>
                    </label>
                    <textarea name="product_description" rows="3" class="w-full textarea textarea-bordered" placeholder="Enter description..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Packaging Details</span>
                    </label>
                    <textarea name="packaging_details" rows="2" class="w-full textarea textarea-bordered" placeholder="Box, Bag, etc."></textarea>
                </div>

                <!-- Discounts -->
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                    <div>
                        <label class="label">
                            <span class="label-text">Discount Price</span>
                        </label>
                        <input type="number" step="0.01" name="discount_price" class="w-full input input-bordered">
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text">Discount Percentage</span>
                        </label>
                        <input type="number" step="0.01" name="discount_percentage" class="w-full input input-bordered">
                    </div>
                </div>

                <!-- Images & Category -->
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Images</span>
                        </label>
                        <input type="file" name="product_images[]" multiple class="w-full file-input file-input-bordered">
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text">Main Category</span>
                        </label>
                        <select name="category_id" class="w-full select select-bordered">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select name="status" class="w-full select select-bordered">
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <!-- Variant Section -->
                <div class="p-4 bg-base-200 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Variants</h3>
                        <button type="button" class="btn btn-outline btn-sm" @click="variants.push({})">+ Add Variant</button>
                    </div>

                    <template x-for="(variant, index) in variants" :key="index">
                        <div class="p-4 mb-4 border bg-base-100 rounded-xl border-base-300">
                            <div class="grid items-end grid-cols-1 gap-3 md:grid-cols-6">
                                <div>
                                    <label class="label"><span class="label-text">Color</span></label>
                                    <select :name="'variants['+index+'][item_color_id]'" class="w-full select select-bordered">
                                        <option value="">--</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="label"><span class="label-text">Size</span></label>
                                    <select :name="'variants['+index+'][item_size_id]'" class="w-full select select-bordered">
                                        <option value="">--</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="label"><span class="label-text">Packaging</span></label>
                                    <select :name="'variants['+index+'][item_packaging_type_id]'" class="w-full select select-bordered">
                                        <option value="">--</option>
                                        @foreach ($packagingTypes as $pack)
                                            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="label"><span class="label-text">Stock</span></label>
                                    <input type="number" min="0" :name="'variants['+index+'][stock]'" class="w-full input input-bordered">
                                </div>
                                <div>
                                    <label class="label"><span class="label-text">Price</span></label>
                                    <input type="number" step="0.01" :name="'variants['+index+'][price]'" class="w-full input input-bordered">
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-full">
                                        <label class="label"><span class="label-text">Owner</span></label>
                                        <select :name="'variants['+index+'][owner_id]'" class="w-full select select-bordered">
                                            <option value="">--</option>
                                            @foreach ($sellers as $seller)
                                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="pt-8">
                                        <button type="button" class="btn btn-error btn-sm" @click="variants.splice(index, 1)">✕</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="mt-6 text-end">
                    <button type="submit" class="px-6 btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
