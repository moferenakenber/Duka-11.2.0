<x-app-layout>

    <x-slot name="header">
        @include('admin.items.partials.header', ['item' => $item])
    </x-slot>

    {{-- <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Item Details') }}
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.items.edit', $item->id) }}"
                    class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Edit
                </a>
                <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot> --}}

@if ($errors->any())
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)"

        class="p-4 mt-4 text-red-700 bg-red-100 border-l-4 border-red-500"
        >
        <h3 class="font-semibold">There were some problems with your input:</h3>
        <ul class="pl-5 mt-2 list-disc">
            @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)"
         class="p-4 mt-4 text-green-700 bg-green-100 border-l-4 border-green-500">
        {{ session('success') }}
    </div>
@endif



    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Main Card --}}
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="p-6 space-y-6">

                    @php
                        $images = collect(json_decode($item->product_images, true) ?? []);
                        $images = $images->map(fn($img) => asset($img));
                        $mainImage = $images->first() ?? asset('images/default.jpg');
                        $otherImages = $images->slice(1);
                    @endphp

                    {{-- Product Info --}}
                    <div class="flex flex-col gap-6 md:flex-row">
                        {{-- Left: Images --}}
                        {{-- <div class="flex flex-col items-center gap-2">
                            <div class="w-48 h-48 overflow-hidden shadow-md rounded-xl">
                                <img src="{{ $mainImage }}" alt="{{ $item->product_name }}" class="object-cover w-full h-full">
                            </div>

                            @if ($otherImages->count())
                                <div class="flex gap-2 mt-2 overflow-x-auto">
                                    @foreach ($otherImages as $img)
                                        <div class="flex-shrink-0 w-12 h-12 overflow-hidden rounded-lg shadow-sm">
                                            <img src="{{ $img }}" alt="{{ $item->product_name }}"
                                                class="object-cover w-full h-full">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div> --}}

                        {{-- Right: Info --}}
                        <div class="flex flex-col flex-1 gap-3">
                            {{-- Product Name & Description --}}


                            @include('admin.items.partials.item_card', ['item' => $item])


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
