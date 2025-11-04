<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="mt-4 border-l-4 border-red-500 bg-red-100 p-4 text-red-700">
            <h3 class="font-semibold">There were some problems with your input:</h3>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $variantData = $item->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'color' => $variant->itemColor?->name ?? 'N/A',
                'img' => $variant->itemColor?->image_path ? asset($variant->itemColor->image_path) : null,
                'size' => $variant->itemSize?->name ?? 'N/A',
                'packaging' => $variant->itemPackagingType?->name ?? 'N/A',
                'price' => $variant->price,
                'stock' => $variant->stock,
            ];
        });
    @endphp


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-white shadow-md">
                <div class="space-y-4 p-6">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($item)
                                    <tr class="bg-base-100 p-4 transition hover:bg-gray-50">
                                        <td>
                                            <div class="flex flex-col items-start gap-4 md:flex-row">

                                                <div class="flex flex-col items-center gap-2">
                                                    @php
                                                        $images = collect(json_decode($item->product_images, true) ?? []);
                                                        $images = $images->map(fn($img) => asset($img));
                                                        $mainImage = $images->first() ?? asset('images/default.jpg');
                                                        $otherImages = $images->slice(1);
                                                    @endphp

                                                    <div class="h-32 w-32 overflow-hidden rounded-xl shadow-md">
                                                        <img src="{{ $mainImage }}" alt="{{ $item->product_name }}"
                                                            class="h-full w-full object-cover">
                                                    </div>

                                                    @if (count($otherImages))
                                                        <div class="mt-1 flex gap-1 overflow-x-auto">
                                                            @foreach ($otherImages as $img)
                                                                <div
                                                                    class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg shadow-sm">
                                                                    <img src="{{ $img }}" alt="{{ $item->product_name }}"
                                                                        class="h-full w-full object-cover">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex flex-1 flex-col gap-2">
                                                    <div class="dark:text-gray-200 text-lg font-bold text-gray-800">
                                                        {{ $item->product_name }}
                                                    </div>

                                                    <div class="dark:text-gray-300 line-clamp-3 text-sm text-gray-600">
                                                        {{ $item->product_description }}
                                                    </div>

                                                    @if ($item->packaging_details)
                                                        <div class="dark:text-gray-400 text-sm italic text-gray-500">
                                                            Packaging: {{ $item->packaging_details }}
                                                        </div>
                                                    @endif

                                                    <div class="mt-1 flex flex-wrap gap-1">
                                                        @foreach ($item->categories as $cat)
                                                            <span
                                                                class="rounded-full bg-blue-500 px-2 py-1 text-xs text-white">{{ $cat->category_name }}</span>
                                                        @endforeach
                                                    </div>

                                                    <div class="mt-1">
                                                        <span
                                                            class="{{ $item->status == 'active' ? 'bg-green-500 text-white' : ($item->status == 'inactive' ? 'bg-gray-400 text-white' : 'bg-yellow-500 text-white') }} rounded-full px-2 py-1 text-xs font-semibold">
                                                            {{ ucfirst($item->status) }}
                                                        </span>
                                                    </div>

                                                    <form action="{{ route('admin.items.updateStatus', $item->id) }}"
                                                        method="POST" class="mt-2">
                                                        @csrf
                                                        @method('PATCH')

                                                        <label class="label"><span class="label-text">Change
                                                                Status</span></label>

                                                        <div class="flex items-center gap-2">
                                                            <select name="status" class="select select-bordered select-sm">
                                                                <option value="active"
                                                                    {{ $item->status == 'active' ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="inactive"
                                                                    {{ $item->status == 'inactive' ? 'selected' : '' }}>
                                                                    Inactive</option>
                                                                <option value="unavailable"
                                                                    {{ $item->status == 'unavailable' ? 'selected' : '' }}>
                                                                    Unavailable</option>
                                                                <option value="draft"
                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                    Draft</option>
                                                            </select>

                                                            <button class="btn btn-primary btn-sm">Update</button>
                                                        </div>
                                                    </form>

                                                    @if (!empty($item->colors))
                                                        <div class="mt-1 flex flex-wrap gap-1">
                                                            @foreach ($item->colors as $color)
                                                                <span class="rounded-full px-2 py-1 text-xs"
                                                                    style="background-color: {{ $color->hex_code ?? '#000' }};">
                                                                    {{ $color->name }}
                                                                </span>
                                                            @endforeach
                                                        </div>

                                                    @endif

                                                    @if (!empty($item->sizes))
                                                        <div class="mt-1 flex flex-wrap gap-1">
                                                            @foreach ($item->sizes as $size)
                                                                <span
                                                                    class="rounded-full bg-gray-200 px-2 py-1 text-xs">{{ $size->name }}</span>
                                                            @endforeach


                                                        </div>
                                                    @endif

                                                    @if (!empty($item->packaging))
                                                        <div class="mt-1 flex flex-wrap gap-1">
                                                            @foreach ($item->packagingTypes as $pack)
                                                                <span
                                                                    class="rounded-full bg-purple-500 px-2 py-1 text-xs text-white">{{ $pack->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="bg-base-200">
                                        <td colspan="6">
                                            <div class="overflow-x-auto">
                                                <table class="table table-xs">
                                                    <div class="mt-4 bg-base-200 p-2" x-data="variantForm()">
                                                        <div class="mb-4 flex items-center justify-between">
                                                            <h3 class="text-lg font-semibold">Add Variant</h3>
                                                            <button type="button" class="btn btn-outline btn-sm"
                                                                @click="variants.push({ item_color_id: '', item_size_id: '', item_packaging_type_id: '' })">
                                                                + Add Variant
                                                            </button>
                                                        </div>

                                                        <template x-for="(variant, index) in variants" :key="index">
                                                            <div
                                                                class="flex flex-wrap items-end gap-2 rounded-xl border bg-base-100 p-2">

                                                                <!-- Color -->
                                                                <div class="w-32"
                                                                    x-show="{{ $colors->isNotEmpty() ? 'true' : 'false' }}">
                                                                    <label class="label"><span
                                                                            class="label-text">Color</span></label>
                                                                    <select class="select select-bordered w-full"
                                                                        :name="'variants[' + index + '][item_color_id]'"
                                                                        x-model="variant.item_color_id">
                                                                        <option value="">-- Select Color --</option>
                                                                        @foreach ($colors as $color)
                                                                            <option value="{{ $color->id }}">
                                                                                {{ $color->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Size -->
                                                                <div class="w-32"
                                                                    x-show="{{ $sizes->isNotEmpty() ? 'true' : 'false' }}">
                                                                    <label class="label"><span
                                                                            class="label-text">Size</span></label>
                                                                    <select class="select select-bordered w-full"
                                                                        :name="'variants[' + index + '][item_size_id]'"
                                                                        x-model="variant.item_size_id">
                                                                        <option value="">-- Select Size --</option>
                                                                        @foreach ($sizes as $size)
                                                                            <option value="{{ $size->id }}">
                                                                                {{ $size->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Packaging -->
                                                                <div class="w-32"
                                                                    x-show="{{ $packagingTypes->isNotEmpty() ? 'true' : 'false' }}">
                                                                    <label class="label"><span
                                                                            class="label-text">Packaging</span></label>
                                                                    <select class="select select-bordered w-full"
                                                                        :name="'variants[' + index + '][item_packaging_type_id]'"
                                                                        x-model="variant.item_packaging_type_id">
                                                                        <option value="">-- Select Packaging --</option>
                                                                        @foreach ($packagingTypes as $pack)
                                                                            <option value="{{ $pack->id }}">
                                                                                {{ $pack->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Price -->
                                                                <div class="w-32">
                                                                    <label class="label"><span
                                                                            class="label-text">Price</span></label>
                                                                    <input type="number" step="0.01"
                                                                        class="input input-bordered w-full"
                                                                        :name="'variants[' + index + '][price]'"
                                                                        x-model="variant.price" />
                                                                </div>

                                                                <!-- Stock -->
                                                                <div class="w-24">
                                                                    <label class="label"><span
                                                                            class="label-text">Stock</span></label>
                                                                    <input type="number" class="input input-bordered w-full"
                                                                        :name="'variants[' + index + '][stock]'"
                                                                        x-model="variant.stock" />
                                                                </div>

                                                                <!-- Stock Location -->
                                                                <div class="w-32" x-show="variant.stock > 0">
                                                                    <label class="label"><span class="label-text">Stock
                                                                            Location</span></label>
                                                                    <select class="select select-bordered w-full"
                                                                        :name="'variants[' + index + '][inventory_location_id]'"
                                                                        x-model="variant.inventory_location_id">
                                                                        <option value="">-- Select Location --</option>
                                                                        @foreach ($inventoryLocations as $loc)
                                                                            <option value="{{ $loc->id }}">
                                                                                {{ $loc->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Barcode -->
                                                                <div class="w-48 md:w-32"> <!-- bigger width -->
                                                                    <label class="label"><span
                                                                            class="label-text">Barcode</span></label>
                                                                    <input type="text" name="barcode" id="barcodeInput"
                                                                        inputmode="numeric" pattern="[0-9]*"
                                                                        placeholder="Scan barcode"
                                                                        class="input input-bordered w-full">

                                                                    <div id="scanner" style="width:100%; margin-top:10px;">
                                                                    </div>
                                                                </div>






                                                                <!-- Image -->
                                                                <div class="w-32">
                                                                    <label class="label"><span
                                                                            class="label-text">Image</span></label>
                                                                    <input type="file"
                                                                        :name="'variants[' + index + '][image]'"
                                                                        @change="variant.image = $event.target.files[0]" />
                                                                </div>

                                                                <!-- Active -->
                                                                <div class="mt-2 flex w-24 items-center">
                                                                    <label class="label cursor-pointer">
                                                                        <span class="label-text mr-2">Active</span>
                                                                        <input type="checkbox" class="toggle toggle-sm"
                                                                            :name="'variants[' + index + '][is_active]'"
                                                                            x-model="variant.is_active" />
                                                                    </label>
                                                                </div>

                                                                <!-- Save & Remove buttons -->
                                                                <div class="flex items-center gap-2 pt-6">
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        @click="saveVariant(variant, index)">Save
                                                                        Variant</button>
                                                                    <button type="button" class="btn btn-error btn-sm"
                                                                        @click="variants.splice(index, 1)">✕</button>
                                                                </div>

                                                            </div>
                                                        </template>



                                                    </div>

                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" class="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Color</th>
                                                            <th>Size</th>
                                                            <th>Packaging</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Owner</th>
                                                            <th>Image</th>
                                                            <th>Bar Code</th>
                                                            <th>Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->variants as $index => $variant)
                                                            <tr>
                                                                <th><input type="checkbox" class="checkbox" /></th>
                                                                <th>{{ $index + 1 }}</th>
                                                                <td>{{ $variant->itemColor->name ?? '-' }}</td>
                                                                <td>{{ optional($variant->itemSize)->name ?? '-' }}</td>

                                                                <td>{{ $variant->itemPackagingType->name ?? '-' }}</td>
                                                                <td>${{ number_format($variant->price, 2) }}</td>
                                                                <td>{{ $variant->totalStock() }}</td>


                                                                <td>{{ $variant->owner->name ?? '-' }}</td>
                                                                <td>
                                                                    @if ($variant->image)
                                                                        <img src="{{ asset('storage/' . $variant->image) }}"
                                                                            class="h-6 w-6 rounded" />
                                                                    @elseif ($variant->itemColor && $variant->itemColor->image_path)
                                                                        <img src="{{ asset($variant->itemColor->image_path) }}"
                                                                            class="h-6 w-6 rounded" />
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        name="variants[{{ $index }}][barcode]"
                                                                        value="{{ $variant->barcode ?? '' }}"
                                                                        placeholder="Enter or scan barcode"
                                                                        class="form-control input input-sm input-bordered w-full">
                                                                </td>

                                                                <td>
                                                                    <span
                                                                        class="badge-{{ $variant->is_active ? 'success' : 'neutral' }} badge">
                                                                        {{ $variant->is_active ? 'Active' : 'Inactive' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.items.edit', $variant) }}"
                                                                        class="btn btn-outline btn-xs">Edit</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function variantForm() {
            return {
                variants: [],

                saveVariant(variant, index) {
                    let formData = new FormData();

                    // ✅ Laravel expects array: variants[0][...]
                    formData.append('variants[0][item_color_id]', variant.item_color_id || '');
                    formData.append('variants[0][item_size_id]', variant.item_size_id || '');
                    formData.append('variants[0][item_packaging_type_id]', variant.item_packaging_type_id || '');
                    formData.append('variants[0][price]', variant.price || 0);
                    formData.append('variants[0][discount_price]', variant.discount_price || 0);
                    formData.append('variants[0][inventory_location_id]', variant.inventory_location_id || '');
                    formData.append('variants[0][is_active]', variant.is_active ? 1 : 0);
                    formData.append('variants[0][barcode]', variant.barcode || '');


                    // ✅ Stock is NOT stored inside item_variants
                    formData.append('variants[0][stock]', variant.stock || 0);

                    // ✅ Image
                    if (variant.image) {
                        formData.append('variants[0][image]', variant.image);
                    }

                    axios.post("{{ route('admin.variants.store', $item->id) }}", formData, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        })
                        .then(res => {
                            alert("Variant saved!");
                            this.variants.splice(index, 1);
                            window.location.reload(); // refresh to display new variant
                        })
                        .catch(err => {
                            console.error(err);

                            if (err.response?.data?.errors) {
                                // ✅ Show validation errors
                                let message = Object.values(err.response.data.errors)
                                    .flat()
                                    .join("\n");
                                alert("Failed to save variant:\n" + message);
                            } else if (err.response?.data?.message) {
                                alert("Failed to save variant:\n" + err.response.data.message);
                            } else {
                                alert("Failed to save variant. Check console.");
                            }
                        });
                }
            }
        }
    </script>

    <script>
        function startScanner() {
            const html5QrCode = new Html5Qrcode("scanner");
            html5QrCode.start({
                    facingMode: "environment"
                }, // rear camera
                {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText, decodedResult) => {
                    // When a barcode is detected
                    document.getElementById("barcodeInput").value = decodedText;
                    html5QrCode.stop();
                },
                (errorMessage) => {
                    // optional: show scan errors
                    console.warn(errorMessage);
                }
            ).catch(err => {
                console.error(err);
            });
        }

        startScanner();
    </script>





</x-app-layout>
