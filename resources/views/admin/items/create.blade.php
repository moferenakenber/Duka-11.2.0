<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen overflow-y-auto">
        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div x-data="{
                step: 1,
                totalSteps: 5,
                progress() {
                    return (this.step / this.totalSteps) * 100;
                }
            }" class="max-w-4xl mx-auto p-4 relative min-h-screen overflow-y-auto">

                <!-- Step Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-sm">Step <span x-text="step"></span> of 5</span>
                        <span class="font-semibold text-sm" x-text="Math.round(progress()) + '%'"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" :style="'width: ' + progress() + '%'"></div>
                    </div>
                </div>

              <!-- Tabs for the Form -->
                <div class="mb-6">
                    <ul x-ref="tabs" class="flex space-x-4 overflow-x-auto sm:overflow-visible">
                        <li @click="step = 1; $nextTick(() => $refs.tabs.children[0].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            :class="{ 'bg-blue-500 text-white': step === 1 }"
                            class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Vital Information</li>
                        <li @click="step = 2; $nextTick(() => $refs.tabs.children[1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            :class="{ 'bg-blue-500 text-white': step === 2 }"
                            class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Packaging Information</li>
                        <li @click="step = 3; $nextTick(() => $refs.tabs.children[2].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            :class="{ 'bg-blue-500 text-white': step === 3 }"
                            class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Variation</li>
                        <li @click="step = 4; $nextTick(() => $refs.tabs.children[3].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            :class="{ 'bg-blue-500 text-white': step === 4 }"
                            class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Price Rules</li>
                        <li @click="step = 5; $nextTick(() => $refs.tabs.children[4].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            :class="{ 'bg-blue-500 text-white': step === 5 }"
                            class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Images</li>
                    </ul>
                </div>



                <!-- Step 1: Vital Information -->
                <div x-show="step === 1" class="space-y-4">
                    <div>
                        <label for="product_name" class="block text-sm font-semibold">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                            placeholder="Enter product name" required>
                    </div>
                    <div>
                        <label for="product_description" class="block text-sm font-semibold">Product Description</label>
                        <textarea id="product_description" name="product_description" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                            placeholder="Write product description here..." required></textarea>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-semibold">Status</label>
                        <select id="status" name="status" class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                            <option value="in_stock">In Stock</option>
                            <option value="out_of_stock">Out of Stock</option>
                        </select>
                    </div>
                </div>























                <div x-show="step === 2" x-data="packagingManager()" class="space-y-4">
                    <!-- Step Title -->
                    <h3 class="text-lg font-semibold">Define Packaging Layers</h3>

                    <!-- Packaging Rows -->
                    <template x-for="(layer, index) in layers" :key="index">
                        <div class="flex items-center gap-4">
                            <!-- Packaging Type -->
                            <div class="flex w-1/3">
                                <label :for="'package_' + index" class="block text-sm font-semibold pr-2">Packaging Type</label>
                                <template x-if="index === 0">
                                    <!-- First row: Fixed to "Piece" -->
                                    <select
                                        :id="'package_' + index"
                                        class="mt-2 p-2 border border-gray-300 rounded-md w-full bg-gray-100 cursor-not-allowed"
                                        disabled
                                    >
                                        <option value="Piece">Piece</option>
                                    </select>
                                </template>
                                <template x-if="index > 0">
                                    <!-- Subsequent rows: Dynamic options -->
                                    <select
                                        :id="'package_' + index"
                                        x-model="layer.type"
                                        class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                        required
                                    >
                                        <option value="" disabled selected>Select Type</option>
                                        <template x-for="option in getAvailableOptions(index)" :key="option">
                                            <option :value="option" x-text="option"></option>
                                        </template>
                                    </select>
                                </template>
                            </div>

                            <!-- Holds Input -->
                            <template x-if="index > 0">
                                <div class="flex w-1/4">
                                    <label :for="'holds_' + index" class="block text-sm font-semibold pr-2">Holds</label>
                                    <input
                                        type="number"
                                        :id="'holds_' + index"
                                        x-model="layer.holds"
                                        class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                        placeholder="Enter amount"
                                        required
                                    >
                                </div>
                            </template>

                            <!-- Additional Packaging -->
                            <template x-if="index > 0">
                                <div class="flex w-1/3">
                                    <label :for="'additional_' + index" class="block text-sm font-semibold pr-2">
                                        Additional Packaging
                                    </label>
                                    <select
                                        :id="'additional_' + index"
                                        x-model="layer.additional"
                                        class="mt-2 p-2 border border-gray-300 rounded-md w-full bg-gray-100 cursor-not-allowed"
                                        disabled
                                    >
                                        <option :value="layers[index - 1]?.type" x-text="layers[index - 1]?.type"></option>
                                    </select>
                                    <!-- Bottom Label for the Dropdown -->
                                    <template x-if="index > 0">
                                        <div class="text-sm text-gray-500 mt-2 pl-2">
                                            <p>Total: <span x-text="(layers[index-1]?.holds * layer.holds) || 0"></span> pieces</p>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Add Packaging Button -->
                    <button
                        @click="addLayer"
                        :disabled="layers.length >= 5"
                        class="mt-4 p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50"
                    >
                        Add Packaging
                    </button>
                </div>




