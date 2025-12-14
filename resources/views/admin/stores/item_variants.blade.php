<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Variants of {{ $item->product_name }} in {{ $store->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Item card --}}
            @include('admin.stores._item_card', ['item' => $item, 'store' => $store])

            {{-- Flash / Messages --}}
            @include('admin.stores._messages')

            {{-- Mobile cards --}}
            @include('admin.stores._cards', ['variants' => $variants])

            {{-- Desktop table --}}
            @include('admin.stores._table', ['variants' => $variants])

        </div>
    </div>

    {{-- Alpine.js / Scripts --}}
    @include('admin.stores._scripts')
</x-app-layout>
