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
                // default item price (fallback)
                $displayPrice = $item->variants->min('price') ?? ($item->price ?? 0);
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
                            @if ($minStoreVariant)
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



                {{-- @if ($minStoreVariant)
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

                            // Tap price to show seller price
                            tapCount: 0,
                            priceMode: 'normal', // normal or seller


                            selectedPricePerUnit: null,
                            selectedPricePerPiece: null,
                            selectedPricePerPacket: null,

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

                            // updatePrice() {
                            //     const match = this.variants.find(
                            //         (v) =>
                            //         v.color === this.selectedColor.name &&
                            //         v.size === this.selectedSize &&
                            //         v.packaging === this.selectedPackaging?.name
                            //     );

                            //     this.selectedPrice = match ? match.price : null;
                            //     this.selectedStock = match ? match.stock : null;

                            //     if (match && this.selectedPackaging) {
                            //         // Ensure quantity comes from the matched variant
                            //         this.selectedPackaging.quantity = match.quantity ?? 1;
                            //     }
                            // },

                            priceTapCount: 0,
                            priceTapped() {
                                this.priceTapCount++;

                                if (this.priceTapCount >= 3) {
                                    this.priceMode = (this.priceMode === 'normal') ? 'seller' : 'normal';
                                    this.priceTapCount = 0;
                                    this.updatePrice();
                                }
                            },


                            calculatePerUnitPrice() {
                                const qty = Number(this.selectedPackaging?.quantity || 0);
                                const price = Number(this.selectedPrice || 0);

                                if (!this.selectedPackaging || qty <= 0 || price <= 0) {
                                    return {
                                        perPiece: null,
                                        perPacket: null
                                    };
                                }

                                const packagingName = (this.selectedPackaging.name || '').toLowerCase();

                                const isCartoon = packagingName.includes('cartoon');

                                const perPiece = (price / qty).toFixed(2);

                                return {
                                    perPiece,
                                    perPacket: isCartoon ? price.toFixed(2) : null
                                };
                            },




                            updatePrice() {
                                const match = this.variants.find(
                                    (v) =>
                                        v.color === this.selectedColor.name &&
                                        v.size === this.selectedSize &&
                                        v.packaging === this.selectedPackaging?.name
                                );

                                // if no match, clear
                                if (!match) {
                                    this.selectedPrice = null;
                                    this.selectedStock = null;
                                    this.selectedPricePerPiece = null;
                                    this.selectedPricePerPacket = null;
                                    return;
                                }

                                // Normal mode price
                                if (this.priceMode === 'normal') {
                                    this.selectedPrice = match.discount_price ?? match.price;
                                }

                                // Seller mode price
                                if (this.priceMode === 'seller') {
                                    this.selectedPrice = match.seller_discount_price ?? match.seller_price ?? match.price;
                                }

                                this.selectedStock = match.stock;

                                // update packaging quantity
                                if (match && this.selectedPackaging) {
                                    this.selectedPackaging.quantity = match.quantity ?? 1;
                                }

                                // THIS IS THE KEY
                                const perUnit = this.calculatePerUnitPrice();
                                this.selectedPricePerPiece = perUnit?.perPiece ?? null;
                                this.selectedPricePerPacket = perUnit?.perPacket ?? null;
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

                priceMode: 'normal',
                priceTapCount: 0,






                item: {
                    price: {{ $minStoreVariant ? number_format($minStoreVariant->discount_price ?? $minStoreVariant->price, 0) : 0 }},

                    stock: [
                        @foreach ($variantData as $variant)
                            {{ $variant['stock'] }}@if (!$loop->last),@endif
                        @endforeach
                    ],

                    sizes: [
                        @foreach ($variantData->unique('size') as $variant)
                            {{ $variant['size'] }}
                        @endforeach
                    ],

                    packaging_details: [
                        @php $seen = []; @endphp

                        @foreach ($variantData as $variant)
                            @php
                                $pkgName = $variant['packaging'];
                            @endphp

                            @if ($pkgName && !in_array($pkgName, $seen))
                                @php $seen[] = $pkgName; @endphp

                                {
                                    name: '{{ $pkgName }}',
                                    quantity: {{ $variant['packaging_quantity'] ?? 0 }},
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



                {{-- get selectedPricePerPiece() {
                    if (this.selectedPrice && this.selectedPackaging?.quantity) {
                        return (this.selectedPrice / this.selectedPackaging.quantity).toFixed(2);
                    }
                    return '';
                } --}}


            }" x-cloak>
                <div class="flex flex-col items-center w-full max-w-xs pb-4 mx-auto mt-6 space-y-4">
                    <button @click="showModal = true; init()" class="w-full py-3 text-lg btn btn-info btn-active sm:w-auto">
                        Add to Cart
                    </button>

                    <button class="w-full py-3 text-lg btn btn-info btn-active sm:w-auto">Buy Now</button>
                </div>


                {{-- 👇 nothing modal-related here anymore --}}
                @include('seller.items.partials.variant-bottom-sheet')

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
