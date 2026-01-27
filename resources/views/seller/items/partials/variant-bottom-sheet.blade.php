<div x-show="showModal" class="fixed inset-0 z-40 bg-black/40" @click="showModal = false" x-transition.opacity></div>

{{-- Bottom Sheet Modal --}}

<div x-show="showModal" x-transition
    class="fixed bottom-0 left-0 right-0 z-[51] max-h-[90vh] overflow-y-auto rounded-t-2xl bg-white p-4 md:mx-auto md:max-w-md md:rounded-xl">
    <!-- Close Button -->
    <div class="flex justify-end">
        <button @click="showModal = false" class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
    </div>

    <!-- Product Preview -->
    <div class="flex items-center gap-4 mb-4">

        <!-- Variant image -->

        <div class="w-24 h-24 cursor-pointer"
            @click="viewerImages = selectedVariant?.images || [previewImage]; currentImageIndex = 0; imageViewerOpen = true;">
            <img :src="previewImage" class="object-contain w-full h-full rounded" />

        </div>

        <!-- Price Info (Stacked) -->
        <div class="flex flex-col">

            <!-- Bottom Price Block (matches top style) -->
            <div class="flex flex-col">

                <!-- Price (Discount first, then original crossed out) -->

                {{-- <div class="flex items-center gap-2">
                    <span class="text-3xl font-bold text-red-500">
                        ฿<span x-text="selectedVariant?.discount_price ?? selectedVariant?.price ?? 0"></span>
                    </span>

                    <span x-show="selectedVariant?.discount_price" class="ml-1 text-sm text-gray-400 line-through">
                        ฿<span x-text="selectedVariant?.price ?? 0"></span>
                    </span>
                </div> --}}

                <div class="relative">

                    <!-- Seller label -->
                    <div class="absolute left-0 px-2 py-1 text-xs font-semibold text-white bg-gray-800 rounded-md -top-6"
                        x-show="priceMode === 'seller'">
                        Seller
                    </div>

                    <!-- Price box -->
                    <div class="p-4 mt-2 border border-gray-200 rounded-xl">

                        <div class="flex items-center gap-2">

                            <!-- Main Price -->
                            <span class="text-3xl font-bold text-red-500" @click="priceTapped()">
                                ฿<span x-text="selectedPrice"></span>
                            </span>

                            <!-- Crossed out price -->
                            <span class="ml-1 text-sm text-gray-400 line-through"
                                x-show="
                    (priceMode === 'normal' && selectedVariant?.discount_price) ||
                    (priceMode === 'seller' && selectedVariant?.seller_discount_price)
                ">
                                ฿
                                <span
                                    x-text="
                    priceMode === 'normal'
                        ? (selectedVariant?.price ?? 0)
                        : (selectedVariant?.seller_price ?? selectedVariant?.price ?? 0)
                "></span>
                            </span>

                        </div>

                    </div>
                </div>




                <div class="flex items-center gap-2">
                    {{-- <span class="text-sm text-gray-400" x-show="priceMode === 'seller'">
                        Seller
                    </span> --}}

                    {{-- <span class="text-3xl font-bold text-red-500" @click="priceTapped()">
                        ฿<span x-text="selectedPrice"></span>
                    </span> --}}
                </div>


                <div class="text-sm text-gray-500"
                    x-show="(selectedPricePerPiece && selectedPricePerPiece !== '0.00') || (selectedPricePerPacket && selectedPricePerPacket !== '0.00')">

                    <!-- show piece ONLY for packet or cartoon -->
                    <template x-if="selectedPackaging?.name?.toLowerCase() !== 'piece' && selectedPricePerPiece">
                        ฿<span x-text="selectedPricePerPiece"></span>
                        <span>/ piece</span>
                    </template>

                    <!-- show packet only if cartoon selected -->
                    <template x-if="selectedPricePerPacket">
                        <span class="mx-2">|</span>
                        ฿<span x-text="selectedPricePerPacket"></span>
                        <span>/ packet</span>
                    </template>

                </div>





            </div>

            {{-- <div class="text-sm text-gray-500">
                Seller Price:
                <span class="font-semibold">
                    ฿<span x-text="selectedVariant?.seller_price ?? 'N/A'"></span>
                </span>
            </div> --}}

        </div>

        <!-- Price + Stock Row -->
            <!-- Stock moved to right -->
    <div class="flex justify-between mt-2">
        <div></div>
        <div class="text-sm text-gray-500">
            Stock:
            <span class="font-semibold" x-text="selectedStock"></span>
        </div>
    </div>

    </div>

    <!-- Color Selector -->
    <div class="mb-4">
        <div class="mb-2 text-sm font-semibold">COLOR</div>
        <div class="flex flex-wrap gap-2">
            <template x-for="(color, index) in colors" :key="index">
                <button type="button"
                    @click="
                                if (!color.disabled) {
                                    selectedColor = color;

                                    // 1️⃣ Auto-select first available size for this color
                                    const sizesForColor = variants
                                        .filter(v => v.color === color.name)
                                        .map(v => v.size);
                                    selectedSize = sizesForColor[0] || null;

                                    // 2️⃣ Auto-select first available packaging for this color+size
                                    const packagesForSelection = variants
                                        .filter(v => v.color === color.name && v.size === selectedSize)
                                        .map(v => v.packaging)
                                        .filter(p => p); // only non-null packaging
                                    selectedPackaging = packagesForSelection.length > 0
                                        ? item.packaging_details.find(pd => pd.name === packagesForSelection[0])
                                        : null;

                                    // 3️⃣ Update price and stock
                                    updatePrice();
                                }
                            "
                    :class="{
                        'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color.disabled,
                        'border-black bg-black text-white': selectedColor?.name === color.name && !color.disabled
                    }"
                    class="flex flex-col items-center w-20 px-2 py-1 text-xs border rounded-md">
                    <img :src="color.img" class="object-cover w-10 h-10 mb-1 rounded" />
                    <span x-text="color.name"></span>
                </button>

            </template>

        </div>
    </div>

    <!-- Size Selector -->
    <div class="mb-4" x-show="item.sizes.length > 0">
        <div class="mb-2 text-sm font-semibold">SIZE</div>
        <div class="flex flex-wrap gap-2">
            <template x-for="(size, index) in item.sizes" :key="index">
                <button type="button"
                    @click="
                                    if (availableSizes.includes(size.name)) {
                                        selectedSize = size.name;

                                        // Auto-select first available packaging for this color & size
                                        let options = variants
                                            .filter(v => v.color === selectedColor.name && v.size === selectedSize)
                                            .map(v => v.packaging)
                                            .filter(p => p);

                                        selectedPackaging = options.length > 0
                                            ? item.packaging_details.find(pd => pd.name === options[0])
                                            : null;

                                        updatePrice();
                                    }
                                "
                    class="px-4 py-2 text-sm transition-colors duration-200 border rounded-full"
                    :class="{
                        'bg-gray-100 text-gray-400 cursor-not-allowed opacity-80': !availableSizes.includes(size
                            .name), // slightly less dim
                        'bg-black text-white border-black': selectedSize === size.name && availableSizes.includes(
                            size.name),
                        'hover:bg-gray-200': availableSizes.includes(size.name) && selectedSize !== size.name
                    }"
                    x-text="size.name">
                </button>
            </template>
        </div>
    </div>



    <!-- Packaging Selector -->
    <div class="mb-6">
        <div class="mb-2 text-sm font-semibold">Packaging</div>
        <div class="flex flex-wrap gap-2">
            <template x-for="(option, index) in availablePackaging" :key="option.name">
                <button type="button" @click="if (!option.disabled) { selectedPackaging = option; updatePrice(); }"
                    class="px-4 py-2 text-sm transition-colors duration-200 border rounded-full"
                    :class="{
                        'bg-gray-100 text-gray-400 cursor-not-allowed opacity-60': option.disabled,
                        'bg-black text-white border-black': selectedPackaging?.name === option.name && !option
                            .disabled,
                        'hover:bg-gray-200': !option.disabled && selectedPackaging?.name !== option.name
                    }">
                    <span x-text="option.disabled ? option.name : `${option.name} (${option.quantity})`"></span>
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
    <button :disabled="(colors.length > 0 && !selectedColor) || (item.sizes.length > 0 && !selectedSize)"
        @click="showDiscountSelector = true; showModal = false" class="w-full py-3 btn btn-warning btn-active"
        :class="((colors.length > 0 && !selectedColor) || (item.sizes.length > 0 && !selectedSize)) ?
        'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-600'">
        ADD TO CART
    </button>

