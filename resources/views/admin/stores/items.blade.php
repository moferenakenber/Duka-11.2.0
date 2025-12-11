<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Items in {{ $store->name }}
            </h2>
            <a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-outline">Back to Stores</a>
        </div>
    </x-slot>

    <div class="mt-4 overflow-x-auto">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>
<a href="{{ route('admin.stores.items.variants', ['store' => $store->id, 'item' => $item->id]) }}" class="btn btn-sm btn-primary">
    View Variants
</a>



                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No items in this store</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
