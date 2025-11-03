<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Item') }}
        </h2>
    </x-slot>




    <div class="max-w-6xl p-4 mx-auto">
        <div class="p-6 shadow-xl bg-base-100 rounded-xl">
            <div x-data="draftForm()">

                <form @submit.prevent="submitDraft($event)">
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
                            <span class="label-text">Barcode</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="barcode" x-ref="barcodeInput"
                                class="w-full input input-bordered" placeholder="Scan or type barcode">

                            <!-- Scan button -->
                            <button type="button" @click="startScan()" class="btn btn-square">
                                <x-lucide-scan-barcode class="w-5 h-5" />
                            </button>
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
                    <div class="mb-4">
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
                        <p class="mt-2 font-semibold text-green-600" x-show="!uploading && images.length">Upload
                            Complete!</p>

                    </div>


                    <!-- Main Category -->
                    <div>
                        <label class="label">
                            <span class="label-text">Main Category</span>
                        </label>
                        <select name="category_id" class="w-full select select-bordered">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
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
                    <div>

                        <!-- Colors -->
                        <div class="mb-4">
                            <label class="label">Colors</label>
                            <select x-model="selectedColor"
                                @change="
                            if(selectedColor && !colors.find(c => c.id == selectedColor)) {
                                let name = $event.target.options[$event.target.selectedIndex].text;
                                colors.push({ id: selectedColor, name: name });
                            }
                            selectedColor = '';
                        "
                                class="w-full select select-bordered">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>

                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(color, index) in colors" :key="index">
                                    <span class="flex items-center gap-2 px-3 py-1 text-white bg-blue-500 rounded-full">
                                        <span x-text="color.name"></span>
                                        <button type="button" @click="colors.splice(index, 1)">✕</button>
                                    </span>
                                </template>
                            </div>
                            <template x-for="color in colors" :key="color.id">
                                <input type="hidden" name="colors[]" :value="color.id">
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
                                    <span
                                        class="flex items-center gap-2 px-3 py-1 text-white bg-green-500 rounded-full">
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
                                    <span
                                        class="flex items-center gap-2 px-3 py-1 text-white bg-purple-500 rounded-full">
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
                        <button type="submit" class="px-6 btn btn-primary">Save Draft</button>
                    </div>
                </form>

                <div x-show="showToast" x-text="message" x-transition
                    class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg top-5 right-5" x-cloak>
                </div>

            </div>
        </div>
    </div>

    <script type="module">
        import {
            BrowserMultiFormatReader
        } from '@zxing/browser';

        function draftForm() {

            return {
                showToast: false,
                message: '',
                images: [],
                uploading: false,
                progress: 0,
                colors: [],
                selectedColor: '',
                sizes: [],
                selectedSize: '',
                packs: [],
                selectedPack: '',

                barcodeReader: null,

                init() {
                    this.barcodeReader = new BrowserMultiFormatReader();
                },

                startScan() {
                    this.barcodeReader
                        .decodeOnceFromVideoDevice(undefined, document.createElement('video')) // temporary video element
                        .then(result => {
                            this.$refs.barcodeInput.value = result.text;
                            this.barcodeReader.reset();
                        })
                        .catch(err => {
                            console.error(err);
                            this.barcodeReader.reset();
                        });
                },


                uploadFiles(event) {
                    this.uploading = true;
                    const files = Array.from(event.target.files);
                    const formData = new FormData();

                    files.forEach(file => {
                        formData.append('product_images[]', file);
                    });

                    axios.post('{{ route('admin.items.uploadImages') }}', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(res => {
                            // res.data.paths contains the uploaded image paths
                            this.images = res.data.paths; // now images[] contains proper URLs
                            this.uploading = false;
                        })
                        .catch(err => {
                            console.error(err);
                            this.uploading = false;
                        });
                },

                submitDraft(event) {
                    let form = event.target;
                    let formData = new FormData(form);

                    axios.post('{{ route('admin.saveDraft') }}', formData)
                        .then(res => {
                            this.message = res.data.message;
                            this.showToast = true;
                            setTimeout(() => this.showToast = false, 3000);
                            setTimeout(() => window.location.href = '{{ route('admin.items.index') }}', 1000);
                        })
                        .catch(err => {
                            this.message = 'Error saving draft';
                            this.showToast = true;
                            setTimeout(() => this.showToast = false, 3000);
                        });
                }
            }
        }
    </script>



    {{-- <div x-data="{ showToast: false, message: '' }" x-show="showToast" x-text="message" x-transition
                                                                                    class="fixed px-4 py-2 text-white bg-green-500 rounded shadow-lg top-5 right-5"
                                                                                    x-cloak>
    </div> --}}



</x-app-layout>
