@php
    $has_size = $variants->contains(fn($variant) => $variant->itemSize);

    $get_missing_size_text = fn($value) => $value ?? 'Has no size';

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
                    <div class="w-3 h-3 border border-gray-300 rounded-full shadow-sm" style="background-color: ' .
                    htmlspecialchars($bgColor) .
                    ';"></div>
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


    $filters = [
        'all' => ['label' => 'All', 'color' => 'bg-orange-500 text-white'],
        'active' => ['label' => 'Active', 'color' => 'bg-green-600 text-white'],
        'inactive' => ['label' => 'Inactive', 'color' => 'bg-gray-500 text-white'],
    ];

   $currentFilter = request('filter', 'all');

$filteredVariants = match ($currentFilter) {
    'active' => $variants->filter(fn($v) => $v->status === 'active'),
    'inactive' => $variants->filter(fn($v) => $v->status === 'inactive'),
    default => $variants,
};


    $sortField = request('sort', 'id');
    $sortDirection = request('direction', 'asc');

    $packagingOrder = ['piece', 'packet', 'cartoon'];

    $sortedVariants = $filteredVariants->sort(function($a, $b) use ($sortField, $sortDirection, $packagingOrder) {
        switch ($sortField) {
            case 'color':
                $valA = strtolower($a->itemColor->name ?? '');
                $valB = strtolower($b->itemColor->name ?? '');
                break;
            case 'size':
                $valA = strtolower($a->itemSize->name ?? '');
                $valB = strtolower($b->itemSize->name ?? '');
                break;
            case 'packaging':
                $valA = strtolower($a->itemPackagingType->name ?? '');
                $valB = strtolower($b->itemPackagingType->name ?? '');
                $posA = array_search($valA, $packagingOrder);
                $posB = array_search($valB, $packagingOrder);
                $valA = $posA !== false ? $posA : 999;
                $valB = $posB !== false ? $posB : 999;
                break;
            case 'price':
                $valA = $a->price ?? 0;
                $valB = $b->price ?? 0;
                break;
            default:
                $valA = $a->id;
                $valB = $b->id;
        }
        return ($sortDirection === 'asc') ? (($valA < $valB) ? -1 : 1) : (($valA > $valB) ? -1 : 1);
    });
@endphp

