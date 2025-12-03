{{-- resources/views/admin/variants/_item_card.blade.php --}}
<div
    class="w-full mb-6 overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-lg card rounded-3xl hover:shadow-xl">
    <div class="p-5 card-body sm:p-6">

        {{-- TOP SECTION: Header --}}
        <div class="flex flex-col items-start justify-between gap-2 sm:flex-row">

            {{-- Left: Image & Text --}}
            <div class="flex flex-1 gap-4">
                {{-- Image --}}
                <div class="avatar">
                    <div class="w-20 h-20 overflow-hidden shadow-sm rounded-2xl ring-1 ring-gray-100 sm:h-24 sm:w-24">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                            alt="{{ $item->product_name }}" class="object-cover w-full h-full" />
                    </div>
                </div>

                {{-- Text Details --}}
                <div class="flex flex-col justify-center">
                    <h2 class="text-lg font-bold leading-tight text-gray-800 sm:text-xl">
                        {{ $item->product_name }}
                    </h2>

                    {{-- Price --}}
                    <div class="mt-1">
                        <span class="text-2xl font-extrabold text-emerald-600">
                            ${{ number_format($item->price, 2) }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        {{-- MIDDLE SECTION: Description & Attributes Grid --}}
        {{-- We use a grid here so the Description can span full width but look like the cards below --}}
        <div class="grid grid-cols-1 gap-4 mt-5 md:grid-cols-2 lg:grid-cols-3">



            {{-- SKU --}}
            @if ($item->sku)
                <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                    <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">SKU</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">{{ $item->sku }}</span>
                    </p>
                </div>
            @endif

            {{-- Categories --}}
            @if ($item->category)
                <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                    <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Categories</h3>
                    <div class="flex flex-wrap gap-1 mt-1">
                        @if ($item->category->parent)
                            <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">
                                {{ $item->category->parent->category_name }}
                            </span>
                        @endif
                        <span class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">
                            {{ $item->category->category_name }}
                        </span>
                    </div>
                </div>
            @endif

            {{-- 1. DESCRIPTION CARD (Full Width) --}}
            <div class="relative p-4 bg-white border border-gray-200 col-span-full rounded-2xl">
                <div class="flex items-center gap-2 mb-2 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                    <i data-lucide="file-text" class="h-3.5 w-3.5"></i> Description
                </div>

                {{-- Toggle Logic: Uses a hidden checkbox and Tailwind 'peer' modifier --}}
                <input type="checkbox" id="desc-expand-{{ $item->id }}" class="hidden peer" />

                <div
                    class="text-sm leading-relaxed text-gray-600 transition-all duration-300 line-clamp-2 peer-checked:line-clamp-none">
                    {{ $item->product_description }}
                </div>

                {{-- Labels act as the buttons --}}
                <div class="flex justify-end mt-2">
                    <label for="desc-expand-{{ $item->id }}"
                        class="text-xs font-bold cursor-pointer text-primary hover:underline peer-checked:hidden">
                        Read more
                    </label>
                    <label for="desc-expand-{{ $item->id }}"
                        class="hidden text-xs font-bold text-gray-400 cursor-pointer hover:text-gray-600 peer-checked:block">
                        Show less
                    </label>
                </div>
            </div>

            {{-- 2. ATTRIBUTES (Colors, Sizes, Packaging) --}}

            {{-- Colors Box --}}
            @if ($item->colors->count())
                <div
                    class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl hover:border-blue-200">
                    <h3 class="flex items-center gap-2 mt-0 text-xs font-semibold tracking-wide text-gray-700 uppercase">
                        <i data-lucide="palette" class="h-3.5 w-3.5 text-blue-500"></i> Colors
                    </h3>

                    <div class="flex flex-wrap gap-4 mt-2">
                        @foreach ($item->colors as $color)
                            @php
                                // Logic to fix missing '#' or fallback to name
                                $bgColor = '#cccccc';
                                if (!empty($color->hex_code)) {
                                    $bgColor = str_starts_with($color->hex_code, '#') ? $color->hex_code : '#' . $color->hex_code;
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
                    </div>
                </div>
            @endif


            {{-- Sizes Box --}}
            @if ($item->sizes->count())
                <div
                    class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl hover:border-indigo-200">
                    <div class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                        <i data-lucide="ruler" class="h-3.5 w-3.5 text-indigo-500"></i> Sizes
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->sizes as $size)
                            <span
                                class="p-3 font-medium text-indigo-700 border-indigo-100 rounded-lg badge badge-ghost bg-indigo-50">
                                {{ $size->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Packaging Box --}}
            @if ($item->packagingTypes->count())
                <div
                    class="relative flex flex-col h-full p-4 transition-colors bg-white border border-gray-200 rounded-2xl hover:border-purple-200 md:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                        <i data-lucide="package" class="h-3.5 w-3.5 text-purple-500"></i> Packaging
                    </div>
                    <div class="flex flex-col gap-2">
                        @php
                            $runningTotal = 1;
                            $previousName = 'pcs';
                        @endphp
                        @foreach ($item->packagingTypes as $index => $pack)
                            @php
                                $currentQty = $pack->pivot->quantity ?? 1;
                                $absTotal = $currentQty * $runningTotal;
                                $displayText =
                                    $index === 0
                                        ? "{$currentQty} pcs"
                                        : "{$currentQty} {$previousName}s = " . number_format($absTotal) . ' pcs';
                                $runningTotal = $absTotal;
                                $previousName = $pack->name;
                            @endphp
                            <div
                                class="flex items-center justify-between px-3 py-2 text-xs text-purple-900 border border-purple-100 rounded-lg bg-purple-50">
                                <span class="font-bold">{{ $pack->name }}</span>
                                <span>{{ $displayText }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif



        </div>
        {{-- Additional Details --}}
        <div class="grid grid-cols-1 gap-4 mt-5 md:grid-cols-2 lg:grid-cols-3">

            {{-- Packaging Details --}}
            @if ($item->packaging_details)
                <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                    <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Packaging Details</h3>
                    <p class="mt-1 text-sm italic text-gray-500 dark:text-gray-400">
                        {{ $item->packaging_details }}
                    </p>
                </div>
            @endif


            {{-- Owner --}}
            @if ($item->owner)
                <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                    <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Owner</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">{{ $item->owner->name }}</span>
                    </p>
                </div>
            @endif



            {{-- Status --}}
            <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Status</h3>
                <span
                    class="{{ $item->status == 'active' ? 'bg-green-500 text-white' : ($item->status == 'inactive' ? 'bg-gray-400 text-white' : 'bg-yellow-500 text-white') }} mt-1 inline-block w-16 rounded-full px-2 py-1 text-center text-xs font-semibold">
                    {{ ucfirst($item->status) }}
                </span>
            </div>

            {{-- Variants --}}
            <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Variants</h3>
                <div class="flex items-center gap-4 mt-1">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ $item->variants->count() }} variant{{ $item->variants->count() !== 1 ? 's' : '' }}
                    </span>
                    <a href="{{ route('admin.variants.index', $item->id) }}" class="btn btn-primary btn-sm">
                        Manage Variants
                    </a>
                </div>
            </div>

            {{-- Update Status Form --}}
            <div class="p-4 bg-white border border-gray-200 rounded-2xl">
                <h3 class="text-xs font-semibold tracking-wide text-gray-700 uppercase">Update Status</h3>
                <form action="{{ route('admin.items.updateStatus', $item->id) }}" method="POST"
                    class="flex items-center gap-2 mt-1">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full px-3 py-2 text-sm rounded-md select select-bordered sm:w-auto">
                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="unavailable" {{ $item->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                        <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    <button class="btn btn-success btn-sm">Update</button>
                </form>
            </div>

            {{-- Created / Updated --}}
            <div class="p-4 bg-white border border-gray-200 col-span-full rounded-2xl">
                <div class="flex flex-wrap gap-4 text-xs text-gray-400">
                    <p>Created: {{ $item->created_at->format('d M, Y') }}</p>
                    <p>Updated: {{ $item->updated_at->format('d M, Y') }}</p>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
