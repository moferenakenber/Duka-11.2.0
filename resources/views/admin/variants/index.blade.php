<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
                {{ __('Item Variants') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-6 flex items-start justify-between rounded-xl bg-white p-4 shadow-md">
                <div class="flex flex-1 gap-4">
                    {{-- Item Image --}}
                    <div class="h-20 w-20 overflow-hidden rounded">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                            class="h-full w-full object-cover" alt="{{ $item->product_name }}">
                    </div>

                    {{-- Item Info --}}
                    <div class="flex-1">
                        {{-- Name --}}
                        <h2 class="dark:text-gray-200 text-lg font-semibold text-gray-800">{{ $item->product_name }}</h2>

                        {{-- Description --}}
                        <p class="dark:text-gray-300 text-sm text-gray-600">{{ $item->product_description }}</p>

                        {{-- Price --}}
                        <div class="mt-1 flex gap-2">
                            <span class="rounded-full bg-blue-500 px-2 py-1 text-xs text-white">
                                Price: ${{ number_format($item->price, 2) }}
                            </span>
                        </div>

                        {{-- Colors --}}
                        @if ($item->colors->count())
                            <div class="mt-3">
                                <h3 class="dark:text-gray-300 mb-1 text-sm font-semibold text-gray-700">Colors</h3>
                                <div class="flex gap-2">
                                    @foreach ($item->colors as $color)
                                        <span class="h-6 w-6 rounded-full border border-gray-300" title="{{ $color->name }}"
                                            style="background-color: {{ $color->name }}"></span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Sizes --}}
                        @if ($item->sizes->count())
                            <div class="mt-3">
                                <h3 class="dark:text-gray-300 mb-1 text-sm font-semibold text-gray-700">Sizes</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->sizes as $size)
                                        <span
                                            class="rounded-full bg-indigo-100 px-2 py-1 text-sm font-medium text-indigo-800 ring-1 ring-inset ring-indigo-200">
                                            {{ $size->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        {{-- Packaging --}}
                        @if ($item->packagingTypes->count())
                            <div class="mt-3">
                                <h3 class="dark:text-gray-300 mb-1 text-sm font-semibold text-gray-700">Packaging</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->packagingTypes as $pack)
                                        <span
                                            class="bg-brand-softer text-fg-brand-strong ring-brand-subtle rounded px-2 py-1 text-sm font-medium ring-1 ring-inset">
                                            {{ $pack->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Variant Count --}}
                <div class="ml-4 flex items-center">
                    <span class="rounded-full bg-purple-500 px-3 py-2 text-sm font-bold text-white">
                        Variants: {{ $item->variants->count() }}
                    </span>
                </div>
            </div>


            {{-- Add Variant Form --}}
            <div class="mb-6 rounded-xl bg-base-200 p-4" x-data="variantForm()">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Add Variant</h3>
                    <button type="button" class="btn btn-outline btn-sm" @click="addVariant()">+ Add Variant</button>
                </div>

                <form method="POST" action="{{ route('admin.variants.store', $item->id) }}" enctype="multipart/form-data">
                    @csrf

                    <template x-for="(variant, index) in variants" :key="index">
                        <div class="mb-2 flex flex-wrap items-end gap-2 rounded-xl border bg-base-100 p-2">

                            {{-- Image uploader --}}
                            <div x-data="variantFileUpload({{ $loop->index ?? 0 }})" class="mb-2">
                                <label class="label">Variant Image</label>

                                <input type="file" :name="`variants[${index}][image][]`" multiple
                                    class="file-input file-input-bordered w-full" @change="uploadFiles($event)">

                                <div class="mt-2 flex gap-2">
                                    <template x-for="img in images" :key="img">
                                        <img :src="imageUrl(img)" class="h-16 w-16 rounded border">
                                    </template>
                                </div>

                                <template x-for="img in images" :key="img">
                                    <input type="hidden" :name="`variants[${index}][image_paths][]`" :value="img">
                                </template>

                                <div x-show="uploading" class="mt-2">
                                    <div class="h-2 w-full rounded bg-gray-200">
                                        <div class="h-2 rounded bg-blue-600" :style="'width: ' + progress + '%'"></div>
                                    </div>
                                    <p x-text="progress + '%'"></p>
                                </div>
                            </div>



                            {{-- Color --}}
                            @if ($item->colors->isNotEmpty())
                                <div class="flex-1">
                                    <label class="mb-1 block text-xs font-semibold text-gray-600">Color</label>
                                    <select x-model="variant.item_color_id" :name="`variants[${index}][item_color_id]`"
                                        class="input input-sm input-bordered h-12 w-full">
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
                                    <label class="mb-1 block text-xs font-semibold text-gray-600">Size</label>
                                    <select x-model="variant.item_size_id" :name="`variants[${index}][item_size_id]`"
                                        class="input input-sm input-bordered h-12 w-full">
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
                                    <label class="mb-1 block text-xs font-semibold text-gray-600">Packaging</label>
                                    <select x-model="variant.item_packaging_type_id"
                                        :name="`variants[${index}][item_packaging_type_id]`"
                                        class="input input-sm input-bordered h-12 w-full" @change="updateCapacity(index, $event)">
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
                                <label class="mb-1 block text-xs font-semibold text-gray-600">Barcode</label>
                                <input type="text" x-model="variant.barcode" :name="`variants[${index}][barcode]`"
                                    class="input input-sm input-bordered h-12 w-full" placeholder="Enter barcode">
                            </div>

                            {{-- Price --}}
                            <div class="flex-1">
                                <label class="mb-1 block text-xs font-semibold text-gray-600">Price</label>
                                <input type="number" x-model="variant.price" :name="`variants[${index}][price]`"
                                    class="input input-sm input-bordered h-12 w-full" placeholder="Price">
                            </div>

                            {{-- Remove button --}}
                            <div class="mt-2 flex items-center gap-2">
                                <button type="button" class="btn btn-error btn-sm"
                                    @click="variants.splice(index, 1)">Remove</button>
                            </div>

                            {{-- Save Variant button --}}
                            <div class="mt-2 w-full">
                                <button type="submit" class="btn btn-primary w-full sm:w-auto">Save Variant</button>
                            </div>

                        </div>
                    </template>

                </form>


            </div>



            @if (session('success'))
                <div x-data="{ showToast: true }" x-show="showToast" x-transition
                    class="mb-4 rounded bg-green-100 p-4 text-green-700" x-init="setTimeout(() => showToast = false, 3000)">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('error'))
                <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif


            {{-- Variant Table --}}
            <div class="overflow-x-auto rounded-xl bg-base-100">
                <table class="table table-xs w-full">
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
                                <td>
                                    @if ($variant->images && count($variant->images) > 0)
                                        <img src="{{ asset('storage/' . $variant->images[0]) }}"
                                            class="h-8 w-8 rounded object-cover" alt="Variant Image">
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
                                            class="dark:text-gray-200 w-full rounded-md border border-gray-300 px-2 py-1 text-sm leading-normal text-gray-800"
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