</div>

<div x-show="showDiscountSelector" x-transition
    class="fixed bottom-0 left-0 right-0 z-[51] max-h-[90vh] overflow-y-auto rounded-t-2xl bg-white p-4 md:mx-auto md:max-w-md md:rounded-xl"
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
    }">
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
                <button type="button" @click="selectedCustomer = customer"
                    class="flex flex-col items-center flex-shrink-0 w-24 px-2 py-1 text-xs border rounded-md"
                    :class="{
                        'bg-blue-600 text-white': selectedCustomer?.id === customer
                            .id,
                        'bg-gray-100': selectedCustomer?.id !== customer.id
                    }">
                    <img :src="customer.img || 'https://www.mezgebedirijit.com/images/customerprofile.jpeg'"
                        class="object-cover w-10 h-10 mb-1 rounded-full" />
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
                    <button @click="selectedCart = cart"
                        class="flex flex-col items-center flex-shrink-0 w-24 px-2 py-1 text-xs border rounded-md"
                        :class="{
                            'bg-blue-600 text-white': selectedCart?.id === cart
                                .id,
                            'bg-gray-100': selectedCart?.id !== cart.id
                        }">
                        <span x-text="'Cart #' + cart.id"></span>
                        <span class="text-xs" x-text="'Created ' + new Date(cart.created_at).toLocaleDateString()"></span>
                    </button>
                </template>
            </div>
        </div>
    </template>

    <!-- Discount Info -->
    <template x-if="selectedCustomer">
        <div class="mt-3">
            <p class="text-gray-700">Checking discounts...</p>
            <p class="font-semibold text-green-600" x-text="discount ? `Discount: ${discount}%` : 'No discount available'"></p>
        </div>
    </template>


    <!-- Confirm Button -->
    <button class="w-full mt-4 btn btn-success" :disabled="!selectedCustomer || !selectedCart"
        @click="addToCartWithCustomer()">
        Confirm & Add to Cart
    </button>
</div>
