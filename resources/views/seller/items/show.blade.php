@extends("seller.layouts.app")

{{--
    0 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_1.jpg"
    1 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_2.jpg"
    2 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_color_1.jpg"
    3 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_color_2.jpg"
    4 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_red.jpg"
    5 : "http://duka-11.2.0.local:8086/images/product_images/2_side_color_blue.jpg"
    6 : "http://duka-11.2.0.local:8086/images/sizes/s.png"
    7 : "http://duka-11.2.0.local:8086/images/sizes/l.png"
--}}

{{--
    return view('seller.items.show', compact(
    
    'item',
    'sellers',
    'carts',
    'allImages',
    'variantData'
    ));
--}}

@section("content")
  <div class="max-w-4xl p-2 pb-20 mx-auto">
    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
      {{-- Swiper Image Slider --}}
      <div class="swiper mySwiper relative w-full h-[400px]">
        <div class="h-full swiper-wrapper">
          @forelse ($allImages as $image)
            <div class="flex items-center justify-center h-full swiper-slide">
              <img src="{{ $image }}" alt="Product Image" class="object-contain w-auto h-full" />
            </div>
          @empty
            <div class="p-4 swiper-slide">No images available.</div>
          @endforelse
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>

      {{-- Table of $variantData --}}

      <script>
        const variantData = @json($variantData);
        console.log('$variantData', @json($variantData));
        console.log('$allImages', @json($allImages));
      </script>

      @php
        // Get the minimum variant price
        $minVariant = $item->variants->sortBy("price")->first();
        $displayPrice = $minVariant->discount_price ?? $minVariant->price;
      @endphp

      {{-- Product Info --}}
      <div class="p-6">
        {{-- <h2 class="text-2xl font-semibold text-gray-800">{{ $item->product_name }}</h2> --}}
        <h2 class="text-2xl font-semibold text-gray-800 font-fancy">
          {{ $item->product_name }}
        </h2>

        <p class="mt-2 text-gray-600 font-fancy">
          {{ $item->product_description }}
        </p>

        <div class="flex items-center justify-between mt-4 font-fancy">
          <!-- Left: Current Price and Original Price -->
          <div class="flex items-center gap-2">
            <span class="text-3xl font-bold text-red-500">฿{{ number_format($displayPrice, 0) }}</span>

            @if ($minVariant->discount_price)
              <span class="ml-1 text-sm text-gray-400 line-through">฿{{ number_format($minVariant->price, 0) }}</span>
            @endif
          </div>

          <!-- Right: Discount Percentage -->
          <div class="flex items-center gap-2">
            @if ($minVariant->discount_price)
              <div>
                <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-full">
                  -{{ $minVariant->discount_percentage }}%
                </span>
              </div>
            @endif
          </div>
        </div>

        @if ($item->has_discount)
          <div class="mt-4">
            <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded">Discount Available</span>
          </div>
        @endif

        {{-- Alpine.js Variant Selector Logic --}}
        <script>
          function variantSelector(variants) {
            return {
              showModal: false,
              variants: variants,
              selectedColor: '',
              selectedSize: null,
              selectedPackaging: null,
              selectedPrice: null,
              selectedStock: null,
              showDiscountSelector: false,
              selectedCart: null,
              selectedImg: '/img/default.jpg',
              quantity: 1,

              init() {
                // Automatically select the first variant
                if (this.variants.length > 0) {
                  const first = this.variants[0];
                  this.selectedColor = { name: first.color, img: first.img, disabled: first.disabled };
                  this.selectedSize = first.size;
                  this.selectedPackaging = first.packaging
                    ? { name: first.packaging, quantity: first.quantity, disabled: first.disabled }
                    : null;
                  this.updatePrice();
                }
              },

              get colors() {
                return [...new Set(this.variants.map((v) => v.color))];
              },

              // get colors() {
              //     // Get unique colors
              //     const seen = new Set();
              //     return this.variants.filter(v => {
              //         if (seen.has(v.color)) return false;
              //         seen.add(v.color);
              //         return true;
              //     });
              // },

              get colors() {
                const uniqueColors = [];
                const seen = new Set();

                this.variants.forEach((v) => {
                  if (!seen.has(v.color)) {
                    seen.add(v.color);
                    uniqueColors.push({
                      name: v.color,
                      img: v.img,
                      disabled: v.disabled,
                    });
                  }
                });

                return uniqueColors;
              },

              get formattedPrice() {
                return this.selectedPrice !== null ? this.selectedPrice.toFixed(2) : '';
              },

              updatePrice() {
                const match = this.variants.find(
                  (v) =>
                    v.color === this.selectedColor.name &&
                    v.size === this.selectedSize &&
                    v.packaging === this.selectedPackaging?.name
                );
                this.selectedPrice = match ? match.price : null;
                // this.selectedPackaging = match ? match.packaging.quantity : null;
                this.selectedStock = match ? match.stock : null;
              },
            };
          }
        </script>
      </div>

      {{-- Alpine.js Variant Modal --}}
      <div
        x-data="{
                    // Merge the logic and data from variantSelector(...)
                    ...variantSelector({{ $variantData->toJson() }}),

                    showDiscountSelector: false,
                    selectedCart: null,
                    selectedColor: null,
                    selectedSize: null,

                    customers: {{ $customersWithOpenCarts->toJson() }},
                    // Flatten all open carts for these customers
                    carts: {{ $customersWithOpenCarts->flatMap(fn ($c) => $c->carts->where('status', 'open'))->toJson() }},

                    selectedCustomer: null,

                    addToCartWithCustomer() {
                        if (!this.selectedCustomer || !this.selectedCart) return;

                        console.log('Adding to cart:', {
                            customer: this.selectedCustomer,
                            cart: this.selectedCart,
                            variant: this.selectedVariant,
                            quantity: this.quantity
                        });

                        this.showDiscountSelector = false;
                        this.showModal = false;
                    },

                    item: {
                        price: {{ number_format($displayPrice, 0) }},

                        stock: [
                            @foreach ($item->variants as $variant)

                            {{ $variant->stock }}@if (! $loop->last),
                            @endif@endforeach

                        ],

                        sizes: [
                            @foreach ($item->variants->unique("item_size_id") as $variant)

                            {{ $variant->size }}@if (! $loop->last),
                            @endif@endforeach

                        ],

                        packaging_details: [
                            @php
                            $seen = [];

@endphp
                            @foreach ($item->variants as $variant)


                                @php
$pkg = $variant->itemPackagingType;
$key = $pkg?->id;


@endphp
                                @if ($pkg && ! in_array($key, $seen))

                                    @php
$seen[] = $key;


@endphp
                                    {
                                        name: '{{ $pkg->name }}',
                                        quantity: {{ $pkg->quantity ?? 1 }},
                                        disabled: {{ $pkg->disabled ? "true" : "false" }}
                                    }@if (! $loop->last)
,@endif
                            @endif 
@endforeach

                        ]

                    },
                    addToCart() {
                        // Handle adding to cart logic here (e.g., store cart item in session or make an AJAX request)
                        this.showModal = false;
                        window.location.href = '/cart'; // Redirect to the cart page
                    },

                    addToCartWithCustomer() {
                        if (!this.selectedCustomer || !this.selectedCart) return;

                        // Example: you can send an AJAX request to your backend here
                        // For now, let's just log
                        console.log('Adding to cart:', {
                            customer: this.selectedCustomer,
                            cart: this.selectedCart,
                            variant: this.selectedVariant,
                            quantity: this.quantity
                        });

                        // Close bottom sheet and modal
                        this.showDiscountSelector = false;
                        this.showModal = false;

                        // Optional: redirect or refresh page
                        // window.location.href = '/cart';
                    },


                    get selectedVariant() {

                        return this.variants.find(variant =>
                            variant.color === this.selectedColor?.name &&
                            variant.size === this.selectedSize &&
                            variant.packaging === this.selectedPackaging?.name
                        );
                    },

                    get selectedPricePerPiece() {
                        if (this.selectedPrice && this.selectedPackaging?.quantity) {
                            return (this.selectedPrice / this.selectedPackaging.quantity).toFixed(2);
                        }
                        return '';
                    }

                }"
        x-cloak
      >
        <div class="flex flex-col items-center w-full max-w-xs pb-4 mx-auto mt-6 space-y-4">
          <button @click="showModal = true; init()" class="w-full py-3 text-lg sm:w-auto btn btn-active btn-info">
            Add to Cart
          </button>

          <button class="w-full py-3 text-lg sm:w-auto btn btn-active btn-info">Buy Now</button>
        </div>

        {{-- Overlay --}}
        <div
          x-show="showModal"
          class="fixed inset-0 z-40 bg-black/40"
          @click="showModal = false"
          x-transition.opacity
        ></div>

        {{-- Bottom Sheet Modal --}}

        <div
          x-show="showModal"
          x-transition
          class="fixed bottom-0 left-0 right-0 z-[51] bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl"
        >
          <!-- Close Button -->
          <div class="flex justify-end">
            <button @click="showModal = false" class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
          </div>

          <!-- Product Preview -->
          <div class="flex items-center gap-4 mb-4">
            <img
              :src="selectedColor ? selectedColor.img : '/img/product.jpg'"
              alt="Product"
              class="object-cover w-20 h-20 border rounded"
            />

            <!-- Price Info (Stacked) -->
            <div class="flex flex-col">
              <!-- Main Price -->
              <div class="text-lg font-semibold text-red-500">
                ฿
                <span x-text="selectedPrice"></span>
              </div>

              <!-- Price per Piece -->
              <div class="text-sm text-gray-500">
                ฿
                <span x-text="selectedPricePerPiece"></span>
                / piece
              </div>
            </div>

            <!----Stock------->
            <div class="text-sm text-gray-500">
              Stock:
              <span x-text="selectedStock"></span>
            </div>
          </div>

          <!-- Color Selector -->
          <div class="mb-4">
            <div class="mb-2 text-sm font-semibold">COLOR</div>
            <div class="flex flex-wrap gap-2">
              <template x-for="(color, index) in colors" :key="index">
                <button
                  type="button"
                  @click="!color.disabled && (selectedColor = color, updatePrice())"
                  class="flex flex-col items-center w-20 px-2 py-1 text-xs border rounded-md"
                  :class="{
                                            'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color
                                                .disabled,
                                            'border-black bg-black text-white': selectedColor?.name === color
                                                .name && !color
                                                .disabled
                                        }"
                >
                  <img :src="color.img" class="object-cover w-10 h-10 mb-1 rounded" />
                  <span x-text="color.name"></span>
                </button>
              </template>
            </div>
          </div>

          <!-- Size Selector -->
          <div class="mb-4" x-show="item.sizes.length > 0">
            <div class="mb-2 text-sm font-semibold">SIZE</div>
            <div class="grid grid-cols-2 gap-2">
              <template x-for="(size, index) in item.sizes" :key="index">
                <button
                  type="button"
                  @click="!size.disabled && (selectedSize = size.name, updatePrice())"
                  class="px-3 py-2 text-xs text-left border rounded-md"
                  :class="{
                                            'bg-gray-100 text-gray-400 cursor-not-allowed': size.disabled,
                                            'bg-black text-white': selectedSize === size.name && !size.disabled
                                        }"
                  x-text="size.name"
                ></button>
              </template>
            </div>
          </div>

          <!-- Packaging Selector -->
          <div class="mb-6">
            <div class="mb-2 text-sm font-semibold">Packaging</div>
            <div class="flex flex-wrap gap-2">
              <template x-for="(option, index) in item.packaging_details" :key="option.name">
                <button
                  type="button"
                  @click="!option.disabled && (selectedPackaging = option, updatePrice())"
                  class="px-4 py-2 text-sm border rounded-md"
                  :class="{
                                            'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': option
                                                .disabled,
                                            'border-black bg-black text-white': selectedPackaging?.name === option
                                                .name && !
                                                option.disabled
                                        }"
                >
                  <span x-text="`${option.name} (${option.quantity})`"></span>
                </button>
              </template>
            </div>
          </div>

          <!-- Quantity Control -->
          <div class="mb-6">
            <div class="mb-2 text-sm font-semibold">Quantity</div>
            <div class="flex items-center px-2 border rounded w-max">
              <button type="button" class="px-2 text-lg" @click="quantity = Math.max(1, quantity - 1)">–</button>
              <input type="number" x-model="quantity" min="1" class="w-12 text-center outline-none border-x" />
              <button type="button" class="px-2 text-lg" @click="quantity++">+</button>
            </div>
          </div>

          <!-- Add to Cart Button -->
          <button
            :disabled="!selectedColor || !selectedSize"
            @click="if(selectedColor && selectedSize) { showDiscountSelector = true; showModal = false; }"
            class="w-full py-3 btn btn-active btn-warning"
            :class="(!selectedColor || !selectedSize) ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-600'"
          >
            ADD TO CART
          </button>
        </div>

        <div
          x-show="showDiscountSelector"
          x-transition
          class="fixed bottom-0 left-0 right-0 z-[51] bg-white rounded-t-2xl p-4 max-h-[90vh] overflow-y-auto md:max-w-md md:mx-auto md:rounded-xl"
          x-data="{
                        selectedCustomer: null,
                        selectedCart: null,
                        customers: {{ $customersWithOpenCarts->toJson() }},
                        carts: {{ $customersWithOpenCarts->flatMap(fn($c) => $c->carts->where('status', 'open'))->toJson() }},
                        addToCartWithCustomer() {
                            if (!this.selectedCustomer || !this.selectedCart) return;
                            console.log('Adding to cart:', {
                                customer: this.selectedCustomer,
                                cart: this.selectedCart
                            });
                            this.showDiscountSelector = false;
                            this.showModal = false;
                        }
                    }"
        >
          <!-- Header -->
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-lg font-semibold">Select Customer & Cart</h2>
            <button @click="showDiscountSelector = false" class="text-gray-500 hover:text-gray-700">✕</button>
          </div>

          <!-- Customer Selector -->
          <div class="mb-4">
            <div class="mb-2 text-sm font-semibold">CUSTOMER</div>
            <div class="flex gap-2 py-1 overflow-x-auto">
              <template x-for="customer in customers" :key="customer.id">
                <button
                  type="button"
                  @click="selectedCustomer = customer"
                  class="flex flex-col items-center flex-shrink-0 w-24 px-2 py-1 text-xs border rounded-md"
                  :class="{'bg-blue-600 text-white': selectedCustomer?.id === customer.id, 'bg-gray-100': selectedCustomer?.id !== customer.id}"
                >
                  <img
                    :src="customer.img || 'https://www.mezgebedirijit.com/images/customerprofile.jpeg'"
                    class="object-cover w-10 h-10 mb-1 rounded-full"
                  />
                  <span x-text="customer.first_name"></span>
                </button>
              </template>
            </div>
          </div>

          <!-- Cart Selector (shows after selecting a customer) -->
          <template x-if="selectedCustomer">
            <div class="mb-4">
              <div class="mb-2 text-sm font-semibold">Customer’s Carts</div>
              <div class="flex gap-2 py-1 overflow-x-auto">
                <template x-for="cart in carts.filter(c => c.customer_id === selectedCustomer.id)" :key="cart.id">
                  <button
                    @click="selectedCart = cart"
                    class="flex flex-col items-center flex-shrink-0 w-24 px-2 py-1 text-xs border rounded-md"
                    :class="{'bg-blue-600 text-white': selectedCart?.id === cart.id, 'bg-gray-100': selectedCart?.id !== cart.id}"
                  >
                    <span x-text="'Cart #' + cart.id"></span>
                    <span
                      class="text-xs"
                      x-text="'Created ' + new Date(cart.created_at).toLocaleDateString()"
                    ></span>
                  </button>
                </template>
              </div>
            </div>
          </template>

          <!-- Discount Info -->
          <template x-if="selectedCustomer && selectedCart">
            <div class="mt-3">
              <p class="text-gray-700">Checking discounts...</p>
              <p
                class="font-semibold text-green-600"
                x-text="discount ? `Discount: ${discount}%` : 'No discount available'"
              ></p>
            </div>
          </template>

          <!-- Confirm Button -->
          <button
            class="w-full mt-4 btn btn-success"
            :disabled="!selectedCustomer || !selectedCart"
            @click="addToCartWithCustomer()"
          >
            Confirm & Add to Cart
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