<script>

function packagingManager() {
    return {
        layers: [
            {
                type: 'Piece', // First layer is fixed to "Piece"
                holds: 1, // Default value for holds in the first layer
                additional: null, // No additional packaging for the first row
            },
        ],
        options: ['Doz', 'Packet', 'Bundle', 'Bag', 'Container', 'Wrapper', 'Case', 'Crate', 'Bottle', 'Carton'],
        // Get available options excluding already selected types
        getAvailableOptions(index) {
            const selectedTypes = this.layers.map((layer) => layer.type).filter(Boolean);
            return this.options.filter((option) => !selectedTypes.includes(option) || option === this.layers[index]?.type);
        },
        // Add a new layer
        addLayer() {
            const previousType = this.layers[this.layers.length - 1].type;
            this.layers.push({
                type: '', // User selects packaging type
                holds: null, // Default value for holds
                additional: previousType, // Additional packaging defaults to previous layer's type
            });
        },
        // Remove a layer
        removeLayer(index) {
            this.layers.splice(index, 1);
        },
    };
}

</script>
















                <!-- Step 3: Variation -->
                <div x-show="step === 3" class="space-y-4">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold">Colors</p>
                        <div class="space-x-4">
                            <label><input type="checkbox" name="colors[]" value="Black" class="mr-2"> Black</label>
                            <label><input type="checkbox" name="colors[]" value="White" class="mr-2"> White</label>
                            <label><input type="checkbox" name="colors[]" value="Red" class="mr-2"> Red</label>
                            <label><input type="checkbox" name="colors[]" value="Blue" class="mr-2"> Blue</label>
                            <label><input type="checkbox" name="colors[]" value="Yellow" class="mr-2"> Yellow</label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <p class="text-sm font-semibold">Size</p>
                        <div class="space-x-4">
                            <label><input type="checkbox" name="sizes[]" value="Small" class="mr-2"> Small</label>
                            <label><input type="checkbox" name="sizes[]" value="Medium" class="mr-2"> Medium</label>
                            <label><input type="checkbox" name="sizes[]" value="Large" class="mr-2"> Large</label>
                            <label><input type="checkbox" name="sizes[]" value="Extra Large" class="mr-2"> Extra Large</label>
                        </div>
                    </div>
                </div>
















