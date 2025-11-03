<!-- resources/views/components/product-modal.blade.php -->

<div
  x-data="productModal()"
  x-show="showModal"
  x-cloak
  class="fixed inset-0 z-50 bg-black/40 flex justify-center items-end md:items-center px-4"
>
  <div class="bg-white w-full max-w-md rounded-t-xl md:rounded-xl p-4" @click.away="showModal = false">
    <!-- Product Preview -->
    <div class="flex items-center gap-4 mb-4">
      <img :src="item.image || '/img/product.jpg'" alt="Product" class="w-20 h-20 rounded border object-cover" />
      <div>
        <div class="text-lg font-semibold text-red-500">
          ฿
          <span x-text="item.price"></span>
        </div>
        <div class="text-sm text-gray-500">
          Stock:
          <span x-text="item.stock"></span>
        </div>
      </div>
    </div>

    <!-- Color Selection -->
    <div class="mb-4">
      <div class="font-semibold text-sm mb-2">COLOR</div>
      <div class="flex flex-wrap gap-2">
        <template x-for="(color, index) in item.colors" :key="index">
          <button
            type="button"
            @click="!color.disabled && (selectedColor = color.name)"
            class="flex flex-col items-center border rounded-md px-2 py-1 w-20 text-xs"
            :class="{
                            'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color.disabled,
                            'border-black bg-black text-white': selectedColor === color.name && !color.disabled
                        }"
          >
            <img :src="color.img" class="w-10 h-10 object-cover rounded mb-1" alt="" />
            <span x-text="color.name"></span>
          </button>
        </template>
      </div>
    </div>

    <!-- Size Selection -->
    <div class="mb-4">
      <div class="font-semibold text-sm mb-2">SIZE</div>
      <div class="grid grid-cols-2 gap-2">
        <template x-for="(size, index) in item.sizes" :key="index">
          <button
            type="button"
            @click="!size.disabled && (selectedSize = size.value)"
            class="border rounded-md px-3 py-2 text-xs text-left"
            :class="{
                            'bg-gray-100 text-gray-400 cursor-not-allowed': size.disabled,
                            'bg-black text-white': selectedSize === size.value && !size.disabled
                        }"
            x-text="size.label"
          ></button>
        </template>
      </div>
    </div>

    <!-- Quantity Control -->
    <div class="mb-6">
      <div class="font-semibold text-sm mb-2">Quantity</div>
      <div class="flex items-center border w-max px-2 rounded">
        <button type="button" class="text-lg px-2" @click="quantity = Math.max(1, quantity - 1)">–</button>
        <input type="number" x-model="quantity" min="1" class="w-12 text-center border-x outline-none" />
        <button type="button" class="text-lg px-2" @click="quantity++">+</button>
      </div>
    </div>

    <!-- Add to Cart Button -->
    <button
      :disabled="!selectedColor || !selectedSize"
      class="w-full py-3 font-bold rounded text-white"
      :class="(!selectedColor || !selectedSize) ? 'bg-gray-400' : 'bg-red-500 hover:bg-red-600'"
    >
      ADD TO CART
    </button>
  </div>
</div>

<script>
  function productModal() {
    return {
      showModal: false,
      item: {
        price: 0,
        stock: 0,
        colors: [],
        sizes: [],
      },
      selectedColor: null,
      selectedSize: null,
      quantity: 1,
      init() {
        window.addEventListener('open-product-modal', (e) => {
          this.item = e.detail.item;
          this.showModal = true;
          this.selectedColor = null;
          this.selectedSize = null;
          this.quantity = 1;
        });
      },
    };
  }
</script>
