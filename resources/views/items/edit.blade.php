<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Product Name</h2>
            <div class="mb-4">
                <label for="name" class="block text-gray-600">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-600">Product Description</label>
                <textarea rows="5" name="description" placeholder="Enter product description" class="w-full p-2 border border-gray-300 rounded-md mt-1">{{ old('description', $item->description) }}</textarea>
            </div>

            <!-- Category Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Category</h2>
            <div class="mb-4">
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="office" class="form-checkbox text-blue-500"
                            {{ in_array('office', is_array($item->catoption) ? $item->catoption : json_decode($item->catoption, true) ?? []) ? 'checked' : '' }}>
                        <span class="ml-2">Office</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="school" class="form-checkbox text-blue-500"
                            {{ in_array('school', is_array($item->catoption) ? $item->catoption : json_decode($item->catoption, true) ?? []) ? 'checked' : '' }}>
                        <span class="ml-2">School</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="cartoon" class="form-checkbox text-blue-500"
                            {{ in_array('cartoon', is_array($item->catoption) ? $item->catoption : json_decode($item->catoption, true) ?? []) ? 'checked' : '' }}>
                        <span class="ml-2">Kids</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="gift" class="form-checkbox text-blue-500"
                            {{ in_array('gift', is_array($item->catoption) ? $item->catoption : json_decode($item->catoption, true) ?? []) ? 'checked' : '' }}>
                        <span class="ml-2">Gift</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="government" class="form-checkbox text-blue-500"
                            {{ in_array('government', is_array($item->catoption) ? $item->catoption : json_decode($item->catoption, true) ?? []) ? 'checked' : '' }}>
                        <span class="ml-2">Government</span>
                    </label>
                </div>
            </div>

            <!-- Packaging Selling Options Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Packaging Selling Options</h2>
            <div class="mb-4">
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="pieces" class="form-checkbox text-blue-500"
                            {{ in_array('pieces', old('pacoption', json_decode($item->pacoption, true))) ? 'checked' : '' }}>
                        <span class="ml-2">Pieces</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="packet" class="form-checkbox text-blue-500"
                            {{ in_array('packet', old('pacoption', json_decode($item->pacoption, true))) ? 'checked' : '' }}>
                        <span class="ml-2">Packet</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="cartoon" class="form-checkbox text-blue-500"
                            {{ in_array('cartoon', old('pacoption', json_decode($item->pacoption, true))) ? 'checked' : '' }}>
                        <span class="ml-2">Cartoon</span>
                    </label>
                </div>
            </div>

            <!-- Pricing Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Pricing</h2>
            <div class="mb-4">
                <label for="price" class="block text-gray-600">Price</label>
                <input type="number" name="price" value="{{ old('price', $item->price) }}" min="0" class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>

            <!-- Status Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Status</h2>
            <div class="mb-4">
                <label for="status" class="block text-gray-600">Product Status</label>
                <select name="status" class="w-full p-2 border border-gray-300 rounded-md mt-1">
                    <option value="Available" {{ old('status', $item->status) == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Not Available" {{ old('status', $item->status) == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>

            <!-- Stock Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Stock</h2>
            <div class="mb-4">
                <label for="stock" class="block text-gray-600">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $item->stock) }}" min="0" class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>

            <!-- Packaging Standard Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Packaging Standard</h2>
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:gap-4">
                <label for="piecesinapacket" class="sm:w-1/2 text-gray-600">1 Packet Holds</label>
                <input type="number" name="piecesinapacket" value="{{ old('piecesinapacket', $item->piecesinapacket) }}" min="0" max="1000" class="w-full sm:w-1/2 p-2 border border-gray-300 rounded-md mt-1">
                <span class="ml-2 text-gray-600">pieces</span>
            </div>
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:gap-4">
                <label for="packetsinacartoon" class="sm:w-1/2 text-gray-600">1 Carton Holds</label>
                <input type="number" name="packetsinacartoon" value="{{ old('packetsinacartoon', $item->packetsinacartoon) }}" min="0" max="1000" class="w-full sm:w-1/2 p-2 border border-gray-300 rounded-md mt-1">
                <span class="ml-2 text-gray-600">packets</span>
            </div>

            <!-- Upload Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Upload Images</h2>
            <div class="mb-4">
                <label for="formFileMultiple" class="form-label">Upload Multiple Images</label>
                <input class="form-control w-full p-2 border border-gray-300 rounded-md mt-1" type="file" name="images[]" id="formFileMultiple" multiple>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    Update Product
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
