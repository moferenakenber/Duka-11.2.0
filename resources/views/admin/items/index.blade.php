<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Items') }}
            </h2>
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

    @if (session('success'))
        <div x-data="{ showToast: true }" x-show="showToast" x-transition
            class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg right-5 top-5" x-init="setTimeout(() => (showToast = false), 3000)">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <div class="mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">

            <!-- Filters -->
            @php
                $filters = [
                    'all' => 'All',
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'unavailable' => 'Unavailable',
                    'draft' => 'Draft',
                ];
                $currentFilter = request('filter', 'all');
            @endphp
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($filters as $key => $label)
                    <a href="{{ route('admin.items.index', array_merge(request()->except('page'), ['filter' => $key])) }}"
                        class="{{ $currentFilter === $key ? 'bg-orange-500 text-white' : 'bg-gray-200 dark:bg-gray-700 dark:text-gray-200 text-gray-700' }} rounded-full px-3 py-1 text-sm font-medium transition hover:bg-orange-400">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            @php
                $filteredItems = match ($currentFilter) {
                    'active' => $items->where('status', 'active'),
                    'inactive' => $items->where('status', 'inactive'),
                    'unavailable' => $items->where('status', 'unavailable'),
                    'draft' => $items->where('status', 'draft'),
                    default => $items,
                };

                $sort = request('sort', 'name');
                $direction = request('direction', 'asc');

                if ($sort === 'name') {
                    $filteredItems =
                        $direction === 'asc'
                            ? $filteredItems->sortBy('product_name')
                            : $filteredItems->sortByDesc('product_name');
                } elseif ($sort === 'status') {
                    $filteredItems =
                        $direction === 'asc' ? $filteredItems->sortBy('status') : $filteredItems->sortByDesc('status');
                }
            @endphp

            <!-- Items Table -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-sm font-medium text-left text-gray-900">
                                    @php $newDirection = $direction === 'asc' ? 'desc' : 'asc'; @endphp
                                    <a href="{{ route('admin.items.index', array_merge(request()->except('page'), ['sort' => 'name', 'direction' => $sort === 'name' ? $newDirection : 'asc'])) }}"
                                        class="flex items-center space-x-1">
                                        <span>Name</span>
                                        @if ($sort === 'name')
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                @if ($direction === 'asc')
                                                    <path d="M5 10l5-5 5 5H5z" />
                                                @else
                                                    <path d="M5 10l5 5 5-5H5z" />
                                                @endif
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-4 py-2 text-sm font-medium text-left text-gray-900">
                                    <a href="{{ route('admin.items.index', array_merge(request()->except('page'), ['sort' => 'status', 'direction' => $sort === 'status' ? $newDirection : 'asc'])) }}"
                                        class="flex items-center space-x-1">
                                        <span>Status</span>
                                        @if ($sort === 'status')
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                @if ($direction === 'asc')
                                                    <path d="M5 10l5-5 5 5H5z" />
                                                @else
                                                    <path d="M5 10l5 5 5-5H5z" />
                                                @endif
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-4 py-2 text-sm font-medium text-left text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($filteredItems as $item)
                                <tr class="dark:hover:bg-gray-700 hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $item->product_name }}</td>
                                    <td
                                        class="{{ $item->status === 'active' ? 'bg-green-100' : ($item->status === 'inactive' ? 'bg-gray-100' : 'bg-yellow-100') }} rounded-sm px-4 py-2 text-sm font-medium text-gray-800">
                                        {{ ucfirst($item->status) }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <a href="{{ route('admin.items.show', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-800">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
