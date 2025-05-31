<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <script>
        const categories = @json($categories);
    </script>

    <div class="py-12">
        <form action="{{ route('admin.saveDraft') }}" method="POST" enctype="multipart/form-data" x-data="{ packagings: [], colors: [''], variants: [] }" class="max-w-4xl p-6 mx-auto space-y-6 bg-white rounded-lg shadow">
            @csrf

            <!-- Product Name -->
            <div>
                <label class="block mb-1 font-medium">Product Name</label>
                <input type="text" name="product_name" class="w-full input input-bordered" placeholder="e.g. 3 subject">
            </div>

            <!-- Product Images -->
            <div>
                <label class="block mb-1 font-medium">Product Images</label>
                <input type="file" multiple class="w-full file-input file-input-bordered" />
            </div>

            <!-- Product Description -->
            <div>
                <label class="block mb-1 font-medium">Product Description</label>
                <textarea class="w-full textarea textarea-bordered" placeholder="Enter product description..."></textarea>
            </div>

            <!-- Variation -->
            <div>
                <label class="block mb-1 font-medium">Variation</label>
                <input type="text" class="w-full input input-bordered" placeholder="e.g. aut">
            </div>

            <!-- Price -->
            <div>
                <label class="block mb-1 font-medium">Price</label>
                <input type="number" step="0.01" class="w-full input input-bordered" placeholder="e.g. 120.69">
            </div>

            <!-- Packaging Details -->
            <div>
                <label class="block mb-2 font-medium">Packaging Details</label>
                <template x-for="(pack, index) in packagings" :key="index">
                    <div class="flex mb-2 space-x-2">
                        <input type="text" x-model="pack.name" class="w-1/2 input input-sm input-bordered"
                            placeholder="Name (e.g. Doz)">
                        <input type="number" x-model="pack.quantity" class="w-1/2 input input-sm input-bordered"
                            placeholder="Quantity">
                    </div>
                </template>
                <button type="button" class="btn btn-sm btn-outline"
                    @click="packagings.push({ name: '', quantity: 1 })">+ Add Packaging</button>
            </div>

            <!-- Colors -->
            <div>
                <label class="block mb-2 font-medium">Colors</label>
                <template x-for="(color, index) in colors" :key="index">
                    <div class="flex items-center mb-2 space-x-2">
                        <input type="text" x-model="colors[index]" class="w-full input input-sm input-bordered"
                            placeholder="Color name">
                        <button @click="colors.splice(index, 1)"
                            class="btn btn-sm btn-error btn-outline">Remove</button>
                    </div>
                </template>
                <button type="button" class="btn btn-sm btn-outline" @click="colors.push('')">+ Add Color</button>
            </div>

            <!-- Variant Table -->
            <div>
                <label class="block mb-2 font-medium">Variants</label>
                <table class="table w-full table-zebra">
                    <thead>
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Packaging</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(variant, index) in variants" :key="index">
                            <tr>
                                <td><input x-model="variant.color" class="w-full input input-sm input-bordered" /></td>
                                <td><input x-model="variant.size" class="w-full input input-sm input-bordered" /></td>
                                <td><input x-model="variant.packaging" class="w-full input input-sm input-bordered" />
                                </td>
                                <td><input x-model="variant.price" type="number"
                                        class="w-full input input-sm input-bordered" /></td>
                                <td><input x-model="variant.stock" type="number"
                                        class="w-full input input-sm input-bordered" /></td>
                                <td><input x-model="variant.owner" class="w-full input input-sm input-bordered" /></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <button type="button" class="mt-2 btn btn-sm btn-outline"
                    @click="variants.push({ color: '', size: '', packaging: '', price: '', stock: '', owner: '' })">
                    + Add Variant
                </button>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>


</x-app-layout>
