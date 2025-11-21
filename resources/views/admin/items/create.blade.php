<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl p-4 mx-auto" x-data="{ variants: [] }">
        <div class="p-6 shadow-xl rounded-xl bg-base-100">
            <form action="{{ route('admin.saveDraft') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Info -->
                <div class="mb-4">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Name</span>
                        </label>
                        <input type="text" name="product_name" class="w-full input input-bordered" placeholder="Product name">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Product Description</span>
                    </label>
                    <textarea name="product_description" rows="3" class="w-full textarea textarea-bordered" placeholder="Enter description..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Packaging Details</span>
                    </label>
                    <textarea name="packaging_details" rows="2" class="w-full textarea textarea-bordered" placeholder="Box, Bag, etc."></textarea>
                </div>

                <!-- Images & Category -->
                <div class="mb-4" x-data="fileUpload()">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Images</span>
                        </label>
                        <input type="file" name="product_images[]" multiple class="w-full file-input file-input-bordered"
                            @change="uploadFiles($event)">
                    </div>

                    <div class="flex gap-3 mt-3">
                        <template x-for="img in images" :key="img">
                            <img :src="img" class="w-16 h-16 border rounded" />
                        </template>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-2" x-show="uploading">
                        <div class="w-full h-4 bg-gray-200 rounded-full">
                            <div class="h-4 bg-blue-600 rounded-full" :style="'width: ' + progress + '%'">
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
                        class="w-full text-black select select-bordered">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach

                    </select>

                    <!-- Add New Category -->
                    <div class="flex gap-2 mt-2">
                        <input type="text" x-model="newCategory" class="flex-1 input input-bordered"
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
                    <div class="flex flex-wrap gap-2 mt-2">
                        <template x-for="(cat, index) in categories" :key="cat.id">
                            <span class="flex items-center gap-2 px-3 py-1 text-white bg-indigo-500 rounded-full">
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

                    <label class="flex items-center gap-2 mb-2">
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
                                class="w-full select select-bordered">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>

                            <div class="flex gap-2 mt-2">
                                <input x-model="newColor" class="flex-1 input input-bordered" placeholder="Add new color">
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

                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(c, i) in colors" :key="c.id">
                                    <span class="flex items-center gap-2 px-3 py-1 text-white bg-blue-500 rounded-full">
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
                    <label class="flex items-center gap-2 mb-2">
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
                                class="w-full select select-bordered">
                                <option value="">-- Select Size --</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Add New Size -->
                            <div class="flex gap-2 mt-2">
                                <input x-model="newSize" class="flex-1 input input-bordered" placeholder="Add new size">
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
                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(s, i) in sizes" :key="s.id">
                                    <span class="flex items-center gap-2 px-3 py-1 text-white bg-green-600 rounded-full">
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
                                    {{-- <div class="mb-4" x-data="packagingForm()">
                                        <label class="label">Packaging</label>

                                        <!-- No Packaging Option -->
                                        <label class="flex items-center gap-2 mb-2">
                                            <input type="checkbox" x-model="noPack">
                                            <span>No packaging for this item</span>
                                        </label>

                                        <!-- Select Packaging -->
                                        <div class="flex gap-2 mb-2">
                                            <select x-model="selectedPack" class="w-full select select-bordered" :disabled="noPack">
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
                                        <div class="flex gap-2 mb-2">
                                            <input type="text" x-model="customPackName" placeholder="Custom Packaging Name"
                                                class="flex-1 input input-bordered" :disabled="noPack">
                                            <button type="button" class="btn btn-secondary" @click="addCustomPack()" :disabled="noPack">Add
                                                Custom</button>
                                        </div>

                                        <!-- Selected Packagings -->
                                        <div class="mt-2 space-y-2">
                                        <div class="mt-2 space-y-2">
                                            <template x-for="(p, i) in packs"
                                                    :key="p.id">
                                                <div class="flex items-center gap-2 px-3 py-1 bg-gray-100 rounded">
                                                    <span x-text="p.name"></span>

                                                    <!-- Quantity Input for non-piece -->
                                                    <template x-if="!p.fixed">
                                                        <input type="number"
                                                            min="1"
                                                            class="w-20 input input-sm input-bordered"
                                                            placeholder="Quantity"
                                                            x-model.number="p.quantity"
                                                            @input="calculateTotals()">
                                                    </template>

                                                    <!-- Display text -->
                                                    <span class="text-xs text-gray-700"
                                                        x-text="p.displayText"></span>

                                                    <!-- Remove Button for non-fixed packs -->
                                                    <template x-if="!p.fixed">
                                                        <button type="button"
                                                                class="btn btn-error btn-xs"
                                                                @click="packs.splice(i,1); calculateTotals()">✕</button>
                                                    </template>

                                                    <!-- Hidden Inputs for form submission -->
                                                    <input type="hidden"
                                                        :name="'packaging[]'"
                                                        :value="p.id">
                                                    <input type="hidden"
                                                        :name="'packaging_qty[' + p.id + ']'"
                                                        :value="p.quantity ?? 1">
                                                    <input type="hidden"
                                                        :name="'packaging_total_pieces[]'"
                                                        :value="p.totalPieces ?? (p.type === 'piece' ? 1 : p.quantity)">
                                                    <input type="hidden"
                                                        :name="'custom_pack_name[' + p.id + ']'"
                                                        :value="p.name">
                                                </div>
                                            </template>
                                        </div>
                                    </div> --}}





                                {{-- <div class="mb-4"
                                     x-data="{
                                        packs: [
                                            { id: 'piece_default', name: 'Piece', type: 'piece', fixed: false, quantity: 1, totalPieces: 1, displayText: '1 pcs', isNew: false }
                                        ],
                                        selectedPack: '',
                                        newPack: '',
                                        packagingTypes: @js($packagingTypes),

                                        addSelectedPack() {
                                            if (!this.selectedPack) return;

                                            let packId = this.selectedPack;

                                            // Avoid duplicates
                                            if (this.packs.find(p => p.id == packId)) {
                                                this.selectedPack = '';
                                                return;
                                            }

                                            let found = this.packagingTypes.find(p => p.id == packId);

                                            if (found) {
                                                this.packs.push({
                                                    id: found.id,
                                                    name: found.name,
                                                    type: found.type || 'custom',
                                                    fixed: false,
                                                    quantity: 1,
                                                    totalPieces: 1,
                                                    displayText: '',
                                                    isNew: false
                                                });
                                                this.updateTotals();
                                            }

                                            this.selectedPack = '';
                                        },

                                        addNewPack() {
                                            if (!this.newPack.trim()) return;

                                            let id = 'new_' + this.newPack.replace(/\s+/g, '_');

                                            this.packs.push({
                                                id: id,
                                                name: this.newPack,
                                                type: 'custom',
                                                fixed: false,
                                                quantity: 1,
                                                totalPieces: 1,
                                                displayText: '',
                                                isNew: true
                                            });

                                            this.newPack = '';
                                            this.updateTotals();
                                        },

                                        removePack(index) {
                                            let removed = this.packs.splice(index, 1)[0];

                                            // Re-enable removed option in dropdown
                                            let option = document.querySelector(`select[x-model='selectedPack'] option[value='${removed.id}']`);
                                            if(option) option.disabled = false;

                                            this.updateTotals();
                                        },

                                        updateTotals() {
                                            for (let i = 0; i < this.packs.length; i++) {
                                                let p = this.packs[i];

                                                if (i === 0) {
                                                    // First pack (Piece)
                                                    p.totalPieces = p.quantity;
                                                    p.displayText = `${p.quantity} pcs`;
                                                } else {
                                                    let prev = this.packs[i - 1];
                                                    p.totalPieces = prev.totalPieces * p.quantity;

                                                    if(prev.type === 'piece'){
                                                        p.displayText = `${p.quantity} pcs`;
                                                    } else {
                                                        p.displayText = `${p.quantity} ${prev.name}${p.quantity > 1 ? 's' : ''}, ${p.totalPieces} pcs`;
                                                    }
                                                }

                                                // Disable selected options in dropdown
                                                if(p.id !== 'piece_default'){
                                                    let option = document.querySelector(`select[x-model='selectedPack'] option[value='${p.id}']`);
                                                    if(option) option.disabled = true;
                                                }
                                            }
                                        }
                                     }">

                                    <label class="label">Packaging</label>

                                    <!-- Dropdown -->
                                    <select class="w-full select select-bordered"
                                            x-model="selectedPack"
                                            @change="addSelectedPack()">
                                        <option value="">-- Select Packaging --</option>
                                        @foreach ($packagingTypes as $pack)
                                            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- New Packaging -->
                                    <div class="flex gap-2 mt-2">
                                        <input x-model="newPack"
                                               class="flex-1 input input-bordered"
                                               placeholder="Add custom packaging">
                                        <button type="button"
                                                class="btn btn-primary"
                                                @click="addNewPack()">Add</button>
                                    </div>

                                    <!-- Selected Packs -->
                                    <div class="mt-3 space-y-2">
                                        <template x-for="(p, i) in packs"
                                                  :key="p.id">
                                            <div class="flex items-center gap-2 px-3 py-2 bg-gray-100 rounded">

                                                <!-- Name -->
                                                <span class="font-medium"
                                                      x-text="p.name"></span>

                                                <!-- Quantity (skip for first Piece) -->
                                                <template x-if="i !== 0">
                                                    <input type="number"
                                                           min="1"
                                                           class="w-20 input input-sm input-bordered"
                                                           x-model.number="p.quantity"
                                                           @input="updateTotals()">
                                                </template>

                                                <!-- Display text -->
                                                <span class="text-xs text-gray-700"
                                                      x-text="p.displayText"></span>

                                                <!-- Remove button -->
                                                <button type="button"
                                                        class="btn btn-error btn-xs"
                                                        @click="removePack(i)">✕</button>

                                                <!-- Hidden Inputs -->
                                                <input type="hidden"
                                                       :name="'packaging[]'"
                                                       :value="p.id">
                                                <input type="hidden"
                                                       :name="'packaging_qty[' + p.id + ']'"
                                                       :value="p.quantity">
                                                <input type="hidden"
                                                       :name="'packaging_total_pieces[' + p.id + ']'"
                                                       :value="p.totalPieces">
                                                <input type="hidden"
                                                       :name="'custom_pack_name[' + p.id + ']'"
                                                       :value="p.name">

                                            </div>
                                        </template>
                                    </div>
                                </div> --}}




                                <div class="mb-4"
     x-data="{
        packagingTypes: @js($packagingTypes),
        packs: [
            { id: 'piece_default', name: 'Piece', type: 'piece', fixed: false, quantity: 1, totalPieces: 1, displayText: '1 pcs', isNew: false }
        ],
        selectedPack: '',
        newPack: '',

        init() {
            this.updateTotals();
        },

        // Helper to get the correct DB ID for submission
        getSendableId(p) {
            if (p.id === 'piece_default') {
                // Try to find the real numeric ID of 'Piece' from the database types
                let realPiece = this.packagingTypes.find(pt => pt.name.toLowerCase() === 'piece');
                return realPiece ? realPiece.id : 'piece_default';
            }
            return p.id;
        },

        addSelectedPack() {
            if (!this.selectedPack) return;

            let packId = this.selectedPack;

            // Prevent duplicates check
            if (this.packs.find(p => p.id == packId)) {
                this.selectedPack = '';
                return;
            }

            let found = this.packagingTypes.find(p => p.id == packId);

            // Handle 'Piece' specifically if it's in the static options but not in the JS array
            if (packId === 'piece_default') {
                found = { id: 'piece_default', name: 'Piece', type: 'piece' };
            }

            if (found) {
                this.packs.push({
                    id: found.id,
                    name: found.name,
                    type: found.type || 'custom',
                    fixed: false,
                    quantity: 1,
                    totalPieces: 1,
                    displayText: '',
                    isNew: false
                });
                this.updateTotals();
            }

            this.selectedPack = '';
        },

        addNewPack() {
            if (!this.newPack.trim()) return;

            let id = 'new_' + this.newPack.replace(/\s+/g, '_').toLowerCase();

            if (this.packs.find(p => p.id == id)) {
                 this.newPack = '';
                 return;
            }

            this.packs.push({
                id: id,
                name: this.newPack,
                type: 'custom',
                fixed: false,
                quantity: 1,
                totalPieces: 1,
                displayText: '',
                isNew: true
            });

            this.newPack = '';
            this.updateTotals();
        },

        removePack(index) {
            this.packs.splice(index, 1);
            this.updateTotals();
        },

        updateTotals() {
            // 1. RESET & DISABLE DROPDOWN OPTIONS
            // We use x-ref to grab the select element directly
            let select = this.$refs.packSelect;

            if (select) {
                // First, reset all options to enabled and normal color
                Array.from(select.options).forEach(opt => {
                    if (opt.value) { // Skip placeholder
                        opt.disabled = false;
                        opt.classList.remove('text-gray-400', 'bg-gray-100', 'italic'); // Remove visual disabled styles
                    }
                });

                // Then, loop through selected packs and disable them in the dropdown
                this.packs.forEach(p => {
                    // Find the option matching this pack ID
                    let option = Array.from(select.options).find(o => o.value == p.id);
                    if (option) {
                        option.disabled = true;
                        // Add Tailwind classes to make it look visibly disabled (works in Chrome/Firefox)
                        option.classList.add('text-gray-400', 'bg-gray-100', 'italic');
                    }
                });
            }

            // 2. CALCULATE TOTALS
            let previousTotalPieces = 1;

            for (let i = 0; i < this.packs.length; i++) {
                let p = this.packs[i];

                if(i === 0) {
                    // --- BASE UNIT (Always 1) ---
                    p.quantity = 1;
                    p.totalPieces = 1;
                    p.displayText = '1 pcs';
                    previousTotalPieces = 1;
                } else {
                    // --- PACKAGING LAYERS ---
                    let currentQty = parseInt(p.quantity) || 1;

                    p.totalPieces = currentQty * previousTotalPieces;
                    previousTotalPieces = p.totalPieces;

                    // Breakdown Text
                    let breakdown = [];
                    let runningQty = currentQty;

                    for (let j = i - 1; j >= 1; j--) {
                        let childPack = this.packs[j];
                        breakdown.push(`${runningQty} ${childPack.name}${runningQty > 1 ? 's' : ''}`);
                        runningQty = runningQty * (parseInt(childPack.quantity) || 1);
                    }

                    breakdown.push(`${p.totalPieces} pcs`);
                    p.displayText = breakdown.join(', ');
                }
            }
        }
     }"
     x-init="init()">

    <label class="label">Packaging</label>

    <!-- Dropdown -->
    <select class="w-full select select-bordered"
            x-model="selectedPack"
            x-ref="packSelect"
            @change="addSelectedPack()">
        <option value="">-- Select Packaging --</option>
        <option value="piece_default">Piece</option>
        @foreach ($packagingTypes as $pack)
            @if (strtolower($pack->name) !== 'piece')
                <option value="{{ $pack->id }}">{{ $pack->name }}</option>
            @endif
        @endforeach
    </select>

    <!-- New Packaging -->
    <div class="flex gap-2 mt-2">
        <input x-model="newPack"
               class="flex-1 input input-bordered"
               placeholder="Add custom packaging"
               @keydown.enter.prevent="addNewPack()">
        <button type="button"
                class="btn btn-primary"
                @click="addNewPack()">Add</button>
    </div>

    <!-- Selected Packs List -->
    <div class="mt-3 space-y-2">
        <template x-for="(p, i) in packs" :key="p.id">
            <div class="flex items-center gap-2 px-3 py-2 bg-gray-100 rounded">
                <span class="font-medium min-w-[60px]" x-text="p.name"></span>

                <!-- Quantity Input (Skipped for the Base Unit at index 0) -->
                <template x-if="i !== 0">
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500">contains</span>
                        <input type="number"
                               min="1"
                               class="w-20 text-center input input-sm input-bordered"
                               x-model.number="p.quantity"
                               @input="updateTotals()">
                        <!-- Shows name of unit below -->
                        <span class="text-xs text-gray-500" x-text="packs[i-1].name + (p.quantity > 1 ? 's' : '')"></span>
                    </div>
                </template>

                <div class="flex-1 text-right">
                    <span class="block text-xs text-gray-700" x-text="p.displayText"></span>
                </div>

                <!-- Remove button -->
                <button type="button"
                        class="btn btn-error btn-xs"
                        @click="removePack(i)">✕</button>

                <!-- Hidden Inputs: All items are now sent. 'getSendableId' ensures 'piece_default' is converted to a real ID -->
                <input type="hidden" :name="'packaging[]'" :value="getSendableId(p)">
                <input type="hidden" :name="'packaging_qty[' + getSendableId(p) + ']'" :value="p.quantity">
                <input type="hidden" :name="'packaging_total_pieces[' + getSendableId(p) + ']'" :value="p.totalPieces">
                <input type="hidden" :name="'custom_pack_name[' + getSendableId(p) + ']'" :value="p.name">
            </div>
        </template>
    </div>
