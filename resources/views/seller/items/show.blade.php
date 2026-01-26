@extends('seller.layouts.app')

@section('content')
<div class="max-w-4xl p-2 pb-20 mx-auto">
    <div class="overflow-hidden bg-white rounded-lg shadow-lg">

        {{-- Swiper Image Slider --}}
        <div class="swiper mySwiper relative h-[400px] w-full">
            <div class="h-full swiper-wrapper">
                @forelse ($allImages as $image)
                    <div class="flex items-center justify-center h-full swiper-slide">
                        <img src="{{ asset($image) }}" alt="" class="object-contain w-auto h-full" />
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
            $store = auth()->user()->store;

            $minStoreVariant = $store
                ? $store->variants()
                    ->whereHas('variant.item', function ($q) use ($item) {
                        $q->where('id', $item->id);
                    })
                    ->orderBy('price', 'asc')
                    ->first()
                : null;

            $displayPrice = $minStoreVariant->discount_price ?? $minStoreVariant->price ?? null;
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
<div class="flex items-center justify-between mt-4 font-fancy">
    <div class="flex items-center gap-2">
        @if($minStoreVariant)
            <span class="text-3xl font-bold text-red-500">
                ฿{{ number_format($minStoreVariant->discount_price ?? $minStoreVariant->price, 2) }}
            </span>

            @if ($minStoreVariant->discount_price)
                <span class="ml-1 text-sm text-gray-400 line-through">
                    ฿{{ number_format($minStoreVariant->price, 2) }}
                </span>
            @endif
        @endif
    </div>
</div>


                <!-- Right: Discount Percentage -->
                <div class="flex items-center gap-2">
