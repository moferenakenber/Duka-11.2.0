@php
    $render_color = function ($variant) {
        $colorName = $variant->itemColor->name ?? '—';
        $hexCode = $variant->itemColor->hex_code ?? null;
        $bgColor = '#cccccc';

        if (!empty($hexCode)) {
            $bgColor = str_starts_with($hexCode, '#') ? $hexCode : '#' . $hexCode;
        } elseif (!empty($colorName) && $colorName !== '—') {
            $bgColor = $colorName;
        }

        if ($colorName === '—') return '—';

        return '<div class="flex items-center gap-2">
                    <div class="w-3 h-3 border border-gray-300 rounded-full shadow-sm" style="background-color: ' . htmlspecialchars($bgColor) . ';"></div>
                    <span>' . htmlspecialchars($colorName) . '</span>
                </div>';
    };

            $getStatusBadgeClass = fn($status) => match ($status) {
                'active' => 'bg-green-600',
                'inactive' => 'bg-gray-500',
                'out_of_stock' => 'bg-yellow-500',
                'unavailable' => 'bg-red-600',
                default => 'bg-gray-400',
            };
@endphp

@php
function renderPackagingMobile($variant) {
    if (!$variant->itemPackagingType) return '—';

    $pack = $variant->itemPackagingType;

    // Get the correct pivot for this variant's packaging type
    $pivot = $variant->item->packagingTypes->firstWhere('id', $pack->id)->pivot ?? null;
    $qty = $pivot->quantity ?? 1;

    // Total pieces using your existing function
    $totalPieces = $variant->calculateTotalPieces();

    switch (strtolower($pack->name)) {
        case 'piece':
            return "Piece ($qty pcs)";
        case 'packet':
            return "Packet ($qty pcs)";
        case 'cartoon':
            return "Cartoon ($qty pkt) ($totalPieces pcs)";
        default:
            return $pack->name . " ($qty pcs)";
    }
}
@endphp


<div class="space-y-2 md:hidden">
    @forelse($variants as $variant)
        @php
            // Images
            $images = is_array($variant->images) ? $variant->images : json_decode($variant->images, true) ?? [];

            // Price ladder (copy to local var to avoid PHP error)
            $priceLadder = $variant->price_ladder ?? [];
            $lastPrice = !empty($priceLadder) ? end($priceLadder) : null;

            // Status badge
            $statusClass = $getStatusBadgeClass($variant->status);
            $storeVariant = $variant->storeVariants->firstWhere('store_id', $store->id);
            $displayPrice = $storeVariant->price ?? $variant->price; // fallback if store variant not found
        @endphp

        <div class="p-4 border shadow-lg card card-compact bg-base-100 border-base-200 rounded-xl">

            {{-- Header: image + color + size --}}
            <div class="flex items-start justify-between pb-3 mb-3 border-b border-base-200">
                <div class="flex flex-1 gap-3">
                    {{-- Image --}}
                    <div class="flex-shrink-0 w-12 h-12 overflow-hidden border rounded-lg shadow-sm border-base-300">
                        @if(count($images))
                            <img src="{{ asset($images[0]) }}" alt="Variant Image" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-xs bg-base-200 text-base-content/60">No Img</div>
                        @endif
                    </div>

                    {{-- Color & Size --}}
                    <div class="flex flex-col justify-center min-w-0">
                        <p class="text-sm font-bold leading-tight truncate text-primary">
                            <span class="mr-1 text-base-content/50">#{{ $loop->iteration }}</span>
                            {!! $render_color($variant) !!}
                        </p>
                    </div>
                </div>

                {{-- Status --}}
                @php
                    $isForced = $variant->manual_status === 'forced';

                    $label = $isForced ? 'FORCED' : 'AUTOMATIC';

                    $value = $isForced
                        ? ($variant->forced_status ?? 'inactive')
                        : $variant->status;
                @endphp

                    <div class="flex flex-col items-center mt-2 text-center">
                        {{-- Label --}}
                        <div class="text-xs text-gray-500">
                            {{ $label }}
                        </div>

                        {{-- Value --}}
                        <span class="badge text-xs text-white {{ $getStatusBadgeClass($value) }}">
                            {{ strtoupper(str_replace('_', ' ', $value)) }}
                        </span>
                    </div>


            </div>

            {{-- Attributes: Packaging + Size + Price + Discount --}}
            <div class="grid items-start grid-cols-4 text-xs gap-x-4">



                <div class="min-w-0 col-span-2">
                    <span class="block font-medium text-base-content/60">Packaging</span>
                    <span class="block font-bold truncate whitespace-nowrap">
                        {!! renderPackagingMobile($variant) !!}
                    </span>
                </div>

                @if($variant->itemSize)
                <div>
                    <span class="block font-medium text-base-content/60">Size</span>
                    <span class="font-bold whitespace-nowrap">{{ $variant->itemSize->name }}</span>
                </div>
                @endif
                <div class="min-w-0 col-span-1">
                    <span class="block font-medium text-base-content/60">Price</span>
                    <span class="font-bold text-success whitespace-nowrap">
                        ${{ number_format($displayPrice, 2) }}
                    </span>
                </div>

                <div class="min-w-0 col-span-1">
                    <span class="block font-medium text-base-content/60">Discount</span>
                    <span class="font-bold text-warning whitespace-nowrap">
                        {{ !empty($lastPrice['discount_price']) ? '$' . number_format($lastPrice['discount_price'], 2) : '—' }}
                    </span>
                </div>


            </div>

            <div class="flex justify-end pt-2 border-t border-base-100">
                    <a href="{{ route('admin.stores.items.variants.edit', [$store->id, $variant->item_id, $variant->id]) }}"
                        class="btn btn-primary btn-sm">
                            Edit
                        </a>
            </div>

        </div>
    @empty
        <div class="py-6 text-center border shadow-lg text-base-content/60 border-base-200 rounded-xl bg-base-100">
            No variants found
        </div>
    @endforelse
</div>
