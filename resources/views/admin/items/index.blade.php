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
                                    {{-- <td class="px-6 py-2 text-sm text-gray-800">{{ ucfirst($item->status) }}</td> --}}
                                    <td class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">{{ ucfirst($item->status) }}</td>
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
