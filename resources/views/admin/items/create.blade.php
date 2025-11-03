<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl p-4 mx-auto" x-data="{ variants: [] }">
        <div class="p-6 shadow-xl bg-base-100 rounded-xl">
            <form action="{{ route('admin.saveDraft') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Info -->
                <div class="mb-4">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Name</span>
                        </label>
                        <input type="text" name="product_name" class="w-full input input-bordered"
                            placeholder="Product name">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Product Description</span>
                    </label>
                    <textarea name="product_description" rows="3" class="w-full textarea textarea-bordered"
                        placeholder="Enter description..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="label">
                        <span class="label-text">Packaging Details</span>
                    </label>
                    <textarea name="packaging_details" rows="2" class="w-full textarea textarea-bordered"
                        placeholder="Box, Bag, etc."></textarea>
                </div>

                <!-- Images & Category -->
                <div class="mb-4" x-data="fileUpload()">
                    <div>
                        <label class="label">
                            <span class="label-text">Product Images</span>
                        </label>
                        <input type="file" name="product_images[]" multiple
                            class="w-full file-input file-input-bordered" @change="uploadFiles($event)">
                    </div>

                    <div class="flex gap-3 mt-3">
                        <template x-for="img in images" :key="img">
                            <img :src="img" class="w-16 h-16 border rounded" />
                        </template>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-2" x-show="uploading">
                        <div class="w-full h-4 bg-gray-200 rounded-full">
                            <div class="h-4 bg-blue-600 rounded-full" :style="'width: ' + progress + '%'"></div>
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



                <!-- Status -->
                <div class="mb-6">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select name="status" class="w-full select select-bordered">
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <!-- Colors -->
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
                                <input x-model="newColor" class="flex-1 input input-bordered"
                                    placeholder="Add new color">
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
                                    <span
                                        class="flex items-center gap-2 px-3 py-1 text-white bg-blue-500 rounded-full">
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
                <div class="mb-4">
                    <label class="label">Sizes</label>
                    <select x-model="selectedSize"
                        @change="
                            if(selectedSize && !sizes.find(s => s.id == selectedSize)) {
                                let name = $event.target.options[$event.target.selectedIndex].text;
                                sizes.push({ id: selectedSize, name: name });
                            }
                            selectedSize = '';
                        "
                        class="w-full select select-bordered">
                        <option value="">-- Select Size --</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>

                    <div class="flex flex-wrap gap-2 mt-2">
                        <template x-for="(size, index) in sizes" :key="index">
                            <span class="flex items-center gap-2 px-3 py-1 text-white bg-green-500 rounded-full">
                                <span x-text="size.name"></span>
                                <button type="button" @click="sizes.splice(index, 1)">✕</button>
                            </span>
                        </template>
                    </div>
                    <template x-for="size in sizes" :key="size.id">
                        <input type="hidden" name="sizes[]" :value="size.id">
                    </template>
                </div>

                <!-- Packaging -->
                <div class="mb-4">
                    <label class="label">Packaging</label>
                    <select x-model="selectedPack"
                        @change="
                            if(selectedPack && !packs.find(p => p.id == selectedPack)) {
                                let name = $event.target.options[$event.target.selectedIndex].text;
                                packs.push({ id: selectedPack, name: name });
                            }
                            selectedPack = '';
                        "
                        class="w-full select select-bordered">
                        <option value="">-- Select Packaging --</option>
                        @foreach ($packagingTypes as $pack)
                            <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                        @endforeach
                    </select>

                    <div class="flex flex-wrap gap-2 mt-2">
                        <template x-for="(pack, index) in packs" :key="index">
                            <span class="flex items-center gap-2 px-3 py-1 text-white bg-purple-500 rounded-full">
                                <span x-text="pack.name"></span>
                                <button type="button" @click="packs.splice(index, 1)">✕</button>
                            </span>
                        </template>
                    </div>
                    <template x-for="pack in packs" :key="pack.id">
                        <input type="hidden" name="packaging[]" :value="pack.id">
                    </template>
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
    </script>

</x-app-layout>
