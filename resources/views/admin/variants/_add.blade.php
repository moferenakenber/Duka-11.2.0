 {{-- Add Variant Form --}}
 <div class="p-2 mb-6 rounded-xl bg-base-200" x-data="variantForm()">
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
                         <select x-model="variant.item_packaging_type_id" :name="`variants[${index}][item_packaging_type_id]`"
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
                         <input type="hidden" :name="`variants[${index}][total_pieces]`" :value="variant.totalPieces">
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
                     <button type="button" class="btn btn-error btn-sm" @click="variants.splice(index, 1)">Remove</button>
                 </div>

                 {{-- Save Variant button --}}
                 <div class="w-full mt-2">
                     <button type="submit" class="w-full btn btn-primary sm:w-auto">Save Variant</button>
                 </div>

             </div>
         </template>

     </form>

 </div>
