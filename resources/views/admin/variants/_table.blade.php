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
    <table class="table w-full table-sm">
        <thead>
            <tr class="bg-base-200">
                <th>#</th>
                <th>Image</th>
                <th>Color</th>
                @if ($has_size)
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
            @forelse($variants as $variant)
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
                    <td>
                        <span class="whitespace-normal badge badge-primary badge-outline">
                            {{ $variant->itemPackagingType ? $variant->itemPackagingType->name . ' (' . $variant->calculateTotalPieces() . ' pcs)' : '—' }}
                        </span>
                    </td>

                    {{-- Price --}}
                    <td class="font-bold text-success">${{ number_format($variant->price, 2) }}</td>

                    {{-- Discount --}}
                    <td class="font-bold text-warning">
                        {{ $variant->discount_price > 0 ? '$' . number_format($variant->discount_price, 2) : '—' }}
                    </td>

                    {{-- Status --}}
                    <td>
                        <form method="POST" action="{{ route('admin.variants.updateStatus', $variant->id) }}"
                            class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <span class="{{ $getStatusBadgeClass($variant->status) }} inline-block h-2 w-2 rounded-full"></span>
                            <select name="status" class="select select-bordered select-sm" onchange="this.form.submit()">
                                <option value="active" {{ $variant->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $variant->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="unavailable" {{ $variant->status === 'unavailable' ? 'selected' : '' }}>
                                    Unavailable</option>
                                <option value="out_of_stock" {{ $variant->status === 'out_of_stock' ? 'selected' : '' }}>Out of
                                    Stock</option>
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