@php
function renderPackagingHierarchy($variant) {
    if (!$variant->itemPackagingType) return '—';

    $pack = $variant->itemPackagingType;

    // Look for the pivot record for this item and this packaging type
    $pivot = $variant->item->packagingTypes->firstWhere('id', $pack->id)->pivot ?? null;
    $qty = $pivot->quantity ?? 1;

    // Total pieces
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




@php
$hasColor = $variants->contains(fn($v) => $v->itemColor);
$hasSize = $variants->contains(fn($v) => $v->itemSize);
$hasPackaging = $variants->contains(fn($v) => $v->itemPackagingType);

$sortField = request('sort', 'id');
$sortDirection = request('direction', 'asc');
$packagingOrder = ['piece', 'packet', 'cartoon'];
@endphp




<div class="hidden overflow-x-auto shadow-xl md:block rounded-xl bg-base-100">

    <div class="flex flex-wrap gap-2 mb-4">
    @foreach ($filters as $key => $data)
        <a href="{{ request()->fullUrlWithQuery(['filter' => $key]) }}"
           class="rounded-full px-3 py-1 text-sm font-medium transition
                  {{ $currentFilter === $key ? $data['color'] : 'bg-gray-200 text-gray-700' }}
                  hover:opacity-90">
            {{ $data['label'] }}
        </a>
    @endforeach
</div>

    <table class="table w-full table-sm">
<thead>
<tr class="bg-base-200">
    <th>#</th>
    <th>Image</th>

    @if($hasColor)
        <th>
            <a href="{{ request()->fullUrlWithQuery([
                'sort' => 'color',
                'direction' => $sortField === 'color' && $sortDirection === 'asc' ? 'desc' : 'asc'
            ]) }}">
                Color
                @if($sortField === 'color') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
            </a>
        </th>
    @endif

    @if($hasSize)
        <th>
            <a href="{{ request()->fullUrlWithQuery([
                'sort' => 'size',
                'direction' => $sortField === 'size' && $sortDirection === 'asc' ? 'desc' : 'asc'
            ]) }}">
                Size
                @if($sortField === 'size') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
            </a>
        </th>
    @endif

    @if($hasPackaging)
        <th>
            <a href="{{ request()->fullUrlWithQuery([
                'sort' => 'packaging',
                'direction' => $sortField === 'packaging' && $sortDirection === 'asc' ? 'desc' : 'asc'
            ]) }}">
                Packaging
                @if($sortField === 'packaging') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
            </a>
        </th>
    @endif

    <th>
        <a href="{{ request()->fullUrlWithQuery([
            'sort' => 'price',
            'direction' => $sortField === 'price' && $sortDirection === 'asc' ? 'desc' : 'asc'
        ]) }}">
            Price
            @if($sortField === 'price') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
        </a>
    </th>

    <th>Discount</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>

        <tbody>
            @forelse($sortedVariants as $variant)

            @php
                $images = is_array($variant->images) ? $variant->images : json_decode($variant->images, true) ?? [];

                // Copy price_ladder into a local variable
                $priceLadder = $variant->price_ladder ?? [];
                $lastPrice = !empty($priceLadder) ? end($priceLadder) : null;
            @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    {{-- Image --}}
                    {{-- Image --}}
                    <td>
                        @if (!empty($variant->images))
                            <img
                                src="{{ asset($variant->images[0]) }}"
                                class="object-cover w-8 h-8 rounded"
                                alt="Variant Image"
                            >
                        @else
                            —
                        @endif
                    </td>

                    {{-- Color --}}
                    <td>{!! $render_color($variant) !!}</td>

                    {{-- Size --}}
                    @if ($has_size)
                        <td>{{ $get_missing_size_text($variant->itemSize->name ?? null) }}</td>
                    @endif

                    {{-- Packaging --}}
                    {{-- <td>{{ $variant->itemPackagingType->name ?? '—' }}</td> --}}
                    {{-- Packaging --}}
                    <td class="text-xs">
                        {!! renderPackagingHierarchy($variant) !!}
                    </td>


                    {{-- Store Price / Final Price --}}
                    <td class="font-bold text-success">
                        ${{ number_format($lastPrice['price'] ?? 0, 2) }}
                    </td>

                    {{-- Discount Price --}}
                    <td class="font-bold text-warning">
                        {{ !empty($lastPrice['discount_price']) ? '$' . number_format($lastPrice['discount_price'], 2) : '—' }}
                    </td>

                    {{-- Status --}}
@php
    $isForced = $variant->manual_status === 'forced';

    $label = $isForced ? 'FORCED' : 'AUTOMATIC';

    $value = $isForced
        ? ($variant->forced_status ?? 'inactive')
        : $variant->status;
@endphp

<td>
    <div class="flex flex-col items-center text-center">
        {{-- Label --}}
        <div class="text-xs text-gray-500">
            {{ $label }}
        </div>

        {{-- Value --}}
        <span class="badge text-white text-xs {{ $getStatusBadgeClass($value) }}">
            {{ strtoupper(str_replace('_', ' ', $value)) }}
        </span>
    </div>
</td>




                    {{-- <td>
                    @if($variant->store_active)
                        <span class="text-white badge bg-success">Active</span>
                    @else
                        <span class="text-white bg-gray-500 badge">Inactive</span>
                        @if(!empty($variant->price_ladder))
                            <span class="ml-1 badge bg-warning">Priced</span>
                        @endif
                    @endif
                    </td> --}}

                    {{-- Actions --}}
                    <td>
                        <a href="{{ route('admin.stores.items.variants.edit', [$store->id, $variant->item_id, $variant->id]) }}"
                        class="btn btn-primary btn-sm">
                            Edit
                        </a>


                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $has_size ? 9 : 8 }}" class="text-center">No variants found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
