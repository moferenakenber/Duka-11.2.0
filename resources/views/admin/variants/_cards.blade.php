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
            <div class="grid grid-cols-4 gap-2 text-xs">
                <div>
                    <span class="block font-medium text-base-content/60">Packaging</span>
                    <span class="font-bold whitespace-nowrap">
                        {{ $variant->itemPackagingType ? $variant->itemPackagingType->name . ' (' . $variant->calculateTotalPieces() . ' pcs)' : '—' }}
                    </span>
                </div>
                @if($variant->itemSize)
                <div>
                    <span class="block font-medium text-base-content/60">Size</span>
                    <span class="font-bold whitespace-nowrap">{{ $variant->itemSize->name }}</span>
                </div>
                @endif
                <div>
                    <span class="block font-medium text-base-content/60">Price</span>
                    <span class="font-bold text-success">${{ number_format($variant->price, 2) }}</span>
                </div>
                <div>
                    <span class="block font-medium text-base-content/60">Discount</span>
                    <span class="font-bold text-warning">
                        {{ $variant->discount_price > 0 ? '$' . number_format($variant->discount_price, 2) : '—' }}
                    </span>
                </div>
            </div>

            <div class="flex justify-end pt-2 border-t border-base-100">
                <a href="#" class="btn btn-primary btn-sm">Edit</a>
            </div>

        </div>
    @empty
        <div class="py-6 text-center border shadow-lg text-base-content/60 border-base-200 rounded-xl bg-base-100">
            No variants found
        </div>
    @endforelse
</div>