@if ($minStoreVariant?->discount_price)
    @php
        $original = $minStoreVariant->price;
        $discounted = $minStoreVariant->discount_price;
        $discountPercent = round((($original - $discounted) / $original) * 100);
    @endphp

                        <div>
                            <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-full">
                                -{{ $discountPercent }}%
                            </span>
                        </div>
                    @endif
                </div>
            </div>



            {{-- @if($minStoreVariant)
                <span class="text-3xl font-bold text-red-500">
                    ฿{{ number_format($minStoreVariant->pivot->discount_price ?? $minStoreVariant->pivot->price, 0) }}
                </span>

                @if ($minStoreVariant->pivot->discount_price)
                    <span class="ml-1 text-sm text-gray-400 line-through">
                        ฿{{ number_format($minStoreVariant->pivot->price, 0) }}
                    </span>
                @endif
            @else
                <span class="text-gray-400">Price unavailable</span>
            @endif --}}



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
                        //XXXXXXXXXXXXXXX -------------->  selectedDiscountPrice

                        selectedStock: null,
                        showDiscountSelector: false,
                        selectedCart: null,
                        selectedImg: '/img/default.jpg',
                        quantity: 1,

                        init() {
                            // Automatically select the first variant
                            if (this.variants.length > 0) {
                                const first = this.variants[0];
                                this.selectedColor = {
                                    name: first.color,
                                    img: first.images?.[0] || first.img || '/img/default.jpg', // <-- use variant image
                                    disabled: first.disabled
                                };
                                this.selectedSize = first.size;
                                this.selectedPackaging = first.packaging ? {
                                        name: first.packaging,
                                        quantity: first.quantity,
                                        disabled: first.disabled
                                    } :
                                    null;
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
                            this.selectedStock = match ? match.stock : null;

                            if (match && this.selectedPackaging) {
                                // Ensure quantity comes from the matched variant
                                this.selectedPackaging.quantity = match.quantity ?? 1;
                            }
                        },
                    };
                }
            </script>
        </div>

        {{-- Alpine.js Variant Modal --}}
        <div x-data="{
            // Merge the logic and data from variantSelector(...)
            ...variantSelector({{ $variantData->toJson() }}),

            modalOpen: false,
            imageViewerOpen: false,
            viewerImages: [],

            showDiscountSelector: false,
            selectedCart: null,
            selectedColor: null,
            selectedSize: null,

            customers: {{ $customersWithOpenCarts->toJson() }},
            carts: {{ $customersWithOpenCarts->flatMap(fn($c) => $c->carts->where('status', 'open'))->toJson() }},
            selectedCustomer: null,

            item: {
                price: {{ number_format($displayPrice, 0) }},
                stock: [@foreach ($item->variants as $variant) {{ $variant->stock }}@if (!$loop->last),@endif @endforeach],
                sizes: [@foreach ($item->variants->unique('item_size_id') as $variant) {{ $variant->size }}@if (!$loop->last),@endif @endforeach],
                packaging_details: [
                    @php $seen = []; @endphp
                    @foreach ($item->variants as $variant)
                        @php
                            $pkg = $variant->itemPackagingType;
                        @endphp
                        @if ($pkg && !in_array($pkg->id, $seen))
                            @php $seen[] = $pkg->id; @endphp

                            {
                                name: '{{ $pkg->name }}',
                                quantity: {{ $pkg->quantity ?? 0 }}, {{-- ✅ This uses the value from your table --}}
                                disabled: false
                            }@if (!$loop->last),@endif
                        @endif
                    @endforeach
                ]
            },

            // === NEW ===
            init() {
                // Automatically select the first variant
                if (this.variants.length > 0) {
                    const first = this.variants[0];
                    this.selectedColor = {
                        name: first.color,
                        img: first.images?.[0] ? '{{ asset('') }}' + first.images[0] : first.img ? '{{ asset('') }}' + first.img : '/img/default.jpg',
                        disabled: first.disabled
                    };
                    this.selectedSize = first.size;
                    this.selectedPackaging = first.packaging ? {
                        name: first.packaging,
                        quantity: first.quantity,
                        disabled: first.disabled
                    } : null;
                    this.updatePrice();
                }
            },



            openImageViewer(images = null) {
                this.viewerImages = images || (this.selectedVariant?.images || [this.previewImage]);
                this.imageViewerOpen = true;
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

            get previewImage() {
            if (this.selectedVariant?.images?.[0]) return this.selectedVariant.images[0];
            if (this.selectedColor?.img) return this.selectedColor.img;
            return '/img/product.jpg';
            },


            get availableSizes() {
            if (!this.selectedColor) return this.item.sizes;
            return this.variants
            .filter(v => v.color === this.selectedColor.name)
            .map(v => v.size);
            },

            get availablePackaging() {
            if (!this.selectedColor) {
            // No color selected: show all options but disabled
            return this.item.packaging_details.map(p => ({
            ...p,
            disabled: true
            }));
            }

            // Filter variants by selected color and size
            let filteredVariants = this.variants.filter(v => v.color === this.selectedColor.name);
            if (this.selectedSize) {
            filteredVariants = filteredVariants.filter(v => v.size === this.selectedSize);
            }

            // Map all packaging options, mark disabled if not in filteredVariants and set actual quantity
            return this.item.packaging_details.map(p => {
            const matchedVariant = filteredVariants.find(v => v.packaging === p.name);
            return {
            ...p,
            disabled: !matchedVariant,
            quantity: matchedVariant ? matchedVariant.quantity : p.quantity ?? 1
            };
            });
            },

            watch: {
                selectedColor(newColor) {
                if (!newColor) return;

                // 1️⃣ Auto-select first available size for this color
                const availableSizesForColor = this.variants
                .filter(v => v.color === newColor.name)
                .map(v => v.size);
                this.selectedSize = availableSizesForColor[0] || null;

                // 2️⃣ Auto-select first available packaging for this color + size
                const availablePackagesForSelection = this.variants
                .filter(v => v.color === newColor.name && v.size === this.selectedSize)
                .map(v => v.packaging);

                if (availablePackagesForSelection.length > 0) {
                // Find the package object from packaging_details to get quantity
                const pkg = this.item.packaging_details.find(p => p.name === availablePackagesForSelection[0]);
                this.selectedPackaging = pkg || null;
                } else {
                this.selectedPackaging = null;
                }

                this.updatePrice();
                }
            },



            get selectedPricePerPiece() {
                if (this.selectedPrice && this.selectedPackaging?.quantity) {
                    return (this.selectedPrice / this.selectedPackaging.quantity).toFixed(2);
                }
                return '';
            }

        }" x-cloak>
            <div class="flex flex-col items-center w-full max-w-xs pb-4 mx-auto mt-6 space-y-4">
                <button @click="showModal = true; init()" class="w-full py-3 text-lg btn btn-info btn-active sm:w-auto">
                    Add to Cart
                </button>

                <button class="w-full py-3 text-lg btn btn-info btn-active sm:w-auto">Buy Now</button>
            </div>



            {{-- Overlay --}}
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
                        <img :src="previewImage"
                                class="object-contain w-full h-full rounded" />

                    </div>

                    <!-- Price Info (Stacked) -->
                    <div class="flex flex-col">

                        <!------------------------------------------------------------>
