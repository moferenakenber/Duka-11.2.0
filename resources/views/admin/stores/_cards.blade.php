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

    $getStatusBadgeClass = function ($status) {
        return match($status) {
            'active' => 'bg-success',
            'inactive' => 'bg-base-content/60',
            'unavailable' => 'bg-warning',
            'out_of_stock' => 'bg-error',
            default => 'bg-base-content/60',
        };
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
            $images = is_array($variant->images) ? $variant->images : json_decode($variant->images, true) ?? [];
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

                {{-- Status dropdown --}}
                <div class="flex flex-col items-end flex-shrink-0 gap-2">
                    <form method="POST" action="{{ route('admin.variants.updateStatus', $variant->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full inline-block {{ $getStatusBadgeClass($variant->status) }}"></span>
                            <select name="status"
                                    class="min-w-[140px] h-8 px-2 text-sm select select-bordered"
                                    onchange="this.form.submit()">
                                <option value="active" {{ $variant->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $variant->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="unavailable" {{ $variant->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="out_of_stock" {{ $variant->status === 'out_of_stock' ? 'selected' : '' }}>O/S</option>
                            </select>
                        </div>
                    </form>
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
                        ${{ number_format($variant->store_price ?? $variant->price, 2) }}
                    </span>
                </div>

                <div class="min-w-0 col-span-1">
                    <span class="block font-medium text-base-content/60">Discount</span>
                    <span class="font-bold text-warning whitespace-nowrap">
                        {{ ($variant->store_discount_price ?? 0) > 0 ? '$' . number_format($variant->store_discount_price, 2) : '—' }}
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
