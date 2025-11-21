  @extends('seller.layouts.app')

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

@section('content')
                              @php
    // --- Mock Data Setup (MUST BE KEPT for Compilation Context) ---
    $variantData = $item->variants;

    $customersWithOpenCarts = collect([]); // Mock empty

    // Get the minimum variant price
    $minVariant = $item->variants->sortBy('price')->first() ?? (object) ['price' => 100, 'discount_price' => null, 'discount_percentage' => 0];
    $displayPrice = $minVariant->discount_price ?? $minVariant->price;

    // Prepare auxiliary data structures for Alpine JS
    // Ensure this is a string to be passed safely to JS
    $initialPrice = number_format($displayPrice, 0);
    $packagingDetails = [];
    $seen = [];
    foreach ($item->variants as $variant) {
        $pkg = $variant->itemPackagingType;
        if ($pkg && !in_array($pkg->id, $seen)) {
            $seen[] = $pkg->id;
            $packagingDetails[] = [
                'name' => $pkg->name,
                'quantity' => $pkg->packaging_total_pieces ?? 1,
                'disabled' => false,
            ];
        }
    }
    // Ensure complex JSON data is outputted cleanly
    $customerData = $customersWithOpenCarts->toJson();
    $cartData = $customersWithOpenCarts->flatMap(fn($c) => collect($c->carts ?? [])->where('status', 'open'))->toJson();
    // -----------------------------------------------------------------
                            @endphp

            <div class="max-w-4xl p-2 pb-20 mx-auto">
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">

                    {{-- Swiper Image Slider --}}
                    <div class="swiper mySwiper relative h-[400px] w-full">
                        <div class="h-full swiper-wrapper">
                            @forelse ($allImages as $image)
                                <div class="flex items-center justify-center h-full swiper-slide">
                                    <img src="{{ asset($image) }}"
                                         alt=""
                                         class="object-contain w-auto h-full" />
                                </div>
                            @empty
                                <div class="p-4 swiper-slide">No images available.</div>
                            @endforelse
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                    {{-- --------------------------------------------------------------------------------- --}}
                    {{-- 1. Alpine.js Function Definition --}}
                    {{-- --------------------------------------------------------------------------------- --}}
                    <div>
                        <script>
                            function variantSelector(variants, initialPrice, packagingDetails, customerData, cartData) {
                                return {
                                    // DATA
                                    variants: variants,
                                    // Note: JSON.parse() is necessary here because the data is passed as a string from PHP
                                    customers: JSON.parse(customerData),
                                    carts: JSON.parse(cartData),

                                    // UI/MODAL STATE
                                    showModal: false,
                                    imageViewerOpen: false,

                                    // VARIANT SELECTION STATE
                                    selectedColor: '',
                                    selectedSize: null,
                                    selectedPackaging: null,
                                    selectedImg: '/img/default.jpg',
                                    selectedPrice: null,
                                    selectedStock: null,
                                    quantity: 1,

                                    // INITIAL PRODUCT DATA
                                    item: {
                                        price: initialPrice,
                                        packaging_details: packagingDetails,
                                        sizes: [...new Set(variants.map(v => v.size))],
                                    },

                                    // === HELPER FUNCTION ===
                                    getFirstImagePath(imagesData) {
                                        if (!imagesData) return null;
                                        let paths = imagesData;
                                        if (typeof imagesData === 'string') {
                                            let cleanedString = imagesData.trim().replace(/\\/g, '');
                                            try { paths = JSON.parse(cleanedString); } catch (e) { return null; }
                                        }
                                        return Array.isArray(paths) && paths.length > 0 ? paths[0] : null;
                                    },


                                    // === INITIALIZATION & REACTIVITY SETUP ===
                                    init() {
                                        // DEBUG: Check console to see if this message appears.
                                        console.log('Alpine component initialized!');

                                        // Initial Selection Setup (Select first variant)
                                        if (this.variants.length > 0) {
                                            const first = this.variants[0];
                                            this.selectedColor = { name: first.color, img: first.img, disabled: first.disabled };
                                            this.selectedSize = first.size;
                                            this.selectedPackaging = first.packaging ? this.item.packaging_details.find(p => p.name === first.packaging) : null;
                                        }

                                        // --- WATCHERS ---
                                        this.$watch('selectedColor', (newColor) => {
                                            if (!newColor) return;

                                            const availableSizesForColor = [...new Set(this.variants.filter(v => v.color === newColor.name).map(v => v.size))];
                                            this.selectedSize = availableSizesForColor[0] || null;

                                            const availablePackagesForSelection = this.variants
                                                .filter(v => v.color === newColor.name && v.size === this.selectedSize)
                                                .map(v => v.packaging).filter(p => p);

                                            if (availablePackagesForSelection.length > 0) {
                                                const pkg = this.item.packaging_details.find(p => p.name === availablePackagesForSelection[0]);
                                                this.selectedPackaging = pkg || null;
                                            } else {
                                                this.selectedPackaging = null;
                                            }
                                            this.updatePrice();
                                        });

                                        this.$watch('selectedSize', (newSize) => {
                                            if (!newSize || !this.selectedColor) return;

                                            const availablePackagesForSelection = this.variants
                                                .filter(v => v.color === this.selectedColor.name && v.size === newSize)
                                                .map(v => v.packaging).filter(p => p);

                                            if (availablePackagesForSelection.length > 0) {
                                                const pkg = this.item.packaging_details.find(p => p.name === availablePackagesForSelection[0]);
                                                if (!this.selectedPackaging || this.selectedPackaging.name !== pkg.name) {
                                                     this.selectedPackaging = pkg || null;
                                                }
                                            } else {
                                                this.selectedPackaging = null;
                                            }
                                            this.updatePrice();
                                        });

                                        this.$watch('selectedPackaging', () => {
                                            this.updatePrice();
                                        });

                                        this.updatePrice();
                                    },


                                    // === CORE LOGIC ===
                                    updatePrice() {
                                        const match = this.variants.find((v) =>
                                            v.color === this.selectedColor?.name &&
                                            v.size === this.selectedSize &&
                                            v.packaging === this.selectedPackaging?.name
                                        );

                                        this.selectedPrice = match ? match.price : null;
                                        this.selectedStock = match ? match.stock : null;

                                        if (match) {
                                            this.selectedImg = this.getFirstImagePath(match.images) || '/img/default.jpg';
                                            if (this.selectedPackaging) {
                                                this.selectedPackaging.quantity = match.packaging_total_pieces ?? 1;
                                            }
                                        } else {
                                            this.selectedImg = this.selectedColor?.img || '/img/default.jpg';
                                        }
                                    },


                                    // === GETTERS & ACTIONS (omitted for brevity, they are the same) ===
                                    get selectedVariant() {
                                        return this.variants.find(variant =>
                                            variant.color === this.selectedColor?.name &&
                                            variant.size === this.selectedSize &&
                                            variant.packaging === this.selectedPackaging?.name
                                        );
                                    },
                                    get colors() {
                                        return [...new Set(this.variants.map((v) => v.color))];
                                    },

                                    get formattedPrice() {
                                        return this.selectedPrice !== null ? this.selectedPrice.toFixed(2) : this.item.price;
                                    },

                                    get selectedPricePerPiece() {
                                        if (this.selectedPrice && this.selectedPackaging?.quantity && this.selectedPackaging.quantity > 0) {
                                            return (this.selectedPrice / this.selectedPackaging.quantity).toFixed(2);
                                        }
                                        return '';
                                    },

                                    get availableSizes() {
                                        if (!this.selectedColor) return this.item.sizes;
                                        return [...new Set(this.variants.filter(v => v.color === this.selectedColor.name).map(v => v.size))];
                                    },

                                    get availablePackaging() {
                                        if (!this.selectedColor) {
                                            return this.item.packaging_details.map(p => ({ ...p, disabled: true }));
                                        }

                                        let filteredVariants = this.variants.filter(v => v.color === this.selectedColor.name);
                                        if (this.selectedSize) {
                                            filteredVariants = filteredVariants.filter(v => v.size === this.selectedSize);
                                        }

                                        return this.item.packaging_details.map(p => {
                                            const matchedVariant = filteredVariants.find(v => v.packaging === p.name);
                                            return {
                                                ...p,
                                                disabled: !matchedVariant,
                                                quantity: matchedVariant ? matchedVariant.packaging_total_pieces : p.quantity ?? 1
                                            };
                                        });
                                    },

                                    addToCart() {
                                        console.log('Adding variant to cart:', this.selectedVariant, 'Quantity:', this.quantity);
                                        this.showModal = false;
                                        window.location.href = '/cart';
                                    },
                                    // === END OF GETTERS & ACTIONS ===
                                };
                            }
                        </script>
                    </div>


                    {{-- Product Info Display --}}
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 font-fancy">{{ $item->product_name }}</h2>
                        <p class="mt-2 text-gray-600 font-fancy">{{ $item->product_description }}</p>
                        <div class="flex items-center justify-between mt-4 font-fancy">
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-bold text-red-500">฿{{ number_format($displayPrice, 0) }}</span>
                                @if ($minVariant->discount_price)
                                    <span class="ml-1 text-sm text-gray-400 line-through">฿{{ number_format($minVariant->price, 0) }}</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                @if ($minVariant->discount_price)
                                    <div>
                                        <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-full">-{{ $minVariant->discount_percentage }}%</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($item->has_discount)
                            <div class="mt-4">
                                <span class="px-3 py-1 text-xs text-white bg-yellow-500 rounded">Discount Available</span>
                            </div>
                        @endif
                    </div>

                    {{-- --------------------------------------------------------------------------------- --}}
                    {{-- 2. Alpine.js Component Initialization (CRUCIAL: PHP variables are safely quoted) --}}
                    {{-- --------------------------------------------------------------------------------- --}}
                    <div x-data="variantSelector(
                            {{ $variantData->toJson() }},
                            '{{ $initialPrice }}',
                            {{ json_encode($packagingDetails) }},
                            '{{ $customerData }}',
                            '{{ $cartData }}'
                        )"
                         x-cloak
                         x-init="init()">

                        <div class="flex flex-col items-center w-full max-w-xs pb-4 mx-auto mt-6 space-y-4">
                            <!-- THE BUTTON TO OPEN THE MODAL -->
                            <button @click="showModal = true"
                                    class="w-full py-3 text-lg text-white transition duration-150 bg-indigo-600 rounded-lg hover:bg-indigo-700 sm:w-auto">
                                Add to Cart
                            </button>

                            <button
                                    class="w-full py-3 text-lg text-indigo-600 transition duration-150 border border-indigo-600 rounded-lg hover:bg-indigo-50 sm:w-auto">Buy Now</button>
                        </div>


                        {{-- --------------------------------------------------------------------------------- --}}
                        {{-- 3. BOTTOM SHEET MODAL (This must be inside the x-data scope) --}}
                        {{-- --------------------------------------------------------------------------------- --}}

                        {{-- Overlay --}}
                        <div x-show="showModal"
                             class="fixed inset-0 z-40 bg-black/40"
                             @click="showModal = false"
                             x-transition.opacity></div>

                        {{-- Bottom Sheet Modal Content --}}
                        <div x-show="showModal"
                             x-transition
                             class="fixed bottom-0 left-0 right-0 z-[51] max-h-[90vh] overflow-y-auto rounded-t-2xl bg-white p-4 md:mx-auto md:max-w-md md:rounded-xl shadow-2xl">

                            <!-- Close Button -->
                            <div class="flex justify-end">
                                <button @click="showModal = false"
                                        class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
                            </div>

                            <!-- Product Preview & Price -->
                            <div class="flex items-center gap-4 pb-4 mb-4 border-b">
                                {{-- Image Block --}}
                                <div class="flex-shrink-0 w-24 h-24 cursor-pointer">
                                    <img :src="selectedImg && selectedImg !== '/img/default.jpg' ? '/storage/' + selectedImg : 'https://placehold.co/96x96/dddddd/333333?text=No+Image'"
                                         class="object-cover w-full h-full rounded-lg shadow-md"
                                         alt="Variant Preview"
                                         onerror="this.src='https://placehold.co/96x96/dddddd/333333?text=No+Image'" />
                                </div>

                                {{-- Price/Stock Info --}}
                                <div>
                                    <span class="text-2xl font-bold text-red-500">฿<span x-text="formattedPrice"></span></span>
                                    <div class="text-sm text-gray-500"
                                         x-show="selectedStock !== null">
                                        In Stock: <span x-text="selectedStock"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Color Selector -->
                            <div class="mb-4">
                                <div class="mb-2 text-sm font-semibold">COLOR</div>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="(color, index) in colors"
                                              :key="index">
                                        <button type="button"
                                                @click="if (!color.disabled) { selectedColor = color; }"
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
                                    <template x-for="size in item.sizes"
                                              :key="size">
                                        <button type="button"
                                                @click="if (availableSizes.includes(size)) { selectedSize = size; }"
                                                class="px-4 py-2 text-sm transition-colors duration-200 border rounded-full"
                                                :class="{
                                                    'bg-gray-100 text-gray-400 cursor-not-allowed opacity-80': !availableSizes.includes(size),
                                                    'bg-black text-white border-black': selectedSize === size && availableSizes.includes(size),
                                                    'hover:bg-gray-200': availableSizes.includes(size) && selectedSize !== size
                                                }"
                                                x-text="size">
                                        </button>
                                    </template>
                                </div>
                            </div>


                            <!-- Packaging Selector -->
                            <div class="mb-6">
                                <div class="mb-2 text-sm font-semibold">Packaging</div>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="(option, index) in availablePackaging"
                                              :key="index">
                                        <button type="button"
                                                @click="if (!option.disabled) { selectedPackaging = option; }"
                                                class="p-2 text-sm transition-colors duration-200 border rounded-lg"
                                                :class="{
                                                    'bg-gray-100 text-gray-400 cursor-not-allowed opacity-80': option.disabled,
                                                    'bg-black text-white border-black': selectedPackaging?.name === option.name && !option.disabled,
                                                    'hover:bg-gray-200': !option.disabled && selectedPackaging?.name !== option.name
                                                }">
                                            <span x-text="option.name"></span>
                                            <span x-show="option.quantity > 1"
                                                  class="ml-1 text-xs text-gray-500">
                                                (<span x-text="option.quantity"></span> pcs)
                                            </span>
                                        </button>
                                    </template>
                                </div>

                                <p class="mt-2 text-sm text-gray-500" x-show="selectedPricePerPiece">
                                    Price per piece: ฿<span x-text="selectedPricePerPiece"></span>
                                </p>
                            </div>

                            <!-- Quantity Input and Final Action Button -->
                            <div class="pt-4 mt-8 border-t">
                                <div class="flex items-center justify-between mb-4">
                                    <label class="block text-lg font-bold text-gray-700">Total Quantity</label>
                                    <input type="number" min="1" x-model.number="quantity"
                                           class="w-20 p-2 text-center border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <button @click="addToCart()"
                                    :disabled="!selectedVariant || quantity < 1"
                                    class="w-full py-3 mt-2 font-semibold text-white transition duration-150 bg-red-600 shadow-lg rounded-xl hover:bg-red-700 disabled:bg-gray-300">
                                    Add <span x-text="quantity"></span> <span x-text="selectedVariant ? selectedVariant.color + ' ' + selectedVariant.size : 'Item'"></span> to Cart
                                </button>
                            </div>

                        </div>
                        {{-- --------------------------------------------------------------------------------- --}}
                        {{-- 3. END OF BOTTOM SHEET MODAL CONTENT --}}
                        {{-- --------------------------------------------------------------------------------- --}}

                    </div>
                </div>
            </div>
@endsection

<script>
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
</script>

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
