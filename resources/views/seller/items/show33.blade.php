{{-- Assume $item is passed with variants and each variant has itemColor with name, image_path, price, disabled --}}
@extends('seller.layouts.app')

@section('content')
  <div
    class="max-w-md mx-auto p-4"
    x-data="variantSelector(
              {{
                $item->variants
                  ->map(
                    fn ($v) => [
                      'name' => $v->itemColor->name,
                      'img' => asset($v->itemColor->image_path),
                      'price' => $v->price,
                      'disabled' => $v->itemColor->disabled,
                    ],
                  )
                  ->toJson()
              }},
            )"
    x-init="init()"
  >
    <h1 class="text-xl font-bold mb-4">{{ $item->name }}</h1>

    <!-- Color Selector -->
    <div class="mb-6">
      <div class="font-semibold text-sm mb-2">COLOR</div>
      <div class="flex flex-wrap gap-2">
        <template x-for="(color, index) in colors" :key="index">
          <button
            type="button"
            @click="!color.disabled && selectColor(color)"
            class="flex flex-col items-center border rounded-md px-2 py-1 w-20 text-xs"
            :class="{
                            'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color.disabled,
                            'border-black bg-black text-white': selectedColor && selectedColor.name === color.name && !color.disabled
                        }"
          >
            <img :src="color.img" class="w-10 h-10 object-cover rounded mb-1" alt="" />
            <span x-text="color.name"></span>
          </button>
        </template>
      </div>
    </div>

    <!-- Image Preview -->
    <div class="mb-4">
      <img
        :src="selectedColor ? selectedColor.img : '/img/product.jpg'"
        alt="Selected Color Image"
        class="w-64 h-64 rounded border object-cover mx-auto"
      />
    </div>

    <!-- Price -->
    <div class="text-lg font-semibold mb-4" x-text="formattedPrice ? `Price: $${formattedPrice}` : ''"></div>

    <!-- Add to Cart Button -->
    <button
      class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      @click="alert(`Added ${selectedColor.name} variant to cart! Price: $${formattedPrice}`)"
    >
      Add to Cart
    </button>
  </div>

  <script>
    function variantSelector(colors) {
      return {
        colors: colors,
        selectedColor: null,
        selectedPrice: null,

        init() {
          // Select first enabled color on init
          this.selectedColor = this.colors.find((c) => !c.disabled) || null;
          this.selectedPrice = this.selectedColor ? this.selectedColor.price : null;
        },

        selectColor(color) {
          this.selectedColor = color;
          this.selectedPrice = color.price;
        },

        get formattedPrice() {
          return this.selectedPrice !== null ? this.selectedPrice.toFixed(2) : null;
        },
      };
    }
  </script>
@endsection
