<div class="w-full mb-6 overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-lg card rounded-3xl hover:shadow-xl">
    <div class="p-5 card-body sm:p-6">

        {{-- TOP SECTION: Header --}}
        <div class="flex flex-col items-start justify-between gap-2 sm:flex-row">

            {{-- Left: Image & Text --}}
            <div class="flex flex-1 gap-4">
                {{-- Image --}}
                <div class="avatar">
                    <div class="w-20 h-20 overflow-hidden shadow-sm sm:w-24 sm:h-24 rounded-2xl ring-1 ring-gray-100">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                             alt="{{ $item->product_name }}"
                             class="object-cover w-full h-full" />
                    </div>
                </div>

                {{-- Text Details --}}
                <div class="flex flex-col justify-center">
                    <h2 class="text-lg font-bold leading-tight text-gray-800 sm:text-xl">
                        {{ $item->product_name }}
                    </h2>

                    {{-- Store-specific Price --}}
                    <div class="mt-1">
                        <span class="text-2xl font-extrabold text-emerald-600">
                            ${{ number_format($item->store_price ?? $item->price, 2) }}
                        </span>
                    </div>

                    {{-- Store Status --}}
                    @if(isset($item->pivot))
                        <div class="mt-1">
                            <span class="px-2 py-1 text-sm font-semibold text-white rounded-lg bg-{{ $item->pivot->active ? 'green' : 'red' }}-500">
                                {{ $item->pivot->active ? 'Active in Store' : 'Inactive in Store' }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Variant Badge (Mobile: Top, Desktop: Right) --}}
            <div class="flex self-start justify-end order-first w-full sm:self-center sm:order-last sm:w-auto">
                <div class="gap-2 p-4 font-bold badge badge-primary badge-outline badge-lg rounded-xl">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                    Variants: {{ $variants->count() }}
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
