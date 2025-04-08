@extends('seller.layouts.app')

@section('content')
    <!-- Product Variant Modal -->
    <div x-data="{
        showModal: true,
        selectedColor: null,
        selectedSize: null,
        quantity: 1,
        item: {
            price: 2590,
            stock: 200,
            colors: [
                { name: 'BONE', img: '/img/colors/bone.png', disabled: false },
                { name: 'WHITE', img: '/img/colors/white.png', disabled: false },
                { name: 'BLACK', img: '/img/colors/black.png', disabled: false },
                { name: 'PURPLE', img: '/img/colors/purple.png', disabled: false },
                { name: 'BUTTER CORN', img: '/img/colors/butter-corn.png', disabled: true },
                { name: 'QUARTZ', img: '/img/colors/quartz.png', disabled: false }
            ],
            sizes: [
                { value: 'W5', label: 'W5 21cm 34–35eu', disabled: false },
                { value: 'W6', label: 'W6 22cm 36–37eu', disabled: false },
                { value: 'W7', label: 'W7 23cm 37–38eu', disabled: false },
                { value: 'W8', label: 'W8 24cm 38–39eu', disabled: false },
                { value: 'W9', label: 'W9 25cm 39–40eu', disabled: false },
                { value: 'W10', label: 'W10 26cm 41–42eu', disabled: false }
            ]
        }
    }" x-show="showModal"
        class="fixed inset-0 z-50 bg-black/40 flex justify-center items-end md:items-center px-4">
        <div class="bg-white w-full max-w-md rounded-t-xl md:rounded-xl p-4">
            <!-- Product Preview -->
            <div class="flex items-center gap-4 mb-4">
                <img src="/img/product.jpg" alt="Product" class="w-20 h-20 rounded border object-cover">
                <div>
                    <div class="text-lg font-semibold text-red-500">฿<span x-text="item.price"></span></div>
                    <div class="text-sm text-gray-500">Stock: <span x-text="item.stock"></span></div>
                </div>
            </div>

            <!-- Color Selection -->
            <div class="mb-4">
                <div class="font-semibold text-sm mb-2">COLOR</div>
                <div class="flex flex-wrap gap-2">
                    <template x-for="(color, index) in item.colors" :key="index">
                        <button type="button" @click="!color.disabled && (selectedColor = color.name)"
                            class="flex flex-col items-center border rounded-md px-2 py-1 w-20 text-xs"
                            :class="{
                                'border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed': color.disabled,
                                'border-black bg-black text-white': selectedColor === color.name && !color.disabled
                            }">
                            <img :src="color.img" class="w-10 h-10 object-cover rounded mb-1" alt="">
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
                        <button type="button" @click="!size.disabled && (selectedSize = size.value)"
                            class="border rounded-md px-3 py-2 text-xs text-left"
                            :class="{
                                'bg-gray-100 text-gray-400 cursor-not-allowed': size.disabled,
                                'bg-black text-white': selectedSize === size.value && !size.disabled
                            }"
                            x-text="size.label"></button>
                    </template>
                </div>
            </div>

            <!-- Quantity Control -->
            <div class="mb-6">
                <div class="font-semibold text-sm mb-2">Quantity</div>
                <div class="flex items-center border w-max px-2 rounded">
                    <button type="button" class="text-lg px-2" @click="quantity = Math.max(1, quantity - 1)">–</button>
                    <input type="number" x-model="quantity" min="1"
                        class="w-12 text-center border-x outline-none" />
                    <button type="button" class="text-lg px-2" @click="quantity++">+</button>
                </div>
            </div>

            <!-- Add to Cart Button -->
            <button :disabled="!selectedColor || !selectedSize" class="w-full py-3 font-bold rounded text-white"
                :class="(!selectedColor || !selectedSize) ? 'bg-gray-400' : 'bg-red-500 hover:bg-red-600'">
                ADD TO CART
            </button>
        </div>
    </div>
@endsection