</div>








                                </div>
                            </div>
                        </div>
                    <div class="mt-6 text-end">
                        <button type="submit" class="px-6 btn btn-primary">Save Product</button>
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

        // function packagingForm() {
        //     return {
        //         packs: [{
        //             // id: 'piece',
        //             // name: 'Piece',
        //             // type: 'piece',
        //             // quantity: 1,
        //             // totalPieces: 1,
        //             // displayText: '(1 pcs)'
        //             id: @json($packagingTypes->where('name', 'Piece')->first()?->id ?? 1),
        //             name: 'Piece',
        //             type: 'piece',
        //             quantity: 1,
        //             totalPieces: 1,
        //             displayText: '(1 pcs)'
        //         }],
        //         selectedPack: '',
        //         customPackName: '',

        //         addPack(selectedId) {
        //             if (!selectedId || selectedId === 'piece') return;

        //             const select = document.querySelector(`select[x-model="selectedPack"]`);
        //             const option = select.options[select.selectedIndex];
        //             const type = option.dataset.type || 'custom';
        //             const name = option.text;

        //             if (!this.packs.find(p => p.id == selectedId)) {
        //                 this.packs.push({
        //                     id: selectedId,
        //                     name: name,
        //                     type: type,
        //                     quantity: 1,
        //                     totalPieces: 1,
        //                     displayText: ''
        //                 });
        //             }

        //             this.selectedPack = '';
        //             this.calculateTotals();
        //         },

        //         addCustomPack() {
        //             if (!this.customPackName) return;

        //             const id = 'custom_' + Date.now();

        //             this.packs.push({
        //                 id: id,
        //                 name: this.customPackName,
        //                 type: 'custom',
        //                 quantity: 1,
        //                 totalPieces: 1,
        //                 displayText: ''
        //             });

        //             this.customPackName = '';
        //             this.calculateTotals();
        //         },

        //         calculateTotals() {
        //             for (let i = 0; i < this.packs.length; i++) {
        //                 let p = this.packs[i];

        //                 if (p.type === 'piece') {
        //                     p.totalPieces = 1;
        //                     p.displayText = '(1 pcs)';
        //                 } else {
        //                     let qty = p.quantity || 1;

        //                     // Calculate total pieces
        //                     let parent = this.packs[i - 1];
        //                     p.totalPieces = qty * parent.totalPieces;

        //                     // Build display text including all ancestors for levels > Packet
        //                     if (i === 1) {
        //                         // Packet after Piece
        //                         p.displayText = `(${qty} ${parent.name}, ${p.totalPieces} pcs)`;
        //                     } else if (i === 2) {
        //                         // Cartoon after Packet
        //                         p.displayText = `(${qty} ${parent.name}, ${p.totalPieces} pcs)`;
        //                     } else {
        //                         // Container or deeper levels: show all ancestors
        //                         let ancestors = [];
        //                         for (let j = i - 1; j >= 0; j--) {
        //                             let ancestorQty = 1;
        //                             for (let k = j + 1; k <= i; k++) {
        //                                 ancestorQty *= this.packs[k].quantity || 1;
        //                             }
        //                             ancestors.push(`${ancestorQty} ${this.packs[j].name}`);
        //                         }
        //                         p.displayText = `(${qty} ${parent.name}, ${ancestors.join(', ')}, ${p.totalPieces} pcs)`;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

    //    function packagingForm() {
    //         return {
    //             packs: [{
    //                 id: @json($packagingTypes->where('name', 'Piece')->first()?->id ?? 1),
    //                 name: 'Piece',
    //                 type: 'piece',
    //                 quantity: 1,
    //                 totalPieces: 1,
    //                 displayText: '(1 pcs)',
    //                 fixed: true // Mark it as fixed
    //             }],
    //             selectedPack: '',
    //             customPackName: '',
    //             noPack: false,

    //             addPack(selectedId) {
    //                 if (!selectedId) return;

    //                 // Prevent adding "Piece" again
    //                 const option = document.querySelector(`select[x-model="selectedPack"]`).selectedOptions[0];
    //                 const name = option.text;
    //                 const type = option.dataset.type || 'custom';
    //                 if (name === 'Piece') return;

    //                 // Avoid duplicates
    //                 if (!this.packs.find(p => p.id == selectedId)) {
    //                     this.packs.push({
    //                         id: selectedId,
    //                         name: name,
    //                         type: type,
    //                         quantity: 1,
    //                         totalPieces: 1,
    //                         displayText: ''
    //                     });
    //                 }

    //                 this.selectedPack = '';
    //                 this.calculateTotals();
    //             },

    //             addCustomPack() {
    //                 if (!this.customPackName) return;

    //                 const id = 'custom_' + Date.now();

    //                 this.packs.push({
    //                     id: id,
    //                     name: this.customPackName,
    //                     type: 'custom',
    //                     quantity: 1,
    //                     totalPieces: 1,
    //                     displayText: ''
    //                 });

    //                 this.customPackName = '';
    //                 this.calculateTotals();
    //             },

    //             calculateTotals() {
    //                 for (let i = 0; i < this.packs.length; i++) {
    //                     const p = this.packs[i];

    //                     if (p.type === 'piece' || p.fixed) {
    //                         p.totalPieces = 1;
    //                         p.displayText = '(1 pcs)';
    //                     } else {
    //                         const prevTotal = i > 0 ? this.packs[i - 1].totalPieces : 1;
    //                         p.totalPieces = p.quantity * prevTotal;
    //                         p.displayText = `(${p.quantity} ${this.packs[i - 1].name}, ${p.totalPieces} pcs)`;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    </script>

</x-app-layout>
