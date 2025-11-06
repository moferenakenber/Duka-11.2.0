<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-6xl p-4" x-data="{ variants: [] }">
        <div class="rounded-xl bg-base-100 p-6 shadow-xl">
            <form action="{{ route('admin.saveDraft') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Info -->
                <div class="mb-4">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Name</span>
                        </label>
                        <input type="text" name="product_name" class="input input-bordered w-full" placeholder="Product name">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Product Description</span>
                    </label>
                    <textarea name="product_description" rows="3" class="textarea textarea-bordered w-full" placeholder="Enter description..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Packaging Details</span>
                    </label>
                    <textarea name="packaging_details" rows="2" class="textarea textarea-bordered w-full" placeholder="Box, Bag, etc."></textarea>
                </div>

                <!-- Images & Category -->
                <div class="mb-4" x-data="fileUpload()">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Images</span>
                        </label>
                        <input type="file" name="product_images[]" multiple class="file-input file-input-bordered w-full"
                            @change="uploadFiles($event)">
                    </div>

                    <div class="mt-3 flex gap-3">
                        <template x-for="img in images" :key="img">
                            <img :src="img" class="h-16 w-16 rounded border" />
                        </template>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-2" x-show="uploading">
                        <div class="h-4 w-full rounded-full bg-gray-200">
                            <div class="h-4 rounded-full bg-blue-600" :style="'width: ' + progress + '%'">
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-700" x-text="progress + '%'"></p>
                    </div>

                    <template x-for="img in images" :key="img">
                        <input type="hidden" name="product_images[]" :value="img">
                    </template>


                    <!-- Done Message -->
                    <p class="mt-2 font-semibold text-green-600" x-show="done">Upload Complete!</p>
                </div>


                <!-- Main Category -->
                <!-- Categories -->
                <!-- Categories -->
                <!-- Categories -->
                <div x-data="{
                    categories: [],
                    selectedCategory: '',
                    newCategory: '',
                }" class="mb-4">

                    <label class="label">Categories</label>

                    <!-- Existing Category Selector -->
                    <select x-model="selectedCategory"
                        @change="
                            if (selectedCategory && !categories.find(c => c.id == selectedCategory)) {
                                let name = $event.target.options[$event.target.selectedIndex].text;
                                categories.push({ id: selectedCategory, name: name, isNew: false });
                            }
                            selectedCategory = '';
                        "
                        class="select select-bordered w-full text-black">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach

                    </select>

                    <!-- Add New Category -->
                    <div class="mt-2 flex gap-2">
                        <input type="text" x-model="newCategory" class="input input-bordered flex-1"
                            placeholder="Add new category">

                        <button type="button" class="btn btn-primary"
                            @click="
                    if (newCategory.trim() !== '') {
                        categories.push({
                            id: 'new_' + newCategory.replace(/\s+/g, '_'),
                            name: newCategory,
                            isNew: true
                        });
                        newCategory = '';
                    }
                ">
                            Add
                        </button>
                    </div>

                    <!-- Selected Categories -->
                    <div class="mt-2 flex flex-wrap gap-2">
                        <template x-for="(cat, index) in categories" :key="cat.id">
                            <span class="flex items-center gap-2 rounded-full bg-indigo-500 px-3 py-1 text-white">
                                <span x-text="cat.name"></span>
                                <button type="button" @click="categories.splice(index, 1)">✕</button>
                            </span>
                        </template>
                    </div>

                    <!-- Hidden Inputs -->
                    <template x-for="cat in categories" :key="'hidden_' + cat.id">
                        <input type="hidden" :name="cat.isNew ? 'newCategories[]' : 'categories[]'"
                            :value="cat.isNew ? cat.name : cat.id">
                    </template>
                </div>

                <!-- Colors -->
                <div class="mb-4" x-data="{ colors: [], selectedColor: '', newColor: '', noColor: false }">
                    <label class="label">Colors</label>

                    <label class="mb-2 flex items-center gap-2">
                        <input type="checkbox" x-model="noColor" @change="colors = []">
                        <span>No color for this item</span>
                    </label>

                    <template x-if="!noColor">
                        <div>
                            <select x-model="selectedColor"
                                @change="
                        if(selectedColor && !colors.find(c => c.id == selectedColor)) {
                            let name = $event.target.options[$event.target.selectedIndex].text;
                            colors.push({ id: selectedColor, name: name, isNew: false });
                        }
                        selectedColor = '';
                      "
                                class="select select-bordered w-full">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>

                            <div class="mt-2 flex gap-2">
                                <input x-model="newColor" class="input input-bordered flex-1" placeholder="Add new color">
                                <button type="button" class="btn btn-primary"
                                    @click="
                            if (newColor.trim()) {
                                colors.push({ id: 'new_'+newColor, name: newColor, isNew: true });
                                newColor = '';
                            }
                        ">
                                    Add
                                </button>
                            </div>

                            <div class="mt-2 flex flex-wrap gap-2">
                                <template x-for="(c, i) in colors" :key="c.id">
                                    <span class="flex items-center gap-2 rounded-full bg-blue-500 px-3 py-1 text-white">
                                        <span x-text="c.name"></span>
                                        <button @click="colors.splice(i,1)">✕</button>
                                    </span>
                                </template>
                            </div>

                            <template x-for="c in colors" :key="'hidden_' + c.id">
                                <input type="hidden" :name="c.isNew ? 'newColors[]' : 'colors[]'"
                                    :value="c.isNew ? c.name : c.id">
                            </template>
                        </div>
                    </template>
                </div>

                <!-- Sizes -->
                <div class="mb-4" x-data="{ sizes: [], selectedSize: '', newSize: '', noSize: false }">

                    <label class="label">Sizes</label>

                    <!-- No Size Option -->
                    <label class="mb-2 flex items-center gap-2">
                        <input type="checkbox" x-model="noSize" @change="sizes = []">
                        <span>No size for this item</span>
                    </label>

                    <!-- Multi Size Selection -->
                    <template x-if="!noSize">
                        <div>
                            <!-- Existing Size Selector -->
                            <select x-model="selectedSize"
                                @change="
                    if(selectedSize && !sizes.find(s => s.id == selectedSize)) {
                        let name = $event.target.options[$event.target.selectedIndex].text;
                        sizes.push({ id: selectedSize, name: name, isNew: false });
                    }
                    selectedSize = '';
                "
                                class="select select-bordered w-full">
                                <option value="">-- Select Size --</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Add New Size -->
                            <div class="mt-2 flex gap-2">
                                <input x-model="newSize" class="input input-bordered flex-1" placeholder="Add new size">
                                <button type="button" class="btn btn-primary"
                                    @click="
                        if (newSize.trim()) {
                            sizes.push({ id: 'new_'+newSize.replace(/\s+/g,'_'), name: newSize, isNew: true });
                            newSize = '';
                        }
                    ">
                                    Add
                                </button>
                            </div>

                            <!-- Selected Sizes -->
                            <div class="mt-2 flex flex-wrap gap-2">
                                <template x-for="(s, i) in sizes" :key="s.id">
                                    <span class="flex items-center gap-2 rounded-full bg-green-600 px-3 py-1 text-white">
                                        <span x-text="s.name"></span>
                                        <button type="button" @click="sizes.splice(i, 1)">✕</button>
                                    </span>
                                </template>
                            </div>

                            <!-- Hidden Inputs -->
                            <template x-for="s in sizes" :key="'hidden_' + s.id">
                                <input type="hidden" :name="s.isNew ? 'newSizes[]' : 'sizes[]'"
                                    :value="s.isNew ? s.name : s.id">
                            </template>
                        </div>
                    </template>

                </div>

                <!-- Packaging -->
                {{-- <div class="mb-4" x-data="{ packs: [], selectedPack: '', newPack: '', noPack: false }">

                    <label class="label">Packaging</label>

                    <!-- No Packaging Option -->
                    <label class="flex items-center gap-2 mb-2">
                        <input type="checkbox" x-model="noPack" @change="packs = []">
                        <span>No packaging for this item</span>
                    </label>

                    <template x-if="!noPack">
                        <div>
                            <!-- Existing Packaging Selector -->
                            <select x-model="selectedPack"
                                @change="
                    if(selectedPack && !packs.find(p => p.id == selectedPack)) {
                        let name = $event.target.options[$event.target.selectedIndex].text;
                        packs.push({ id: selectedPack, name: name, isNew: false });
                    }
                    selectedPack = '';
                "
                                class="w-full select select-bordered">
                                <option value="">-- Select Packaging --</option>
                                @foreach ($packagingTypes as $pack)
                                    <option value="{{ $pack->id }}">{{ $pack->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Add New Packaging -->
                            <div class="flex gap-2 mt-2">
                                <input x-model="newPack" class="flex-1 input input-bordered" placeholder="Add new packaging">
                                <button type="button" class="btn btn-primary"
                                    @click="
                        if (newPack.trim()) {
                            packs.push({ id: 'new_'+newPack.replace(/\s+/g,'_'), name: newPack, isNew: true });
                            newPack = '';
                        }
                    ">
                                    Add
                                </button>
                            </div>

                            <!-- Selected Packagings -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(p, i) in packs" :key="p.id">
                                    <span class="flex items-center gap-2 px-3 py-1 text-white bg-green-600 rounded-full">
                                        <span x-text="p.name"></span>
                                        <button type="button" @click="packs.splice(i, 1)">✕</button>
                                    </span>
                                </template>
                            </div>

                            <!-- Hidden Inputs -->
                            <template x-for="p in packs" :key="'hidden_' + p.id">
                                <input type="hidden" :name="p.isNew ? 'newPackaging[]' : 'packaging[]'"
                                    :value="p.isNew ? p.name : p.id">
                            </template>
                        </div>
                    </template>
                </div> --}}



                <!-- Packaging -->
                <div class="mb-4" x-data="packagingForm()">
                    <label class="label">Packaging</label>

                    <!-- No Packaging Option -->
                    <label class="mb-2 flex items-center gap-2">
                        <input type="checkbox" x-model="noPack">
                        <span>No packaging for this item</span>
                    </label>

                    <!-- Select Packaging -->
                    <div class="mb-2 flex gap-2">
                        <select x-model="selectedPack" class="select select-bordered w-full" :disabled="noPack">
                            <option value="">-- Select Packaging --</option>
                            @foreach ($packagingTypes as $pack)
                                <option value="{{ $pack->id }}" :data-type="'{{ $pack->type ?? 'custom' }}'">
                                    {{ $pack->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" @click="addPack(selectedPack)"
                            :disabled="noPack">Add</button>
                    </div>

                    <!-- Custom Packaging -->
                    <div class="mb-2 flex gap-2">
                        <input type="text" x-model="customPackName" placeholder="Custom Packaging Name"
                            class="input input-bordered flex-1" :disabled="noPack">
                        <button type="button" class="btn btn-secondary" @click="addCustomPack()" :disabled="noPack">Add
                            Custom</button>
                    </div>

                    <!-- Selected Packagings -->
                    <div class="mt-2 space-y-2">
                        <template x-for="(p, i) in packs" :key="p.id">
                            <div class="flex items-center gap-2 rounded bg-gray-100 px-3 py-1">
                                <span x-text="p.name"></span>

                                <!-- Quantity Input for non-piece -->
                                <template x-if="p.type !== 'piece'">
                                    <input type="number" min="1" class="input input-sm input-bordered w-20"
                                        placeholder="Quantity" x-model.number="p.quantity" @input="calculateTotals()">
                                </template>

                                <!-- Display text -->
                                <span class="text-xs text-gray-700" x-text="p.displayText"></span>

                                <button type="button" class="btn btn-error btn-xs"
                                    @click="packs.splice(i,1); calculateTotals()">✕</button>

                                <!-- Hidden Inputs for form submission -->
                                <input type="hidden" :name="'packaging[]'" :value="p.id">
                                <input type="hidden" :name="'packaging_qty[' + p.id + ']'" :value="p.quantity ?? 1">
                                <input type="hidden" :name="'packaging_total_pieces[]'"
                                    :value="p.totalPieces ?? (p.type === 'piece' ? 1 : p.quantity)">
                                <input type="hidden" :name="'custom_pack_name[' + p.id + ']'" :value="p.name">

                            </div>
                        </template>
                    </div>
                </div>

        </div>


    </div>



    <div class="mt-6 text-end">
        <button type="submit" class="btn btn-primary px-6">Save Product</button>
    </div>
    </form>
    </div>
    </div>

    <script>
        function fileUpload() {
            return {
                uploading: false,
                progress: 0,
                done: false,

                uploadFiles(event) {
                    this.uploading = true;
                    this.done = false;
                    this.progress = 0;

                    let formData = new FormData();
                    let files = event.target.files;

                    for (let i = 0; i < files.length; i++) {
                        formData.append('product_images[]', files[i]);
                    }

                    axios.post("{{ route('admin.items.uploadImages') }}", formData, {
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
                            this.uploading = false;
                            this.done = true;
                        })
                        .catch((error) => {
                            this.uploading = false;
                            alert('Upload failed');
                            console.error(error);
                        });
                }
            }
        }

        function packagingForm() {
            return {
                packs: [{
                    // id: 'piece',
                    // name: 'Piece',
                    // type: 'piece',
                    // quantity: 1,
                    // totalPieces: 1,
                    // displayText: '(1 pcs)'
                    id: @json($packagingTypes->where('name', 'Piece')->first()?->id ?? 1),
                    name: 'Piece',
                    type: 'piece',
                    quantity: 1,
                    totalPieces: 1,
                    displayText: '(1 pcs)'
                }],
                selectedPack: '',
                customPackName: '',

                addPack(selectedId) {
                    if (!selectedId || selectedId === 'piece') return;

                    const select = document.querySelector(`select[x-model="selectedPack"]`);
                    const option = select.options[select.selectedIndex];
                    const type = option.dataset.type || 'custom';
                    const name = option.text;

                    if (!this.packs.find(p => p.id == selectedId)) {
                        this.packs.push({
                            id: selectedId,
                            name: name,
                            type: type,
                            quantity: 1,
                            totalPieces: 1,
                            displayText: ''
                        });
                    }

                    this.selectedPack = '';
                    this.calculateTotals();
                },

                addCustomPack() {
                    if (!this.customPackName) return;

                    const id = 'custom_' + Date.now();

                    this.packs.push({
                        id: id,
                        name: this.customPackName,
                        type: 'custom',
                        quantity: 1,
                        totalPieces: 1,
                        displayText: ''
                    });

                    this.customPackName = '';
                    this.calculateTotals();
                },

                calculateTotals() {
                    for (let i = 0; i < this.packs.length; i++) {
                        let p = this.packs[i];

                        if (p.type === 'piece') {
                            p.totalPieces = 1;
                            p.displayText = '(1 pcs)';
                        } else {
                            let qty = p.quantity || 1;

                            // Calculate total pieces
                            let parent = this.packs[i - 1];
                            p.totalPieces = qty * parent.totalPieces;

                            // Build display text including all ancestors for levels > Packet
                            if (i === 1) {
                                // Packet after Piece
                                p.displayText = `(${qty} ${parent.name}, ${p.totalPieces} pcs)`;
                            } else if (i === 2) {
                                // Cartoon after Packet
                                p.displayText = `(${qty} ${parent.name}, ${p.totalPieces} pcs)`;
                            } else {
                                // Container or deeper levels: show all ancestors
                                let ancestors = [];
                                for (let j = i - 1; j >= 0; j--) {
                                    let ancestorQty = 1;
                                    for (let k = j + 1; k <= i; k++) {
                                        ancestorQty *= this.packs[k].quantity || 1;
                                    }
                                    ancestors.push(`${ancestorQty} ${this.packs[j].name}`);
                                }
                                p.displayText = `(${qty} ${parent.name}, ${ancestors.join(', ')}, ${p.totalPieces} pcs)`;
                            }
                        }
                    }
                }
            }
        }
    </script>

</x-app-layout>
