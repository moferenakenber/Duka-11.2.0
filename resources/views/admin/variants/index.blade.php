<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Item Variants') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex items-start justify-between p-4 mb-6 bg-white shadow-md rounded-xl">
                <div class="flex flex-1 gap-4">
                    {{-- Item Image --}}
                    <div class="w-20 h-20 overflow-hidden rounded">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                            class="object-cover w-full h-full" alt="{{ $item->product_name }}">
                    </div>

                    {{-- Item Info --}}
                    <div class="flex-1">
                        {{-- Name --}}
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->product_name }}</h2>

                        {{-- Description --}}
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->product_description }}</p>

                        {{-- Price --}}
                        <div class="flex gap-2 mt-1">
                            <span class="px-2 py-1 text-xs text-white bg-blue-500 rounded-full">
                                Price: ${{ number_format($item->price, 2) }}
                            </span>
                        </div>

                        {{-- Colors --}}
                        @if ($item->colors->count())
                            <div class="mt-3">
                                <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">Colors</h3>
                                <div class="flex gap-2">
                                    @foreach ($item->colors as $color)
                                        <span class="w-6 h-6 border border-gray-300 rounded-full" title="{{ $color->name }}"
                                            style="background-color: {{ $color->name }}"></span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Sizes --}}
                        @if ($item->sizes->count())
                            <div class="mt-3">
                                <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">Sizes</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->sizes as $size)
                                        <span
                                            class="px-2 py-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full ring-1 ring-inset ring-indigo-200">
                                            {{ $size->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        {{-- Packaging --}}
                        @if ($item->packagingTypes->count())
                            <div class="mt-3">
                                <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">Packaging</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->packagingTypes as $pack)
                                        <span
                                            class="px-2 py-1 text-sm font-medium rounded bg-brand-softer text-fg-brand-strong ring-brand-subtle ring-1 ring-inset">
                                            {{ $pack->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Variant Count --}}
                <div class="flex items-center ml-4">
                    <span class="px-3 py-2 text-sm font-bold text-white bg-purple-500 rounded-full">
                        Variants: {{ $item->variants->count() }}
                    </span>
                </div>
            </div>


            {{-- Add Variant Form --}}
            <div class="p-4 mb-6 rounded-xl bg-base-200" x-data="variantForm()">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Add Variant</h3>
                    <button type="button" class="btn btn-outline btn-sm" @click="addVariant()">+ Add Variant</button>
                </div>

                <form method="POST" action="{{ route('admin.variants.store', $item->id) }}" enctype="multipart/form-data">
                    @csrf

                    <template x-for="(variant, index) in variants" :key="index">
                        <div class="flex flex-wrap items-end gap-2 p-2 mb-2 border rounded-xl bg-base-100">

                            {{-- Image uploader --}}
                            <div x-data="variantFileUpload({{ $loop->index ?? 0 }})" class="mb-2">
                                <label class="label">Variant Image</label>

                                <input type="file" :name="`variants[${index}][image][]`" multiple
                                    class="w-full file-input file-input-bordered" @change="uploadFiles($event)">

                                <div class="flex gap-2 mt-2">
                                    <template x-for="img in images" :key="img">
                                        <img :src="imageUrl(img)" class="w-16 h-16 border rounded">
                                    </template>
                                </div>

                                <template x-for="img in images" :key="img">
                                    <input type="hidden" :name="`variants[${index}][image_paths][]`" :value="img">
                                </template>

                                <div x-show="uploading" class="mt-2">
                                    <div class="w-full h-2 bg-gray-200 rounded">
                                        <div class="h-2 bg-blue-600 rounded" :style="'width: ' + progress + '%'"></div>
                                    </div>
                                    <p x-text="progress + '%'"></p>
                                </div>
                            </div>



                            {{-- Color --}}
                            @if ($item->colors->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Color</label>
                                    <select x-model="variant.item_color_id" :name="`variants[${index}][item_color_id]`"
                                        class="w-full h-12 input input-sm input-bordered">
                                        <option value="">Select Color</option>
                                        @foreach ($item->colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Size --}}
                            @if ($item->sizes->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Size</label>
                                    <select x-model="variant.item_size_id" :name="`variants[${index}][item_size_id]`"
                                        class="w-full h-12 input input-sm input-bordered">
                                        <option value="">Select Size</option>
                                        @foreach ($item->sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Packaging --}}
                            @if ($item->packagingTypes->isNotEmpty())
                                <div class="flex-1">
                                    <label class="block mb-1 text-xs font-semibold text-gray-600">Packaging</label>
                                    <select x-model="variant.item_packaging_type_id"
                                        :name="`variants[${index}][item_packaging_type_id]`"
                                        class="w-full h-12 input input-sm input-bordered" @change="updateCapacity(index, $event)">
                                        <option value="">Select Packaging</option>
                                        @foreach ($item->packagingTypes as $pack)
                                            <option value="{{ $pack->id }}" data-quantity="{{ $pack->quantity }}">
                                                {{ $pack->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span x-text="variant.capacityText" class="ml-2 text-sm text-gray-500"></span>

                                    {{-- Hidden input for total pieces --}}
                                    <input type="hidden" :name="`variants[${index}][total_pieces]`"
                                        :value="variant.totalPieces">
                                </div>
                            @endif

                            {{-- Barcode --}}
                            <div class="flex-1">
                                <label class="block mb-1 text-xs font-semibold text-gray-600">Barcode</label>
                                <input type="text" x-model="variant.barcode" :name="`variants[${index}][barcode]`"
                                    class="w-full h-12 input input-sm input-bordered" placeholder="Enter barcode">
                            </div>

                            {{-- Price --}}
                            <div class="flex-1">
                                <label class="block mb-1 text-xs font-semibold text-gray-600">Price</label>
                                <input type="number" x-model="variant.price" :name="`variants[${index}][price]`"
                                    class="w-full h-12 input input-sm input-bordered" placeholder="Price">
                            </div>

                            {{-- Remove button --}}
                            <div class="flex items-center gap-2 mt-2">
                                <button type="button" class="btn btn-error btn-sm"
                                    @click="variants.splice(index, 1)">Remove</button>
                            </div>

                            {{-- Save Variant button --}}
                            <div class="w-full mt-2">
                                <button type="submit" class="w-full btn btn-primary sm:w-auto">Save Variant</button>
                            </div>

                        </div>
                    </template>

                </form>


            </div>



            @if (session('success'))
                <div x-data="{ showToast: true }" x-show="showToast" x-transition
                    class="p-4 mb-4 text-green-700 bg-green-100 rounded" x-init="setTimeout(() => showToast = false, 3000)">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('error'))
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                    {{ session('error') }}
                </div>
            @endif


            {{-- Variant Table --}}
            <div class="overflow-x-auto rounded-xl bg-base-100">
                <table class="table w-full table-xs">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Packaging</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Barcode</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($variants as $variant)
                                                                                    <tr>
                                                                                        <td>{{ $loop->iteration }}</td>

                                                                                        {{-- Image --}}
                            @php
                                $images = [];

                                if (is_array($variant->images)) {
                                    $images = $variant->images;
                                } elseif (is_string($variant->images)) {
                                    $decoded = json_decode($variant->images, true);
                                    $images = $decoded ?: [];
                                }
                            @endphp

                            <td>
                                @if (count($images) > 0)
                                    <img src="{{ asset('storage/' . $images[0]) }}"
                                         class="object-cover w-8 h-8 rounded"
                                         alt="Variant Image">
                                @else
                                    —
                                @endif
                            </td>




                                                                                        <td>{{ $variant->itemColor->name ?? '—' }}</td>
                                                                                        <td>{{ $variant->itemSize->name ?? '—' }}</td>

                                                                                        <td>
                                                                                            @if ($variant->itemPackagingType)
                                                                                                {{ $variant->itemPackagingType->name }}
                                                                                                ({{ $variant->calculateTotalPieces() }} pcs)
                                                                                            @else
                                                                                                —
                                                                                            @endif
                                                                                        </td>

                                                                                        <td>{{ number_format($variant->price, 2) }}</td>
                                                                                        <td>{{ number_format($variant->discount_price, 2) }}</td>

                                                                                        {{-- Barcode --}}
                                                                                        <td>{{ $variant->barcode ?? '—' }}</td>

                                                                                        <td>{{ $variant->owner->name ?? '—' }}</td>

                                                                                        {{-- Status --}}
                                                                                        <td>
                                                                                            <form method="POST" action="{{ route('admin.variants.updateStatus', $variant->id) }}">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <select name="status"
                                                                                                    class="w-full px-2 py-1 text-sm leading-normal text-gray-800 border border-gray-300 rounded-md dark:text-gray-200"
                                                                                                    onchange="this.form.submit()">
                                                                                                    <option value="active" {{ $variant->status === 'active' ? 'selected' : '' }}>Active
                                                                                                    </option>
                                                                                                    <option value="inactive" {{ $variant->status === 'inactive' ? 'selected' : '' }}>
                                                                                                        Inactive</option>
                                                                                                    <option value="unavailable"
                                                                                                        {{ $variant->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                                                                    <option value="out_of_stock"
                                                                                                        {{ $variant->status === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                                                                                </select>

                                                                                            </form>
                                                                                        </td>

                                                                                        {{-- Edit button --}}
                                                                                        <td>
                                                                                            {{-- <a href="{{ route('admin.variants.edit', $variant->id) }}" --}}
                                                                                            <a href="#" class="btn btn-secondary btn-sm">
                                                                                                Edit
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No variants found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>

    {{-- <script>
        function variantForm() {
            return {
                variants: [],
                addVariant() {
                    this.variants.push({
                        item_color_id: '',
                        item_size_id: '',
                        item_packaging_type_id: '',
                        price: 0,
                        stock: 0,
                        capacityText: '', // <-- dynamic text for packaging quantity
                        is_active: true
                    });
                },
                updateCapacity(index, event) {
                    const quantity = event.target.selectedOptions[0].dataset.quantity;
                    this.variants[index].capacityText = quantity ? `(${quantity} pieces)` : '';
                }
            }
        }
    </script> --}}

    <script>
        function variantForm() {
            return {
                variants: [],
                addVariant() {
                    this.variants.push({
                        item_color_id: '',
                        item_size_id: '',
                        item_packaging_type_id: '',
                        price: 0,
                        // stock: 0, // remove if you no longer want it
                        capacityText: '',
                        packagingQuantity: 1,
                        totalPieces: 1,
                        is_active: true,
                        image: null, // NEW: for image file
                        barcode: '' // NEW: for barcode
                    });
                },
                updateCapacity(index, event) {
                    const selectedOption = event.target.selectedOptions[0];
                    const baseQty = parseInt(selectedOption.dataset.quantity) || 1;

                    this.variants[index].packagingQuantity = baseQty;
                    this.variants[index].totalPieces = baseQty;
                    this.variants[index].capacityText = `(${this.variants[index].totalPieces} pcs)`;
                },
                handleImageUpload(index, event) {
                    this.variants[index].image = event.target.files[0];
                }
            }
        }

        function variantFileUpload(variantIndex) {
            return {
                images: [],
                uploading: false,
                progress: 0,
                done: false,

                imageUrl(path) {
                    return "{{ asset('') }}" + path;
                },

                uploadFiles(event) {
                    this.uploading = true;
                    this.done = false;
                    this.progress = 0;

                    let formData = new FormData();
                    let files = event.target.files;

                    for (let i = 0; i < files.length; i++) {
                        formData.append('variant_images[]', files[i]);
                    }

                    axios.post("{{ route('admin.variants.uploadImages') }}", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onUploadProgress: (e) => {
                                if (e.lengthComputable) {
                                    this.progress = Math.round((e.loaded * 100) / e.total);
                                }
                            }
                        })
                        .then((res) => {
                            this.images = res.data.paths;
                            this.uploading = false;
                            this.done = true;
                        })
                        .catch(err => {
                            this.uploading = false;
                            alert('Image upload failed');
                        });
                }
            }
        }
    </script>




</x-app-layout>
