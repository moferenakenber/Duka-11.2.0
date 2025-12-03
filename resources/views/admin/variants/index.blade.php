<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Item Variants') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Item card --}}
            @include('admin.variants._item_card', ['item' => $item])

            {{-- Flash / Messages --}}
            @include('admin.variants._messages')

            {{-- Add variant form --}}
            {{-- @include('admin.variants._add', ['item' => $item]) --}}

            {{-- Mobile cards --}}
            @include('admin.variants._cards', ['variants' => $item->variants])

            {{-- Desktop table --}}
            @include('admin.variants._table', ['variants' => $item->variants])

        </div>
    </div>


        {{-- Alpine.js / Scripts --}}
    @include('admin.variants._scripts')




</x-app-layout>
