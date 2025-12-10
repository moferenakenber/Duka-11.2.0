<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Items in {{ $store->name }}
            </h2>
            <a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-outline">Back to Stores</a>
        </div>
    </x-slot>

    <div class="overflow-x-auto mt-4">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Packaging</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($variants as $variant)
                    <tr>
                        <td>{{ $variant->id }}</td>
                        <td>{{ $variant->item->product_name }}</td>
                        <td>{{ $variant->itemColor->name ?? '—' }}</td>
                        <td>{{ $variant->itemSize->name ?? '—' }}</td>
                        <td>{{ $variant->itemPackagingType->name ?? '—' }}</td>
                        <td>{{ $variant->pivot->price ?? '—' }}</td>
                        <td>{{ $variant->pivot->discount_price ?? '—' }}</td>
                        <td>{{ $variant->pivot->stock ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
