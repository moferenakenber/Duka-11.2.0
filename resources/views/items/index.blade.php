<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Items List</h3>
                    <a href="{{ route('items.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add New Item</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-2 text-left text-sm font-medium text-gray-900">Name</th>
                                <th class="px-6 py-2 text-left text-sm font-medium text-gray-900">Price</th>
                                <th class="px-6 py-2 text-left text-sm font-medium text-gray-900">Stock</th>
                                <th class="px-6 py-2 text-left text-sm font-medium text-gray-900">Status</th>
                                <th class="px-6 py-2 text-left text-sm font-medium text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->name }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->price }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->stock }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800">{{ ucfirst($item->status) }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-800 flex items-center space-x-4">
                                        <a href="{{ route('items.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>

                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
