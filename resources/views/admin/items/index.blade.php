<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Left side: Title -->
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Items') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('admin.items.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Add Item') }}
            </a>
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="p-4 mt-4 text-red-700 bg-red-100 border-l-4 border-red-500">
            <h3 class="font-semibold">There were some problems with your input:</h3>
            <ul class="pl-5 mt-2 list-disc">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Name</th>
                                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Price</th>
                                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Stock</th>
                                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Status</th>
                                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->product_name }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->price }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->stock }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ ucfirst($item->status) }}</td>
                                    <td class="flex items-center px-6 py-2 space-x-4 text-sm text-gray-800">

                                        <!-- View Button -->
                                        <a href="{{ route('admin.items.show', $item->id) }}"
                                            class="text-green-600 hover:text-green-800">View</a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.items.edit', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-800">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-x-auto">
    <table class="table table-sm">
        <thead>
            <tr>
                <th><input type="checkbox" class="checkbox" /></th>
                <th>Product</th>
                <th>Description</th>
                <th>Packaging</th>
                <th>Variation</th>
                <th>Price</th>
                <th>Status</th>
                <th>Incomplete</th>
                <th>Category ID</th>
                <th>Item Category ID</th>
                <th>Images</th>
                <th>Selected Categories</th>
                <th>New Categories</th>
                <th>Sold</th>
                <th>Discount</th>
                <th>Discount %</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td><input type="checkbox" class="checkbox" /></td>
                    <td class="font-bold">{{ $item->product_name }}</td>
                    <td>{{ Str::limit($item->product_description, 50) }}</td>
                    <td>
                        @php
                            $packaging = is_string($item->packaging_details)
                                ? json_decode($item->packaging_details, true)
                                : [];
                            $packagingText = collect($packaging)
                                ->map(fn($p) => "{$p['name']} ({$p['quantity']})")
                                ->take(3)
                                ->implode(', ');
                            $moreCount = count($packaging) - 3;
                        @endphp
                        <span class="text-sm">
                            {{ $packagingText }}
                            @if ($moreCount > 0)
                                <span class="text-gray-400">+{{ $moreCount }} more</span>
                            @endif
                        </span>
                    </td>
                    <td>{{ $item->variation }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td><span class="badge badge-{{ $item->status == 'active' ? 'success' : 'neutral' }}">{{ $item->status }}</span></td>
                    <td>{{ $item->incomplete ? 'Yes' : 'No' }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->item_category_id }}</td>
                    <td>
                        @php
                            $imgs = is_string($item->product_images) ? json_decode($item->product_images, true) : [];
                        @endphp
                        @if (count($imgs))
                            <img src="{{ asset($imgs[0]) }}" class="w-8 h-8 rounded" />
                            @if (count($imgs) > 1)
                                <span class="text-xs text-gray-400">+{{ count($imgs) - 1 }}</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $selected = is_string($item->selectedCategories) ? json_decode($item->selectedCategories, true) : [];
                        @endphp
                        {{ implode(', ', array_slice($selected, 0, 3)) }}
                        @if (count($selected) > 3)
                            <span class="text-xs text-gray-400">+{{ count($selected) - 3 }}</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $newCats = is_string($item->newCategoryNames) ? json_decode($item->newCategoryNames, true) : [];
                        @endphp
                        {{ implode(', ', array_slice($newCats, 0, 2)) }}
                        @if (count($newCats) > 2)
                            <span class="text-xs text-gray-400">+{{ count($newCats) - 2 }}</span>
                        @endif
                    </td>
                    <td>{{ $item->sold_count }}</td>
                    <td>${{ number_format($item->discount_price, 2) }}</td>
                    <td>{{ $item->discount_percentage }}%</td>
                    <td>
                        <a href="{{ route('admin.items.show', $item->id) }}" class="text-green-600 btn btn-xs btn-outline hover:text-green-800">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </div>
    </div>
    @if ($errors->any())
        <div class="mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
