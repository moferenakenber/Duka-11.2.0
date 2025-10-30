@extends('seller.layouts.app')

@section('content')


    <div class="flex flex-col items-center justify-center h-full pt-2 pb-16">
        <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl">

            <!-- Navbar -->
            <div class="w-full shadow-sm navbar bg-base-100">
                <div class="flex justify-between w-full">
                    <!-- Empty div to balance center -->
                    <div class="navbar-start"></div>
                    <div class="navbar-center">
                        <a class="text-xl btn btn-ghost">Home</a>
                    </div>
                    <div class="flex gap-2 navbar-end">
                        <button class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        <button class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="badge badge-xs badge-primary indicator-item"></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- <div class="flex flex-col w-full">

                <div class="divider"></div>

            </div> --}}

            <div class="flex justify-end p-2 px-4">
                <form method="GET" action="{{ route('seller.items.index') }}">
                    <label for="sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select name="sort" id="sort" class="px-2 py-1 ml-2 border rounded" onchange="this.form.submit()">
                        <option value="">Default</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to
                            Low</option>
                        <option value="sold_asc" {{ request('sort') == 'sold_asc' ? 'selected' : '' }}>Sold: Low to High
                        </option>
                        <option value="sold_desc" {{ request('sort') == 'sold_desc' ? 'selected' : '' }}>Sold: High to Low
                        </option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                    </select>
                </form>
            </div>



            <div class="grid grid-cols-2 gap-4 p-4 pt-2 pb-20 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @foreach ($items as $item)
                    <a href="{{ route('seller.items.show', $item->id) }}"
                        class="relative overflow-hidden transition-transform duration-300 transform bg-white border rounded-lg shadow-md hover:scale-105">

                        {{-- Discount Badge --}}
                        @if ($item->discount_percentage)
                            <div class="absolute px-2 py-1 text-xs font-bold text-white bg-red-500 rounded top-2 right-2">
                                -{{ $item->discount_percentage }}%
                            </div>
                        @endif

                        {{-- Product Image --}}

                        @if ($item && $item->product_images)
                            @php
                                $decodedImages = json_decode($item->product_images, true);
                            @endphp

                            @if (is_array($decodedImages) && !empty($decodedImages))
                                <img src="{{ $decodedImages[0] }}" alt="First Product Image">
                            @else
                                <p>No images available.</p>
                            @endif
                        @else
                            <p>Product images not found.</p>
                        @endif

                        {{-- <img src="https://picsum.photos/200/300" alt="No Image" class="object-cover w-full h-48"> --}}


                        {{-- Product Details --}}
                        <div class="p-3">
                            {{-- Product Name & New Badge --}}
                            <div class="flex items-center justify-between">
                                <h2 class="font-semibold">{{ $item->product_name }}</h2>
                                <div class="badge badge-secondary">NEW</div>
                            </div>

                            {{-- Price & Sold Count --}}
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-lg font-bold text-red-500">฿{{ number_format($item->price, 0) }}</span>
                                <span class="text-xs text-gray-500">{{ number_format($item->sold_count) }} sold</span>
                            </div>

                            {{-- Free Shipping & Discount Labels --}}
                            <div class="flex mt-2 space-x-1">
                                {{-- <span class="px-2 py-1 text-xs text-white bg-green-500 rounded">FREE Shipping</span> --}}
                                @if ($item->has_discount)
                                    <span class="px-2 py-1 text-xs text-white bg-yellow-500 rounded">Discount</span>
                                @endif
                            </div>

                            <div class="justify-end card-actions">
                                <div class="badge badge-outline">Office Supplies</div>
                                <div class="badge badge-outline">Products</div>
                            </div>
                        </div>

                    </a>

                @endforeach


            </div>
        </div>
    </div>

    <style>
        .fixed-image {
            width: 100%;
            /* Ensures image fills the card width */
            height: 300px;
            /* Set fixed height */
            object-fit: cover;
            /* Prevents distortion */
        }
    </style>
@endsection
