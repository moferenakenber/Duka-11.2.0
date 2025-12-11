<x-app-layout>
    <x-slot name="header">
        <h2>Variants of {{ $item->product_name }} in {{ $store->name }}</h2>
    </x-slot>

    <div class="mt-4 overflow-x-auto">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Packaging</th>
                    <th>Total Stock</th>
                    <th>Price</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($variants as $variant)
                    <tr>
                        <td>{{ $variant->id }}</td>
                        <td>{{ $variant->itemColor->name ?? '-' }}</td>
                        <td>{{ $variant->itemSize->name ?? '-' }}</td>
                        <td>{{ $variant->itemPackagingType->name ?? '-' }}</td>
                        <td>
                            {{ $variant->stores->first()?->pivot->stock ?? 0 }}
                        </td>
                        <td>
                            {{ $variant->stores->first()?->pivot->price ?? '-' }}
                        </td>
                        <td>
                            {{ $variant->stores->first()?->pivot->active ? 'Active' : 'Inactive' }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No variants found for this item</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
