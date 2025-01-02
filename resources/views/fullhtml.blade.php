<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-6 py-10" x-data="{ step: 1 }">
        <!-- Step Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <template x-for="s in [1, 2, 3, 4, 5]" :key="s">
                    <div>
                        <div class="flex items-center">
                            <div :class="step >= s ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'" class="rounded-full h-10 w-10 flex items-center justify-center">
                                <span x-text="s"></span>
                            </div>
                            <div x-show="s !== 5" :class="step >= s ? 'bg-blue-600' : 'bg-gray-300'" class="w-20 h-1 mx-2"></div>
                        </div>
                        <div class="mt-2 text-xs text-center">
                            <template x-if="s === 1">Vital Info</template>
                            <template x-if="s === 2">Packaging</template>
                            <template x-if="s === 3">Variation</template>
                            <template x-if="s === 4">Price Rules</template>
                            <template x-if="s === 5">Images</template>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Step Content -->
        <form id="multiStepForm" @submit.prevent="alert('Form submitted successfully!')">
            <!-- Step 1: Vital Information -->
            <div x-show="step === 1">
                <h2 class="text-lg font-semibold mb-4">Vital Information</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter product name">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3" placeholder="Write product description here..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                        <option value="in_stock">In Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
            </div>

            <!-- Step 2: Packaging Information -->
            <div x-show="step === 2">
                <h2 class="text-lg font-semibold mb-4">Packaging Information</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Package A</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Package name e.g., Packet, Doz...">
                    <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Holds amount">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Package B</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Package name e.g., Carton, Doz...">
                    <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Holds amount">
                </div>
            </div>

            <!-- Step 3: Variation -->
            <div x-show="step === 3">
                <h2 class="text-lg font-semibold mb-4">Variation</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Colors</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label><input type="checkbox" class="mr-2"> Black</label>
                        </div>
                        <div>
                            <label><input type="checkbox" class="mr-2"> White</label>
                        </div>
                        <!-- Add more colors as needed -->
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Sizes</label>
                    <div>
                        <label><input type="checkbox" class="mr-2"> Small</label>
                        <label><input type="checkbox" class="mr-2"> Medium</label>
                        <label><input type="checkbox" class="mr-2"> Large</label>
                    </div>
                </div>
            </div>

            <!-- Step 4: Price Rules -->
            <div x-show="step === 4">
                <h2 class="text-lg font-semibold mb-4">Price Rules</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Standard Price</label>
                    <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter price">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Price for Customer</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <!-- Customer options go here -->
                    </select>
                </div>
            </div>

            <!-- Step 5: Images -->
            <div x-show="step === 5">
                <h2 class="text-lg font-semibold mb-4">Images</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Upload Images</label>
                    <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="mt-8 flex justify-between">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" x-show="step > 1" @click="step--">Previous</button>
                <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded" x-show="step < 5" @click="step++">Next</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded" x-show="step === 5">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js" defer></script>
</body>
</html>
