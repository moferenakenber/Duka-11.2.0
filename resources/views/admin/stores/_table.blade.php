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
        true, 'active' => 'bg-success',
        false, 'inactive' => 'bg-base-content/60',
        default => 'bg-base-content/60',
    };

    $filters = [
        'all' => ['label' => 'All', 'color' => 'bg-orange-500 text-white'],
        'active' => ['label' => 'Active', 'color' => 'bg-green-600 text-white'],
        'inactive' => ['label' => 'Inactive', 'color' => 'bg-gray-500 text-white'],
    ];

    $currentFilter = request('filter', 'all');

    $filteredVariants = match ($currentFilter) {
        'active' => $variants->where('store_active', true),
        'inactive' => $variants->where('store_active', false),
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
            default:
                $valA = $a->id;
                $valB = $b->id;
        }
        return ($sortDirection === 'asc') ? (($valA < $valB) ? -1 : 1) : (($valA > $valB) ? -1 : 1);
    });
@endphp

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

<div class="overflow-x-auto shadow-xl rounded-xl bg-base-100 md:block">
    <table class="table w-full table-sm">
        <thead>
            <tr class="bg-base-200">
                <th>#</th>
                <th>Image</th>
                <th>Color</th>
                @if($has_size)
                    <th>Size</th>
                @endif
                <th>Packaging</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sortedVariants as $variant)
                @php
                    $images = is_array($variant->images) ? $variant->images : json_decode($variant->images, true) ?? [];
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    {{-- Image --}}
                    <td>
                        @if (count($images))
                            <img src="{{ asset('storage/' . $images[0]) }}" class="object-cover w-8 h-8 rounded" alt="Variant Image">
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
                    <td>{{ $variant->itemPackagingType->name ?? '—' }}</td>

                    {{-- Store Price --}}
                    <td class="font-bold text-success">${{ number_format($variant->store_price ?? 0, 2) }}</td>

                    {{-- Store Discount --}}
                    <td class="font-bold text-warning">
                        {{ $variant->store_discount_price > 0 ? '$' . number_format($variant->store_discount_price, 2) : '—' }}
                    </td>

                    {{-- Store Active Status --}}
                    <td>
                        <span class="badge text-white {{ $variant->store_active ? 'bg-green-600' : 'bg-gray-500' }}">
                            {{ $variant->store_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

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
