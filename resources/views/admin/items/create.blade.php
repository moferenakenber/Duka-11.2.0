<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div x-data="packagingManager()" class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen overflow-y-auto">

            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <h3 class="font-semibold">There were some problems with your input:</h3>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                            <input type="text" id="product_name" name="product_name"
                            value="{{ old('product_name') }}"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                placeholder="Enter product name" required>
                        </div>
                        <div>
                            <label for="product_description" class="block text-sm font-semibold">Product
                                Description</label>
                            <textarea id="product_description" name="product_description" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                placeholder="Write product description here..." required>{{ old('product_description') }}</textarea>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold">Status</label>
                            <select id="status" name="status"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="in_stock" {{ old('status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </div>
                    </div>























                    <div x-show="step === 2" x-data="packagingManager()" class="space-y-4">
                        <!-- Step Title -->
                        <h3 class="text-lg font-semibold">Define Packaging Layers</h3>

                        <!-- Default -->
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Default</span>


                        <!-- Packaging Rows -->
                        <template x-for="(layer, index) in layers" :key="index">
                            <div class="flex items-center gap-4">
                                <!-- Packaging Type -->
                                <div class="flex w-1/3">

                                    <label :for="'package_' + index" class="block text-sm font-semibold pr-2">Packaging
                                        Type</label>

                                    <template x-if="index === 0">
                                        <!-- First row: Fixed to "Piece" -->
                                        <select :id="'package_' + index"
                                            class="mt-2 p-2 border border-gray-300 rounded-md w-full bg-gray-100 cursor-not-allowed"
                                            disabled>
                                            <option value="Piece">Piece</option>
                                        </select>
                                    </template>
                                    <template x-if="index > 0">
                                        <!-- Subsequent rows: Dynamic options -->
                                        <select :id="'package_' + index" x-model="layer.type"
                                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                                            <option value="" disabled selected>Select Type</option>
                                            <template x-for="option in getAvailableOptions(index)"
                                                :key="option">
                                                <option :value="option" x-text="option"></option>
                                            </template>
                                        </select>
                                    </template>
                                </div>

                                <!-- Holds Input -->
                                <template x-if="index > 0">
                                    <div class="flex w-1/4">
                                        <label :for="'holds_' + index"
                                            class="block text-sm font-semibold pr-2">Holds</label>
                                        <input type="number" :id="'holds_' + index" x-model="layer.holds"
                                            class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                            placeholder="Enter amount" required>
                                    </div>
                                </template>

                                <!-- Additional Packaging -->
                                <template x-if="index > 0">
                                    <div class="flex w-1/3">
                                        <label :for="'additional_' + index" class="block text-sm font-semibold pr-2">
                                            Additional Packaging
                                        </label>
                                        <select :id="'additional_' + index" x-model="layer.additional"
                                            class="mt-2 p-2 border border-gray-300 rounded-md w-full bg-gray-100 cursor-not-allowed"
                                            disabled>
                                            <option :value="layers[index - 1]?.type" x-text="layers[index - 1]?.type">
                                            </option>
                                        </select>
                                        <!-- Bottom Label for the Dropdown -->
                                        <template x-if="index > 0">
                                            <div class="text-sm text-gray-500 mt-2 pl-2">
                                                <p>Total: <span
                                                        x-text="(layers[index-1]?.holds * layer.holds) || 0"></span>
                                                    pieces</p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- Add Packaging Button -->
                        <button @click="addLayer" :disabled="layers.length >= 5"
                            class="mt-4 p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                            Add Packaging
                        </button>
                    </div>




                    <script>
                        function packagingManager() {
                            return {
                                layers: [{
                                    type: 'Piece', // First layer is fixed to "Piece"
                                    holds: 1, // Default value for holds in the first layer
                                    additional: null, // No additional packaging for the first row
                                }, ],
                                options: ['Doz', 'Packet', 'Bundle', 'Bag', 'Container', 'Wrapper', 'Case', 'Crate', 'Bottle', 'Carton'],
                                // Get available options excluding already selected types
                                getAvailableOptions(index) {
                                    const selectedTypes = this.layers.map((layer) => layer.type).filter(Boolean);
                                    return this.options.filter((option) => !selectedTypes.includes(option) || option === this.layers[index]
                                        ?.type);
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

                            <div class="flex items-center space-x-4">

                                <div class="flex items-center">
                                    <input id="white-checkbox" type="checkbox" name="colors[]" value="white"
                                        class="w-4 h-4 text-white bg-gray-100 border-gray-300 rounded focus:ring-white-500 dark:focus:ring-white-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="white-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">White</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="black-checkbox" type="checkbox" name="colors[]" value="black"
                                        class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black-500 dark:focus:ring-black-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="black-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Black</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="red-checkbox" type="checkbox" name="colors[]" value="red"
                                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Red</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="blue-checkbox" type="checkbox" name="colors[]" value="blue"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="blue-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Blue</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="green-checkbox" type="checkbox" name="colors[]" value="green"
                                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="green-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Green</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="purple-checkbox" type="checkbox" name="colors[]" value="purple"
                                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="purple-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Purple</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="teal-checkbox" type="checkbox" name="colors[]" value="teal"
                                        class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="teal-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Teal</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="yellow-checkbox" type="checkbox" name="colors[]" value="yellow"
                                        class="w-4 h-4 text-yellow-400 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="yellow-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yellow</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="orange-checkbox" type="checkbox" name="colors[]" value="orange"
                                        class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="orange-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Orange</label>
                                </div>
                            </div>

                        </div>




                        <div class="space-y-2">
                            <p class="text-sm font-semibold">Size</p>
                            <div class="space-x-4">
                                <label>
                                    <input type="checkbox" name="sizes[]" value="extraSmall" class="mr-2"
                                           {{ in_array('extraSmall', old('sizes', [])) ? 'checked' : '' }}>
                                    Extra Small
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="small" class="mr-2"
                                           {{ in_array('small', old('sizes', [])) ? 'checked' : '' }}>
                                    Small
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="medium" class="mr-2"
                                           {{ in_array('medium', old('sizes', [])) ? 'checked' : '' }}>
                                    Medium
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="large" class="mr-2"
                                           {{ in_array('large', old('sizes', [])) ? 'checked' : '' }}>
                                    Large
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="extraLarge" class="mr-2"
                                           {{ in_array('extraLarge', old('sizes', [])) ? 'checked' : '' }}>
                                    Extra Large
                                </label>
                            </div>
                        </div>

                    </div>
















                    <!-- Step 4: Price Rules -->
                    <div x-show="step === 4" class="space-y-4">
                        <!-- Price for piece -->
                        <!-- Price per Piece Input (Always Displayed) -->
                        <div class="flex w-1/3">
                            <label :for="'customer_price_' + index" class="block text-sm font-semibold pr-2">Price per
                                Piece</label>
                            <input type="number" :id="'customer_price_' + index" x-model="layer.price"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                placeholder="Enter price for customer" required>
                            <p class="text-xs text-gray-900 dark:text-white">Price for people who buy pieces</p>
                        </div>

                        <!-- Holds Input (Only for layers after the first one) -->
                        <template x-if="layer.type !== 'Piece'">
                            <div class="flex w-1/4">
                                <label :for="'holds_' + index" class="block text-sm font-semibold pr-2">Holds</label>
                                <input type="number" :id="'holds_' + index" x-model="layer.holds"
                                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                    placeholder="Enter amount" required>
                            </div>
                        </template>
                    </div>

                    <!-- Step 5: Images -->
                    <div x-show="step === 5" class="space-y-4">
                        <div>
                            <label for="image_a" class="block text-sm font-semibold">Package A Image</label>
                            <input type="file" id="image_a" name="image_a"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label for="image_b" class="block text-sm font-semibold">Package B Image</label>
                            <input type="file" id="image_b" name="image_b"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label for="image_c" class="block text-sm font-semibold">Package C Image</label>
                            <input type="file" id="image_c" name="image_c"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
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
                        <button x-show="step === totalSteps" type="submit"
                            class="bg-green-500 text-white py-2 px-4 rounded-md">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
