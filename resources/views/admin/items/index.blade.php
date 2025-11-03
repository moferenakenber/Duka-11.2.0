<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Items') }}
      </h2>
      <a
        href="{{ route('admin.items.create') }}"
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
      >
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
    <div
      x-data="{ showToast: true }"
      x-show="showToast"
      x-transition
      class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg top-5 right-5"
      x-init="setTimeout(() => (showToast = false), 3000)"
    >
      {{ session('success') }}
    </div>
  @endif

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      @php
        $activeItems = $items->where('status', 'active');
        $otherItems = $items->where('status', '!=', 'active');
      @endphp

      <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
          <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Name</th>
                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Min Price - Max Price</th>
                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Status</th>
                <th class="px-6 py-2 text-sm font-medium text-left text-gray-900">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <!-- Active Items Section -->
              @if ($activeItems->isNotEmpty())
                <tr class="font-semibold bg-gray-200">
                  <td colspan="4" class="px-6 py-2">Active Items</td>
                </tr>
                @foreach ($activeItems as $item)
                  @php
                    $prices = $item->variants->isNotEmpty()
                      ? $item->variants->map(fn ($v) => $v->discount_price ?? $v->price)
                      : collect([0]);
                    $minPrice = $prices->min();
                    $maxPrice = $prices->max();
                  @endphp

                  <tr>
                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->product_name }}</td>
                    <td class="px-6 py-2 text-sm text-gray-800">{{ $minPrice }} - {{ $maxPrice }}</td>
                    <td class="px-6 py-2 text-sm font-medium text-gray-800 bg-green-100 rounded-sm">
                      {{ ucfirst($item->status) }}
                    </td>
                    <td class="flex items-center px-6 py-2 space-x-4 text-sm text-gray-800">
                      <a href="{{ route('admin.items.show', $item->id) }}" class="text-green-600 hover:text-green-800">
                        View
                      </a>
                      <a href="{{ route('admin.items.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                        Edit
                      </a>
                      <form
                        action="{{ route('admin.items.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure?');"
                      >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif

              <!-- Spacer Row -->
              @if ($activeItems->isNotEmpty() && $otherItems->isNotEmpty())
                <tr class="h-4">
                  <td colspan="4"></td>
                </tr>
              @endif

              <!-- Pending / Inactive Items Section -->
              @if ($otherItems->isNotEmpty())
                <tr class="font-semibold bg-gray-200">
                  <td colspan="4" class="px-6 py-2">Pending or Inactive Items</td>
                </tr>
                @foreach ($otherItems as $item)
                  @php
                    $prices = $item->variants->isNotEmpty()
                      ? $item->variants->map(fn ($v) => $v->discount_price ?? $v->price)
                      : collect([0]);
                    $minPrice = $prices->min();
                    $maxPrice = $prices->max();
                  @endphp

                  <tr>
                    <td class="px-6 py-2 text-sm text-gray-800">{{ $item->product_name }}</td>
                    <td class="px-6 py-2 text-sm text-gray-800">{{ $minPrice }} - {{ $maxPrice }}</td>
                    <td class="px-6 py-2 text-sm font-medium text-gray-800 bg-gray-100 rounded-sm">
                      {{ ucfirst($item->status) }}
                    </td>
                    <td class="flex items-center px-6 py-2 space-x-4 text-sm text-gray-800">
                      <a href="{{ route('admin.items.show', $item->id) }}" class="text-green-600 hover:text-green-800">
                        View
                      </a>
                      <a href="{{ route('admin.items.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                        Edit
                      </a>
                      <form
                        action="{{ route('admin.items.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure?');"
                      >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
