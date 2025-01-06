<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Items') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('admin.items.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Item') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

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
