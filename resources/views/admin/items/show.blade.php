<x-app-layout>
    <x-slot name="header">
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
    </x-slot>

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
                        <div class="flex flex-col items-center gap-2">
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
                        </div>

                        {{-- Right: Info --}}
                        <div class="flex flex-col flex-1 gap-3">
                            {{-- Product Name & Description --}}
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $item->product_name }}</h2>
                            <p class="text-gray-600 dark:text-gray-300 line-clamp-3">{{ $item->product_description }}</p>

                            {{-- Packaging Details --}}
                            @if ($item->packaging_details)
                                <p class="mt-1 text-sm italic text-gray-500 dark:text-gray-400">Packaging:
                                    {{ $item->packaging_details }}</p>
                            @endif

                            {{-- SKU --}}
                            @if ($item->sku)
                                <p class="text-sm text-gray-500 dark:text-gray-400">SKU: <span
                                        class="font-medium">{{ $item->sku }}</span></p>
                            @endif

                            {{-- Owner --}}
                            @if ($item->owner)
                                <p class="text-sm text-gray-500 dark:text-gray-400">Owner: <span
                                        class="font-medium">{{ $item->owner->name }}</span></p>
                            @endif

                            {{-- Categories --}}
                            <h3 class="mt-4 font-semibold text-gray-700">Categories</h3>
                            <div class="flex flex-wrap gap-1">
                                @foreach ($item->categories as $cat)
                                    <span
                                        class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">{{ $cat->category_name }}</span>
                                @endforeach
                            </div>

                        {{-- Colors --}}
            <h3 class="mt-4 font-semibold text-gray-700">Colors</h3>
            <div class="flex flex-wrap gap-4 mt-2">
                @if (!empty($item->colors) && $item->colors->count())
                    @foreach ($item->colors as $color)
                        @php
        // Logic to fix missing '#' or fallback to name
        $bgColor = '#cccccc';
        if (!empty($color->hex_code)) {
            $bgColor = str_starts_with($color->hex_code, '#')
                ? $color->hex_code
                : '#' . $color->hex_code;
        } elseif (!empty($color->name)) {
            $bgColor = $color->name;
        }
                        @endphp

                        <div class="flex flex-col items-center gap-1">
                            {{-- Color Circle --}}
                            <div class="w-8 h-8 border border-gray-200 rounded-full shadow-sm"
                                style="background-color: {{ $bgColor }};">
                            </div>

                            {{-- Color Name --}}
                            <span class="text-xs font-medium text-gray-600">{{ $color->name }}</span>
                        </div>
                    @endforeach
                @else
                    <span class="text-xs italic text-gray-500">No colors available</span>
                @endif
            </div>

                        {{-- Sizes --}}
                        <h3 class="mt-4 font-semibold text-gray-700">Sizes</h3>
                        <div class="flex flex-wrap gap-1 mt-1">
                            @if (!empty($item->sizes) && $item->sizes->count())
                                @foreach ($item->sizes as $size)
                                    <span class="px-2 py-1 text-xs bg-gray-200 rounded-full">{{ $size->name }}</span>
                                @endforeach
                            @else
                                <span class="px-2 py-1 text-xs italic text-gray-500">No sizes available</span>
                            @endif
                        </div>


                        {{-- Packaging Types Display --}}
                    {{-- Packaging Types Display --}}
                    @if (!empty($item->packagingTypes) && $item->packagingTypes->count() > 0)
                        <h3 class="mt-4 font-semibold text-gray-700">Packaging Hierarchy</h3>

                        {{-- 'flex-col' stacks them, 'items-start' keeps them compact width --}}
                        <div class="flex flex-col items-start gap-2 mt-1">

                            @php
                                $runningTotal = 1;
                                $previousName = 'pcs';
                            @endphp

                            @foreach ($item->packagingTypes as $index => $pack)
                                @php
                                    $currentQty = $pack->pivot->quantity ?? 1;

                                    // Logic: Calculate totals
                                    if ($index === 0) {
                                        $absTotal = 1;
                                    } else {
                                        $absTotal = $currentQty * $runningTotal;
                                    }

                                    // Logic: Create display string based on specific tier requirements
                                    if ($index === 0) {
                                        // Piece: 1 pcs
                                        $displayText = "1 pcs";
                                    } elseif ($index === 1) {
                                        // Packet: 50 pcs (Shows absolute total only)
                                        $displayText = number_format($absTotal) . " pcs";
                                    } else {
                                        // Carton (Index 2+): 20 Packets (1,000 pcs)
                                        $displayText = "{$currentQty} {$previousName}s (" . number_format($absTotal) . " pcs)";
                                    }
                                @endphp

                                {{-- Badge Structure (Stacked, Compact, Purple) --}}
                                <div
                                     class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-white bg-purple-500 rounded-full shadow-sm">
                                    <span class="font-bold tracking-wide">{{ $pack->name }}:</span>
                                    <span class="ml-1 text-purple-50">{{ $displayText }}</span>
                                </div>

                                @php
                                    // Update trackers for the next loop iteration
                                    $runningTotal = $absTotal;
                                    $previousName = $pack->name;
                                @endphp
                            @endforeach
                        </div>
                    @endif

                            {{-- Status --}}
                            <h3 class="mt-4 font-semibold text-gray-700">Status</h3>
                            <span
                                class="{{ $item->status == 'active' ? 'bg-green-500 text-white' : ($item->status == 'inactive' ? 'bg-gray-400 text-white' : 'bg-yellow-500 text-white') }} inline-block w-16 rounded-full px-2 py-1 text-center text-xs font-semibold">
                                {{ ucfirst($item->status) }}
                            </span>

                            {{-- Variants --}}
                            <h3 class="mt-4 font-semibold text-gray-700">Variants</h3>
                            <div class="flex items-center gap-4 mt-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $item->variants->count() }} variant{{ $item->variants->count() !== 1 ? 's' : '' }}
                                </span>
                                <a href="{{ route('admin.variants.index', $item->id) }}" class="btn btn-primary btn-sm">
                                    Manage Variants
                                </a>
                            </div>

                            {{-- Update Status --}}
                            <h3 class="mt-4 font-semibold text-gray-700">Update Status</h3>
                            <div class="mt-1">
                                <form action="{{ route('admin.items.updateStatus', $item->id) }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                        class="w-full px-3 py-2 text-sm rounded-md select select-bordered sm:w-auto">
                                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                        <option value="unavailable" {{ $item->status == 'unavailable' ? 'selected' : '' }}>
                                            Unavailable</option>
                                        <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>

                                    <button class="btn btn-success btn-sm">Update</button>
                                </form>
                            </div>

                            {{-- Created / Updated --}}
                            <div class="flex gap-4 mt-4 text-xs text-gray-400">
                                <p>Created: {{ $item->created_at->format('d M, Y') }}</p>
                                <p>Updated: {{ $item->updated_at->format('d M, Y') }}</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