<!-- Left: Current Price and Original Price -->
<div class="flex items-center gap-2">
    @if($minStoreVariant)
        <span class="text-3xl font-bold text-red-500">
            ฿{{ number_format($minStoreVariant->discount_price ?? $minStoreVariant->price, 2) }}
        </span>

        @if ($minStoreVariant->discount_price)
            <span class="ml-1 text-sm text-gray-400 line-through">
                ฿{{ number_format($minStoreVariant->price, 2) }}
            </span>
        @endif
    @else
        <span class="text-gray-400">Price unavailable</span>
    @endif
</div>

                        <!------------------------------------------------------------>

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
                    <template x-for="(color, index) in colors"
                            :key="index">
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
                        <img :src="color.img"
                                class="object-cover w-10 h-10 mb-1 rounded" />
                        <span x-text="color.name"></span>
                    </button>

                    </template>

                    </div>
                </div>

                <!-- Size Selector -->
            <div class="mb-4"
                    x-show="item.sizes.length > 0">
                <div class="mb-2 text-sm font-semibold">SIZE</div>
                <div class="flex flex-wrap gap-2">
                    <template x-for="(size, index) in item.sizes"
                                :key="index">
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
                                    'bg-gray-100 text-gray-400 cursor-not-allowed opacity-80': !availableSizes.includes(size.name), // slightly less dim
                                    'bg-black text-white border-black': selectedSize === size.name && availableSizes.includes(size.name),
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
                    <template x-for="(option, index) in availablePackaging"
                            :key="option.name">
                        <button type="button"
                                @click="if (!option.disabled) { selectedPackaging = option; updatePrice(); }"
                                class="px-4 py-2 text-sm transition-colors duration-200 border rounded-full"
                                :class="{
                                    'bg-gray-100 text-gray-400 cursor-not-allowed opacity-60': option.disabled,
                                    'bg-black text-white border-black': selectedPackaging?.name === option.name && !option.disabled,
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
                        @click="showDiscountSelector = true; showModal = false"
                        class="w-full py-3 btn btn-warning btn-active"
                        :class="((colors.length > 0 && !selectedColor) || (item.sizes.length > 0 && !selectedSize)) ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-600'">
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
                            <template x-for="cart in carts.filter(c => c.customer_id === selectedCustomer.id)"
                                :key="cart.id">
                                <button @click="selectedCart = cart"
                                    class="flex flex-col items-center flex-shrink-0 w-24 px-2 py-1 text-xs border rounded-md"
                                    :class="{
                                        'bg-blue-600 text-white': selectedCart?.id === cart
                                            .id,
                                        'bg-gray-100': selectedCart?.id !== cart.id
                                    }">
                                    <span x-text="'Cart #' + cart.id"></span>
                                    <span class="text-xs"
                                        x-text="'Created ' + new Date(cart.created_at).toLocaleDateString()"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Discount Info -->
                <template x-if="selectedCustomer">
                    <div class="mt-3">
                        <p class="text-gray-700">Checking discounts...</p>
                        <p class="font-semibold text-green-600"
                        x-text="discount ? `Discount: ${discount}%` : 'No discount available'"></p>
                    </div>
                </template>


                <!-- Confirm Button -->
                <button class="w-full mt-4 btn btn-success" :disabled="!selectedCustomer || !selectedCart"
                    @click="addToCartWithCustomer()">
                    Confirm & Add to Cart
                </button>
            </div>

        </div>

    </div>
</div>

@endsection

{{-- <script>
    function variantGallery(variants) {
        return {
            variants: variants,
            modalOpen: false,
            modalImages: [],
            init() {
                // optional: automatically select first variant
            },
            openModal(images) {
                this.modalImages = images;
                this.modalOpen = true;
            }
        }
    }
</script> --}}

<script>
    console.log('variantData:', @json($variantData));
</script>
{{-- @php
dump([
    'variant_id' => $variant->id,
    'pkg_id' => $pkg->id,
    'packaging_total_pieces' => $variantWithPkg->packaging_total_pieces ?? 'NULL',
    'stock' => $variantWithPkg->stock ?? 'NULL',
]);
@endphp

@dd($variant)
 --}}
{{-- @php dd($pkg->toArray()); @endphp --}}
