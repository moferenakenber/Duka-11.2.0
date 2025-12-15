@php
    // Check if any variant has a size
    $has_size = $variants->contains(fn($variant) => $variant->itemSize);

    // Helper for missing size text
    $get_missing_size_text = fn($value) => $value ?? 'Has no size';

    // Helper for color rendering
    $render_color = function ($variant) {
        $colorName = $variant->itemColor->name ?? '—';
        $hexCode = $variant->itemColor->hex_code ?? null;
        $bgColor = '#cccccc';

        if (!empty($hexCode)) {
            $bgColor = str_starts_with($hexCode, '#') ? $hexCode : '#' . $hexCode;
        } elseif (!empty($colorName) && $colorName !== '—') {
            $bgColor = $colorName;
        }

        if ($colorName === '—') {
            return '—';
        }

        return '<div class="flex items-center gap-2">
                    <div class="w-3 h-3 border border-gray-300 rounded-full shadow-sm" style="background-color: ' .
            htmlspecialchars($bgColor) .
            ';"></div>
                    <span>' .
            htmlspecialchars($colorName) .
            '</span>
                </div>';
    };

    // Status badge class
    $getStatusBadgeClass = function ($status) {
        return match ($status) {
            'active' => 'bg-success',
            'inactive' => 'bg-base-content/60',
            'unavailable' => 'bg-warning',
            'out_of_stock' => 'bg-error',
            default => 'bg-base-content/60',
        };
    };
@endphp

<div class="hidden overflow-x-auto shadow-xl rounded-xl bg-base-100 md:block">


@php
$filters = [
    'all' => ['label' => 'All', 'color' => 'bg-orange-500 text-white'],
    'active' => ['label' => 'Active', 'color' => 'bg-green-600 text-white'],
    'inactive' => ['label' => 'Inactive', 'color' => 'bg-gray-500 text-white'],
    'unavailable' => ['label' => 'Unavailable', 'color' => 'bg-yellow-600 text-white'],
    'out_of_stock' => ['label' => 'Out of Stock', 'color' => 'bg-red-600 text-white'],
];

$currentFilter = request('filter', 'all');
@endphp

<div class="flex flex-wrap gap-2 mb-4">
    @foreach ($filters as $key => $data)
        <a href="{{ request()->fullUrlWithQuery(['filter' => $key]) }}"
           class="rounded-full px-3 py-1 text-sm font-medium transition
                  {{ $currentFilter === $key ? $data['color'] : 'bg-gray-200 dark:bg-gray-700 dark:text-gray-200 text-gray-700' }}
                  hover:opacity-90">
            {{ $data['label'] }}
        </a>
    @endforeach
</div>

@php
$filteredVariants = match ($currentFilter) {
    'active' => $variants->where('status', 'active'),
    'inactive' => $variants->where('status', 'inactive'),
    'unavailable' => $variants->where('status', 'unavailable'),
    'out_of_stock' => $variants->where('status', 'out_of_stock'),
    default => $variants,
};
@endphp

@php
$packagingOrder = ['piece', 'packet', 'cartoon']; // desired order

$sortedVariants = $filteredVariants;

if (isset($sortField)) {
    if ($sortField === 'color') {
        $sortedVariants = $filteredVariants->sortBy(fn($v) => $v->itemColor->name ?? '');
    } elseif ($sortField === 'size') {
        $sortedVariants = $filteredVariants->sortBy(fn($v) => $v->itemSize->name ?? '');
    } elseif ($sortField === 'packaging') {
        $sortedVariants = $filteredVariants->sortBy(function($v) use ($packagingOrder) {
            $name = strtolower($v->itemPackagingType->name ?? '');
            $pos = array_search($name, $packagingOrder);
            return $pos !== false ? $pos : 999;
        });
    }
}
@endphp


@php
$sortField = request('sort', 'id');       // Default sorting by ID
$sortDirection = request('direction', 'asc'); // Default ascending

$packagingOrder = ['piece', 'packet', 'cartoon']; // custom order for packaging
@endphp

@php
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

    if ($valA == $valB) return 0;

    if ($sortDirection === 'asc') {
        return ($valA < $valB) ? -1 : 1;
    } else {
        return ($valA > $valB) ? -1 : 1;
    }
});
@endphp





    <table class="table w-full table-sm">


<thead>