<!-- Step 4: Price Rules -->
<div x-show="step === 4" class="space-y-4">
    <!-- Packaging Types Checkboxes -->
    <div>
        <p class="text-sm font-semibold">Select Packaging Types and Add Price</p>
        <template x-for="(layer, index) in layers" :key="index">
            <div class="flex items-center space-x-2">
                <input type="checkbox" :id="'package_price_' + index" name="packaging_prices[]" :value="layer.type" class="mr-2">
                <label :for="'package_price_' + index" class="text-sm font-semibold">
                    <span x-text="layer.type"></span>
                </label>
                <input type="number" x-show="document.getElementById('package_price_' + index).checked" :name="'price_' + layer.type" placeholder="Enter price" class="mt-2 p-2 border border-gray-300 rounded-md w-1/4" />
            </div>
        </template>
    </div>

    <!-- Colors Checkboxes -->
    <div>
        <p class="text-sm font-semibold">Select Colors and Add Price</p>
        <template x-for="(color, index) in ['Black', 'White', 'Red', 'Blue', 'Yellow']" :key="index">
            <div class="flex items-center space-x-2">
                <input type="checkbox" :id="'color_price_' + index" name="color_prices[]" :value="color" class="mr-2">
                <label :for="'color_price_' + index" class="text-sm font-semibold">
                    <span x-text="color"></span>
                </label>
                <input type="number" x-show="document.getElementById('color_price_' + index).checked" :name="'price_' + color" placeholder="Enter price" class="mt-2 p-2 border border-gray-300 rounded-md w-1/4" />
            </div>
        </template>
    </div>

    <!-- Sizes Checkboxes -->
    <div>
        <p class="text-sm font-semibold">Select Sizes and Add Price</p>
        <template x-for="(size, index) in ['Small', 'Medium', 'Large', 'Extra Large']" :key="index">
            <div class="flex items-center space-x-2">
                <input type="checkbox" :id="'size_price_' + index" name="size_prices[]" :value="size" class="mr-2">
                <label :for="'size_price_' + index" class="text-sm font-semibold">
                    <span x-text="size"></span>
                </label>
                <input type="number" x-show="document.getElementById('size_price_' + index).checked" :name="'price_' + size" placeholder="Enter price" class="mt-2 p-2 border border-gray-300 rounded-md w-1/4" />
            </div>
        </template>
    </div>
</div>

<!-- Step 5: Images -->
<div x-show="step === 5" class="space-y-4">
    <template x-for="(layer, index) in layers" :key="index">
        <div>
            <label :for="'image_' + layer.type" class="block text-sm font-semibold">
                <span x-text="layer.type"></span> Image
            </label>
            <input type="file" :id="'image_' + layer.type" :name="'image_' + layer.type" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
        </div>
    </template>

    <!-- Colors Images -->
    <template x-for="(color, index) in ['Black', 'White', 'Red', 'Blue', 'Yellow']" :key="index">
        <div>
            <label :for="'image_' + color" class="block text-sm font-semibold">
                <span x-text="color"></span> Image
            </label>
            <input type="file" :id="'image_' + color" :name="'image_' + color" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
        </div>
    </template>

    <!-- Sizes Images -->
    <template x-for="(size, index) in ['Small', 'Medium', 'Large', 'Extra Large']" :key="index">
        <div>
            <label :for="'image_' + size" class="block text-sm font-semibold">
                <span x-text="size"></span> Image
            </label>
            <input type="file" :id="'image_' + size" :name="'image_' + size" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
        </div>
    </template>
</div>



















                <!-- Add scrolling behavior to Step switch -->
                <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between">
                    <!-- Previous Button -->
                    <button x-show="step > 1"
                        @click.prevent="step--; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md">
                        Previous
                    </button>

                    <!-- Next Button (positioned on the right for step 1 and onwards) -->
                    <button x-show="step < totalSteps"
                        @click.prevent="step++; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md ml-auto">
                        Next
                    </button>

                    <!-- Submit Button -->
                    <button x-show="step === totalSteps"
                        type="submit"
                        class="bg-green-500 text-white py-2 px-4 rounded-md">
                        Submit
                    </button>
                </div>

        </form>
    </div>
</div>
</x-app-layout>
