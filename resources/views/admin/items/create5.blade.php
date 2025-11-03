<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Create Item') }}
    </h2>
  </x-slot>

  <div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-6 text-2xl font-bold">Create Draft Item</h2>

    <form method="POST" action="{{ route('admin.saveDraft') }}" enctype="multipart/form-data">
      @csrf

      <!-- Product Name -->
      <div class="mb-4">
        <label for="product_name" class="block font-semibold">Product Name *</label>
        <input
          type="text"
          name="product_name"
          id="product_name"
          class="w-full px-3 py-2 border border-gray-300 rounded"
          required
        />
      </div>

      <!-- Product Description -->
      <div class="mb-4">
        <label for="product_description" class="block font-semibold">Product Description</label>
        <textarea
          name="product_description"
          id="product_description"
          rows="3"
          class="w-full px-3 py-2 border border-gray-300 rounded"
        ></textarea>
      </div>

      <!-- Packaging Details -->
      <div class="mb-4">
        <label for="packaging_details" class="block font-semibold">Packaging Details</label>
        <textarea
          name="packaging_details"
          id="packaging_details"
          rows="2"
          class="w-full px-3 py-2 border border-gray-300 rounded"
        ></textarea>
      </div>

      <!-- Variation -->
      <div class="mb-4">
        <label for="variation" class="block font-semibold">Variation</label>
        <input type="text" name="variation" id="variation" class="w-full px-3 py-2 border border-gray-300 rounded" />
      </div>

      <!-- Price -->
      <div class="mb-4">
        <label for="price" class="block font-semibold">Price</label>
        <input
          type="number"
          name="price"
          step="0.01"
          id="price"
          class="w-full px-3 py-2 border border-gray-300 rounded"
        />
      </div>

      <!-- Product Images -->
      <div class="mb-4">
        <label for="product_images" class="block font-semibold">Product Images (you can select multiple)</label>
        <input
          type="file"
          name="product_images[]"
          multiple
          accept="image/*"
          class="w-full px-3 py-2 border border-gray-300 rounded"
        />
      </div>

      <!-- Selected Categories (JSON) -->
      <div class="mb-4">
        <label for="selectedCategories" class="block font-semibold">Selected Categories (JSON)</label>
        <input
          type="text"
          name="selectedCategories"
          id="selectedCategories"
          class="w-full px-3 py-2 border border-gray-300 rounded"
          placeholder='["1","2"]'
        />
      </div>

      <!-- New Category Names (JSON) -->
      <div class="mb-4">
        <label for="newCategoryNames" class="block font-semibold">New Category Names (JSON)</label>
        <input
          type="text"
          name="newCategoryNames"
          id="newCategoryNames"
          class="w-full px-3 py-2 border border-gray-300 rounded"
          placeholder='["Notebooks","Pencils"]'
        />
      </div>

      <hr class="my-6" />

      <h3 class="mb-4 text-xl font-semibold">Variant Details</h3>

      <!-- Color -->
      <div class="mb-4">
        <label for="item_color_id" class="block font-semibold">Color</label>
        <select name="item_color_id" id="item_color_id" class="w-full px-3 py-2 border border-gray-300 rounded">
          <option value="">-- Select Color --</option>
          @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Size -->
      <div class="mb-4">
        <label for="item_size_id" class="block font-semibold">Size</label>
        <select name="item_size_id" id="item_size_id" class="w-full px-3 py-2 border border-gray-300 rounded">
          <option value="">-- Select Size --</option>
          @foreach ($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Packaging Type -->
      <div class="mb-4">
        <label for="item_packaging_type_id" class="block font-semibold">Packaging Type</label>
        <select
          name="item_packaging_type_id"
          id="item_packaging_type_id"
          class="w-full px-3 py-2 border border-gray-300 rounded"
        >
          <option value="">-- Select Packaging --</option>
          @foreach ($packagings as $pack)
            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Variant Price -->
      <div class="mb-4">
        <label for="variant_price" class="block font-semibold">Variant Price</label>
        <input
          type="number"
          name="variant_price"
          id="variant_price"
          class="w-full px-3 py-2 border border-gray-300 rounded"
          required
        />
      </div>

      <!-- Stock -->
      <div class="mb-4">
        <label for="variant_stock" class="block font-semibold">Stock Quantity</label>
        <input
          type="number"
          name="variant_stock"
          id="variant_stock"
          class="w-full px-3 py-2 border border-gray-300 rounded"
          required
        />
      </div>

      <!-- Is Active -->
      <div class="mb-4">
        <label class="inline-flex items-center">
          <input type="checkbox" name="is_active" value="1" checked class="mr-2" />
          <span>Active Variant</span>
        </label>
      </div>

      <!-- Submit Button -->
      <div class="mt-6">
        <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700">
          Save as Draft
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