<tr class="bg-base-200">
    <th>
        <a href="{{ request()->fullUrlWithQuery([
            'sort' => 'id',
            'direction' => $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc'
        ]) }}">
            #
            @if($sortField === 'id') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
        </a>
    </th>
    <th>Image</th>
    <th>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'color']) }}">
            Color
        </a>
    </th>
    @if($has_size)
        <th>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'size']) }}">
                Size
            </a>
        </th>
    @endif
    <th>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'packaging']) }}">
            Packaging
        </a>
    </th>
    <th>Price</th>
    <th>Discount</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>


        <tbody>

            @forelse($sortedVariants as $variant)

                <tr>
                    <td>{{ $loop->iteration }}</td>

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
                    {{-- <td>
                        <span class="block max-w-full overflow-hidden badge badge-primary badge-outline whitespace-nowrap text-ellipsis">
                            {{ $variant->itemPackagingType ? $variant->itemPackagingType->name . ' (' . $variant->calculateTotalPieces() . ' pcs)' : '—' }}
                        </span>
                    </td> --}}

<td>
    @if($variant->itemPackagingType)
        @php
            $packagingType = strtolower($variant->itemPackagingType->name); // normalize
            $icon = match($packagingType) {
                'piece' => 'dot',
                'packet' => 'grip-vertical',
                'cartoon' => 'box',
                default => 'box',
            };
        @endphp

        <div class="flex flex-col items-center p-2 text-center border rounded-lg">
            {{-- Icon --}}
            @if($icon === 'dot')
                <x-lucide-dot class="w-4 h-4 mb-1" />
            @elseif($icon === 'grip-vertical')
                <x-lucide-grip-vertical class="w-4 h-4 mb-1" />
            @elseif($icon === 'box')
                <x-lucide-box class="w-4 h-4 mb-1" />
            @else
                <x-lucide-box  class="w-4 h-4 mb-1" />
            @endif


            {{-- Packaging type --}}
            <span class="font-medium">{{ $variant->itemPackagingType->name }}</span>

            {{-- Piece count --}}
            <span class="text-xs text-gray-500">({{ $variant->calculateTotalPieces() }} pcs)</span>
        </div>
    @else
        —
    @endif
</td>




                    {{-- Price --}}
                    <td class="font-bold text-success">${{ number_format($variant->price, 2) }}</td>

                    {{-- Discount --}}
                    <td class="font-bold text-warning">
                        {{ $variant->discount_price > 0 ? '$' . number_format($variant->discount_price, 2) : '—' }}
                    </td>

                    {{-- Status --}}
{{-- Status --}}
{{-- <td>
    <form method="POST" action="{{ route('admin.variants.updateStatus', $variant->id) }}"
        class="flex items-center gap-2">
        @csrf
        @method('PUT')

        {{-- Status Badge
        <span class="badge text-white
            @if($variant->status === 'active') bg-green-600
            @elseif($variant->status === 'inactive') bg-gray-500
            @elseif($variant->status === 'unavailable') bg-yellow-600
            @elseif($variant->status === 'out_of_stock') bg-red-600
            @else bg-gray-500 @endif
        ">
            {{ ucfirst(str_replace('_', ' ', $variant->status)) }}
        </span>

        {{-- Dropdown
        <select name="status" class="select select-bordered select-sm"
                onchange="this.form.submit()">
            <option value="active" {{ $variant->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $variant->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="unavailable" {{ $variant->status === 'unavailable' ? 'selected' : '' }}>
                Unavailable
            </option>
            <option value="out_of_stock" {{ $variant->status === 'out_of_stock' ? 'selected' : '' }}>
                Out of Stock
            </option>
        </select>
    </form>
</td> --}}

{{-- Status Badge Column --}}
<td>
        {{-- Status Badge --}}
    <span class="badge text-white whitespace-nowrap
        @if($variant->status === 'active') bg-green-600
        @elseif($variant->status === 'inactive') bg-gray-500
        @elseif($variant->status === 'unavailable') bg-yellow-600
        @elseif($variant->status === 'out_of_stock') bg-red-600
        @else bg-gray-500 @endif
    ">
        {{ ucfirst(str_replace('_', ' ', $variant->status)) }}
    </span>

</td>

{{-- Dropdown Column --}}
<td class="relative">
        <form method="POST" action="{{ route('admin.variants.updateStatus', $variant->id) }}"
        class="flex items-center gap-2">
        @csrf
        @method('PUT')

        <select name="status"
                class="w-auto text-base select select-bordered"
                onchange="this.form.submit()">
            <option value="active" {{ $variant->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $variant->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="unavailable" {{ $variant->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            <option value="out_of_stock" {{ $variant->status === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
        </select>
         </form>
</td>


                    {{-- Actions --}}
                    <td>
                        <a href="{{ route('admin.variants.edit', $variant->id) }}" class="btn btn-primary btn-sm">
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
