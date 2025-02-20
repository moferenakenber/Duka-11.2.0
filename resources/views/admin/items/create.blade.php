<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <script>
        const categories = @json($categories);
    </script>

    {{-- List of expected data

            items -> product_name
                     product_description
                     item_category_id -> foreignId
                     status ['draft', 'active', 'inactive', 'unavailable'] -> default (draft)
                     incomplete -> boolean
                     category_id -> foreignId
                     category_id

            item_packaging_types -> name

            item_colors -> name

            item_sizes -> name

            item_variants -> item_id
                             item_color_id
                             item_size_id
                             item_packaging_type_id
                             item_packaging_types
                             is_active

            item_images -> item_variant_id -> foreignId
                           image_path

            item_variant_packaging_quantity -> item_variant_id -> foreignId
                                               item_packaging_type_id -> foreignId
                                               item_color_id -> foreignId
                                               item_size_id -> foreignId
                                               quantity

            item_owners -> user_id -> foreignId
                           item_id -> foreignId

            item_inventory_locations -> location_name
                                        address
            item_stocks -> item_variant_id -> foreignId
                           item_inventory_location_id -> foreignId
                           quantity

            item_prices -> item_variant_id
                           user_type ['customer', 'seller', 'user', 'visitor']
                           price

            --}}
    <div class="py-12">
        <!-- Alpine x-data (1) -->


        <div x-data="{
            step: 1,
            totalSteps: 5,
            showNewCategory: false,
            productName: '',
            productDescribtion: '',
            newCategoryName: '', // will be reset in createCategory()
            formIsValid: false,

            categories: categories, // Categories passed from Laravel
            selectedCategories: [], // Array to store selected category IDs and names for new categories
            newCategoryNames: [], // Array to store the names of new categories

            packagingOptions: {},
            selectedPackaging: '', // Store the value from the child



            // Variables for item variants on step 2
            //itemVariants: [],
            //selectedVariant: {},
            //selectedPackaging: '',

            quantity: 50,

            //packagingOptions: [],
            //packagingOptions: {},


            createCategory() {
                if (this.newCategoryName.trim() !== '') {
                    const newCategory = { id: `new-${Date.now()}`, category_name: this.newCategoryName };

                    // Add to categories and selected categories
                    this.categories.push(newCategory);
                    this.selectedCategories.push(newCategory);

                    // Store new category name for backend
                    this.newCategoryNames.push(this.newCategoryName);

                    // Reset input and hide
                    this.newCategoryName = '';
                    this.showNewCategory = false;
                } else {
                    alert('Please enter a valid category name.');
                }
            },




            cancelCreation() {
                this.newCategoryName = ''; // Reset input
                this.showNewCategory = false; // Hide the input box
            },

            // Function to toggle category selection
            toggleCategorySelection(category) {
                const index = this.selectedCategories.findIndex(c => c.id === category.id);

                if (index !== -1) {
                    this.selectedCategories.splice(index, 1);
                } else {
                    this.selectedCategories.push(category);
                }
            },


            // Function to check if a category is selected
            isChecked(category) {
                return this.selectedCategories.some(c => c.id === category.id);
            },


            progress() {
                return (this.step / this.totalSteps) * 100;
            },


            checkFormValidity() {
                this.formIsValid =
                    this.productName.trim() !== '' &&
                    (this.selectedCategories.length > 0 || this.newCategoryNames.length > 0);
            },


            saveAsDraft() {
                try {

                    console.log('Starting saveAsDraft method...');

                    const formData = new FormData();

                    console.log('Initial FormData:', Array.from(formData.entries()));

                    formData.append('product_name', this.productName);
                    console.log('Added product_name:', this.productName);

                    formData.append('product_description', this.productDescribtion);
                    console.log('Added product_description:', this.productDescribtion);


                    // Extract new category names from selected categories
                    const newCategoryNames = this.selectedCategories
                        .filter(category => typeof category.id === 'string' && category.id.startsWith('new-')) // Only include new categories
                        .map(category => category.category_name);

                    formData.append('newCategoryNames', JSON.stringify(newCategoryNames));
                    console.log('Added newCategoryNames:', newCategoryNames);

                    // Add all selected categories (existing and new)
                    const selectedCategoryIds = this.selectedCategories.map(category => category.id);
                    formData.append('selectedCategories', JSON.stringify(selectedCategoryIds));
                    console.log('Added selectedCategoryIds:', selectedCategoryIds);


                    // Add the packaging options (as an object)
                    formData.append('packagingOptions', JSON.stringify(this.packagingOptions));
                    console.log('Added packagingOptions:', this.packagingOptions);

                     // Include selectedPackaging from child
                    formData.append('selectedPackaging', this.selectedPackaging);
                    console.log('Added selectedPackaging:', this.selectedPackaging);

                    // Trying to include the packaging quantity
                    formData.append('quantity', this.quantity);
                    console.log('Added quantity:', this.quantity);

                    // Final debug before sending
                    console.log('Final FormData to send:', Array.from(formData.entries()));


                    // Send the FormData using fetch
                    fetch('{{ route('admin.saveDraft') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                //'Content-Type': 'application/json', // Optional, based on your server setup
                            },
                            body: formData
                        })
                        .then(response => {
                            console.log('Fetch response received:', response);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Parsed JSON response:', data);
                            if (data.success) {
                                alert('Your form has been saved as a draft!');
                            } else {
                                console.warn('Error saving draft:', data.error || 'Unknown error');
                                alert('Error saving draft.');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('Error saving draft.');
                        });
                } catch (error) {
                    console.error('Unexpected error in saveAsDraft:', error);
                    alert('An unexpected error occurred.');
                }

            },

        }" @update-packaging-options.window="selectedPackaging = $event.detail.selectedPackaging"
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen overflow-y-auto">

        {{-- <div x-data="{
            step: 1,
            totalSteps: 5,
            showNewCategory: false,
            productName: '',
            productDescribtion: '',
            newCategoryName: '',
            formIsValid: false,

            categories: categories,
            selectedCategories: [],
            newCategoryNames: [],
            packagingOptions: {},
            selectedPackaging: '', // Store the value from the child

            createCategory() { /* same code */ },

            checkFormValidity() { /* same code */ },

            saveAsDraft() {
                try {
                    const formData = new FormData();
                    formData.append('product_name', this.productName);
                    formData.append('product_description', this.productDescribtion);
                    formData.append('packagingOptions', JSON.stringify(this.packagingOptions));

                    // Include selectedPackaging from child
                    formData.append('selectedPackaging', this.selectedPackaging);

                    fetch('{{ route('admin.saveDraft') }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) alert('Draft saved!');
                            else alert('Error saving draft.');
                        })
                        .catch(error => console.error('Fetch error:', error));
                } catch (error) {
                    console.error('Unexpected error:', error);
                    alert('An unexpected error occurred.');
                }
            }

        }"
            @update-packaging-options.window="selectedPackaging = $event.detail.selectedPackaging"
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen overflow-y-auto"> --}}


            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <h3 class="font-semibold">There were some problems with your input:</h3>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <script>
                console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('CSRF Token:', csrfToken); // Verify the token is correct
            </script>

            <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!--------- Multistep form for items--------->

                <!-- Alpine x-data (2) -->
                <div class="max-w-4xl mx-auto p-4 relative min-h-screen overflow-y-auto">

                    <!--------- Step Progress Bar --------->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-sm">Step <span x-text="step"></span> of 5</span>
                            <span class="font-semibold text-sm" x-text="Math.round(progress()) + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" :style="'width: ' + progress() + '%'"></div>
                        </div>
                    </div>

                    <!--------- Tabs for the Form --------->
                    <div class="mb-6">
                        <ul x-ref="tabs" class="flex space-x-4 overflow-x-auto sm:overflow-visible">
                            <li @click="step = 1; $nextTick(() => $refs.tabs.children[0].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                :class="{ 'bg-blue-500 text-white': step === 1 }"
                                class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Vital Information</li>
                            <li @click="step = 2; $nextTick(() => $refs.tabs.children[1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                :class="{ 'bg-blue-500 text-white': step === 2 }"
                                class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Packaging Information</li>
                            <li @click="step = 3; $nextTick(() => $refs.tabs.children[2].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                :class="{ 'bg-blue-500 text-white': step === 3 }"
                                class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Variation</li>
                            <li @click="step = 4; $nextTick(() => $refs.tabs.children[3].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                :class="{ 'bg-blue-500 text-white': step === 4 }"
                                class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Barcode</li>
                            <li @click="step = 5; $nextTick(() => $refs.tabs.children[4].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                :class="{ 'bg-blue-500 text-white': step === 5 }"
                                class="cursor-pointer py-2 px-4 rounded-md flex-shrink-0">Images</li>
                        </ul>
                    </div>

                    <div x-show="step === 1" class="space-y-4">

                        <!-- Product Name Input x-model="productName"  -->
                        <div class="mb-6">
                            <label for="product_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Product Name
                            </label>
                            <input type="text" id="product_name" name="product_name" x-model="productName"
                                value="{{ old('product_name') }}"
                                class="bg-white border border-gray-300 text-gray-900 placeholder-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400 dark:border-gray-600"
                                placeholder="Enter product name" required aria-label="Product Name">
                            @if ($errors->has('product_name'))
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oh, snap!</span> {{ $errors->first('product_name') }}
                                </p>
                            @else
                                <p x-show="productName.length > 0"
                                    class="mt-2 text-sm text-green-600 dark:text-green-500">
                                    <span class="font-medium">Well done!</span> Product name looks good.
                                </p>
                            @endif
                        </div>

                        <!-- Product Description x-model="productDescribtion" -->
                        <div class="mb-6">
                            <label for="product_description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Product Description
                            </label>
                            <textarea id="product_description" name="product_description" x-model="productDescribtion" rows="4"
                                maxlength="200"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write product description here..." required aria-label="Product Description"
                                oninput="updateWordCount()">{{ old('product_description') }}</textarea>
                            <p id="word-count" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <span id="remaining-words">200</span> words remaining
                            </p>
                            @error('product_description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oh, snap!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <script>
                            const maxWords = 200;

                            function updateWordCount() {
                                const textarea = document.getElementById('product_description');
                                const wordCountElement = document.getElementById('remaining-words');
                                const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
                                const remaining = maxWords - words.length;

                                wordCountElement.textContent = remaining;

                                if (remaining < 0) {
                                    wordCountElement.classList.remove('text-gray-600', 'dark:text-gray-400');
                                    wordCountElement.classList.add('text-red-600', 'dark:text-red-500');
                                } else {
                                    wordCountElement.classList.remove('text-red-600', 'dark:text-red-500');
                                    wordCountElement.classList.add('text-gray-600', 'dark:text-gray-400');
                                }
                            }
                        </script>


                        <!-- New catagory with multi select -->
                        {{-- <div class="mb-6" x-data="categoriesApp"> --}}

                        <div class="mb-6">
                            <!-- Debug Button to check categories -->
                            {{-- <button @click="console.log(categories)" class="bg-gray-200 p-2 rounded">Debug Categories</button> --}}

                            <!-- Display Categories in a Preformatted Text Block -->
                            {{-- <pre>{{ $categories }}</pre> --}}

                            <!-- Label for Categories -->
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                Categories</label>

                            <!-- Dropdown + Create Button -->
                            <div class="flex items-center gap-4">
                                <!-- Dropdown Button "Select Categories" -->
                                <div>
                                    <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        Select Categories
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div id="dropdownBgHover"
                                        class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownBgHoverButton">

                                            <!-- Dynamically render categories -->
                                            <template x-for="category in categories" :key="category.id">
                                                <li>
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <!-- Checkbox -->
                                                        <input type="checkbox" :value="category.id"
                                                            @click="toggleCategorySelection(category)"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                            :checked="isChecked(category)" />
                                                        <label
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                                                            x-text="category.category_name"></label>
                                                    </div>
                                                </li>
                                            </template>

                                        </ul>



                                    </div>
                                </div>

                                <!-- Create New Category Button -->
                                <button type="button" @click="showNewCategory = !showNewCategory"
                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Create New Category
                                </button>
                            </div>

                            <!-- New Category Input -->
                            <div x-show="showNewCategory" class="mt-4" x-transition>
                                <label for="new_category_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Category
                                    Name</label>
                                <div class="flex items-center gap-4">
                                    <!-- x-model="newCategoryName" -->
                                    <input type="text" id="new_category_name" x-model="newCategoryName"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter new category name">

                                    <!-- Create Button -->
                                    <button type="button" @click="createCategory()"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Create
                                    </button>

                                    <!-- Cancel Button -->
                                    <button type="button" @click="cancelCreation()"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Cancel
                                    </button>
                                </div>
                                <!-- Hidden select field for new category names -->
                                <select id="new_category_names" name="new_category_names[]"
                                    x-model="newCategoryNames" class="hidden">
                                    <template x-for="name in newCategoryNames" :key="name">
                                        <option :value="name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <!-- Display Selected Categories -->
                        <!-- Display Selected Categories as Plain Text -->
                        <div class="flex flex-wrap items-start">
                            <h3 class="mr-4 inline">Selected Categories:</h3>
                            <template x-for="(category, index) in selectedCategories"
                                :key="category.id + '-' + index">
                                <div class="block ml-4">
                                    <span x-text="category.category_name"></span>
                                </div>
                            </template>
                        </div>

                    </div>


                    <!--------- Step 2: Packaging types and how much they hold --------->
                    <div x-show="step === 2" class="space-y-4">

                        <!-- Alpine x-data (3) -->
                        {{-- <template x-if="step === 2"> --}}

                        <div x-data="{
                            open: false,
                            selectedOption: [],
                            quantity: 50,
                            packagingOptions: {},
                            selectedPackaging: '',
                            dropdownVisible: false,

                            sendPackagingData() {
                                {{-- $dispatch('update-packaging-options', this.packagingOptions); --}}
                                $dispatch('update-packaging-options', { selectedPackaging: this.selectedPackaging });
                            },

                            // Add sendQuantityData() function here


                            init() {
                                console.log('Child component initialized');
                            }


                        }" @change="sendPackagingData()"
                           x-init="init();
                           console.log('Initial state:', { selectedOption, selectedPackaging, quantity })" x-ref="childComponent"
                           class="flex flex-col space-y-4">


                        {{-- <div x-data="{
                            open: false,
                            selectedOption: [],
                            quantity: 50,
                            packagingOptions: {},
                            selectedPackaging: '',
                            dropdownVisible: false,

                            sendPackagingData() {
                                $dispatch('update-packaging-options', { selectedPackaging: this.selectedPackaging });
                            },

                            init() {
                                console.log('Child component initialized');
                            }

                        }" @change="sendPackagingData()"
                            x-init="init();
                            console.log('Initial state:', { selectedOption, selectedPackaging, quantity })"
                            x-ref="childComponent"
                            class="flex flex-col space-y-4"> --}}


                            <!-- Alpine (3) x-show (1)  -->
                            <h3 x-cloak x-show="open"
                                class="flex justify-center items-center text-lg font-semibold pt-6">Packaging types
                                and
                                how much they hold
                            </h3>

                            <!-------- Checked disabled piece -------->
                            <div class="flex items-center pt-4 px-8">
                                <input checked id="readonly-checked-checkbox" type="checkbox" value="piece"
                                    name="packaging[]" x-model="selectedPackaging"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="readonly-checked-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Piece</label>
                            </div>

                            <!-------- Added Checked packaging 1  ---------->

                            <!-- Alpine (3) x-show (2)  -->
                            <div x-show="packagingOptions[selectedOption[0]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="packet"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (1)  -->
                                        <span x-text="selectedOption[0]"></span>
                                    </label>

                                    <!-- Alpine (3) x-text (2)  -->
                                    <p class="ms-4"> - Holds <span x-text="packagingOptions[selectedOption[0]]">
                                        </span>
                                        Pieces.</p>
                                </div>
                            </div>


                            <!---------- Added Checked packaging 2 ----------->

                            <!-- Alpine (3) x-show (3)  -->
                            <div x-show="packagingOptions[selectedOption[1]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="1/4carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (3)  -->
                                        <span x-text="selectedOption[1]"></span>
                                    </label>

                                    <p class="ms-4"> - Holds

                                        <!-- Alpine (3) x-text (4) (5) (6)  -->
                                        <span x-text="packagingOptions[selectedOption[1]]"></span>
                                        <span x-text="selectedOption[0]"></span>s</label> and
                                        <span
                                            x-text="packagingOptions[selectedOption[1]]* packagingOptions[selectedOption[0]]"></span>
                                        </label>
                                        Pieces.
                                    </p>
                                </div>
                            </div>

                            <!-- ------ Added Checked packaging 3 ------  -->

                            <!-- Alpine (3) x-show (4)  -->
                            <div x-show="packagingOptions[selectedOption[2]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="1/2 carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (7)  -->
                                        <span x-text="selectedOption[2]"></span>
                                    </label>

                                    <p class="ms-4"> - Holds

                                        <!-- Alpine (3) x-text (8) (9) (10)  -->
                                        <span x-text="packagingOptions[selectedOption[2]]"></span>
                                        <span x-text="selectedOption[1]"></span>s</label> and
                                        <span
                                            x-text="packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]* packagingOptions[selectedOption[0]]"></span>
                                        </label>
                                        Pieces.
                                    </p>
                                </div>
                            </div>

                            <!-- ------ Added Checked packaging 4 ------  -->

                            <!-- Alpine (3) x-show (5)  -->
                            <div x-show="packagingOptions[selectedOption[3]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (11)  -->
                                        <span x-text="selectedOption[3]"></label>
                                    <p class="ms-4"> - Holds

                                        <!-- Alpine (2) x-text (12) (13) (14) (15)  -->
                                        <span x-text="packagingOptions[selectedOption[3]]"></span>
                                        <span x-text="selectedOption[2]"></span>s</label> and
                                        <span x-text="selectedOption[1]"></span>s</label> and
                                        <span
                                            x-text="packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]*          packagingOptions[selectedOption[0]]"></span>
                                        </label>
                                        Pieces.
                                    </p>
                                </div>
                            </div>

                            <!-- ------ Added Checked packaging 5 ------  -->

                            <!-- Alpine (3) x-show (6)  -->
                            <div x-show="packagingOptions[selectedOption[4]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (16)  -->
                                        <span x-text="selectedOption[4]"></label>
                                    <p class="ms-4"> - Holds

                                        <!-- Alpine (3) x-text (17) (18) (19) (20) (21)  -->
                                        <span x-text="packagingOptions[selectedOption[4]]"></span>
                                        <span x-text="selectedOption[3]"></span>s</label> and
                                        <span x-text="selectedOption[2]"></span>s</label> and
                                        <span x-text="selectedOption[1]"></span>s</label> and

                                        <span
                                            x-text="packagingOptions[selectedOption[4]]*packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]*packagingOptions[selectedOption[0]]"></span>
                                        </label>
                                        Pieces.
                                    </p>
                                </div>
                            </div>

                            <!-- ------ Added Checked packaging 6 ------  -->

                            <!-- Alpine (3) x-show (7)  -->
                            <div x-show="packagingOptions[selectedOption[5]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input checked id="readonly-checked-checkbox" type="checkbox" value="carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    <label for="readonly-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">

                                        <!-- Alpine (3) x-text (22)  -->
                                        <span x-text="selectedOption[5]"></label>
                                    <p class="ms-4"> - Holds

                                        <!-- Alpine (3) x-text (23) (24) (25) (26) (27) (28) -->
                                        <span x-text="packagingOptions[selectedOption[5]]"></span>
                                        <span x-text="selectedOption[4]"></span>s</label> and
                                        <span x-text="selectedOption[3]"></span>s</label> and
                                        <span x-text="selectedOption[2]"></span>s</label> and
                                        <span x-text="selectedOption[1]"></span>s</label> and

                                        <span
                                            x-text="packagingOptions[selectedOption[5]]*packagingOptions[selectedOption[4]]*packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]*packagingOptions[selectedOption[0]]"></span>
                                        </label>
                                        Pieces.
                                    </p>
                                </div>
                            </div>

                            <!-- ------ Sorry can not add anymore packaging! ------ -->

                            <!-- Alpine (3) x-show (8)  -->
                            <div x-show="packagingOptions[selectedOption[6]]">
                                <div class="flex items-center pt-2 px-8">
                                    <input disabled checked id="disabled-checked-checkbox" type="checkbox"
                                        value="carton"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="disabled-checked-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                                    </label>
                                    <p>can not add anymore packaging!</p>
                                </div>
                            </div>


                            <!-- ------ Add packaging button ------ -->

                            <!-- Alpine (3) x-on (1)  -->
                            <button
                                x-on:click="open = !open; dropdownVisible = !dropdownVisible; console.log(open); console.log(dropdownVisible)"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2
                                py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add
                            </button>



                            <!-- ------ Horizontal Checkbox dropdown - Holds number input - Horizontal Checkbox dropdown ------  -->

                            <!-- Alpine (3) x-show (9)  -->
                            <div x-show="dropdownVisible && open" x-transition>


                                <div class="flex flex-col space-y-2">
                                    <div class="flex justify-center w-full">
                                        <div class="flex space-x-2 w-full max-w-4xl">


                                            <!-- Dropdown Radio Button -->

                                            <!-- Alpine x-data (4) -->
                                            <div x-data="{ openDropdown: false }">

                                                <div class="w-1/2">

                                                    <!-- Alpine (4) x-on (1)  -->
                                                    <button @click="openDropdown = !openDropdown"
                                                        id="dropdownBgHoverButton" id="dropdownRadioButton"
                                                        data-dropdown-toggle="dropdownDefaultRadio"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                        type="button" {{-- Alpine (4) x-text (1) --}}
                                                        x-text="selectedOption[selectedOption.length - 1] || 'Packaging options'">
                                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 4 4 4-4" />
                                                        </svg>
                                                    </button>


                                                    <!-- Dropdown menu -->

                                                    <!-- Alpine (4) x-show (1)  -->
                                                    <div x-show="openDropdown" x-transition>

                                                        <div id="dropdownDefaultRadio"
                                                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                                            <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                                                                aria-labelledby="dropdownRadioButton">
                                                                <li>
                                                                    <!-- piece -->
                                                                    <div class="flex items-center">
                                                                        <input checked disabled id="default-radio-1"
                                                                            type="radio" value="piece"
                                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                        <label for="default-radio-1"
                                                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Piece</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <!-- doz -->

                                                                    <!-- Alpine (4) x-on (2)  -->
                                                                    <div
                                                                        @click="selectedOption.push('doz');
                                                                        selectedPackaging = 'doz';
                                                                        openDropdown = false;
                                                                        $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-2" type="radio"
                                                                                value="doz"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-2"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Doz</label>
                                                                        </div>

                                                                    </div>

                                                                </li>
                                                                <li>
                                                                    <!-- bundle -->

                                                                    <!-- Alpine (4) x-on (3)  -->
                                                                    <div
                                                                        @click="selectedOption.push('bundle');
                                                                    selectedPackaging = 'bundle'; openDropdown = false;
                                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="bundle"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bundle</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- packet -->

                                                                    <!-- Alpine (4) x-on (4)  -->
                                                                    <div
                                                                        @click="selectedOption.push('packet');
                                                                    selectedPackaging = 'packet'; openDropdown = false;
                                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="packet"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Packet</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- bag -->

                                                                    <!-- Alpine (4) x-on (5)  -->
                                                                    <div
                                                                        @click="selectedOption.push('bag');
                                                                    selectedPackaging = 'bag';
                                                                    openDropdown = false;
                                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="bag"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bag</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- wrapper -->

                                                                    <!-- Alpine (4) x-on (5)  -->
                                                                    <div
                                                                        @click="selectedOption.push('wrapper');
                                                                    selectedPackaging = 'wrapper';
                                                                    openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="wrapper"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wrapper</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- bottle -->

                                                                    <div
                                                                        @click="selectedOption.push('bottle');
                                                                selectedPackaging = 'bottle';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="bottle"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bottle</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- case -->

                                                                    <div
                                                                        @click="selectedOption.push('case');
                                                                selectedPackaging = 'case';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="case"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Case</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- crate -->

                                                                    <div
                                                                        @click="selectedOption.push('crate');
                                                                selectedPackaging = 'crate';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="crate"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Crate</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- container -->

                                                                    <div
                                                                        @click="selectedOption.push('container');
                                                                selectedPackaging = 'container';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="container"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Container</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- 1/12carton -->

                                                                    <div
                                                                        @click="selectedOption.push('1/12carton');
                                                                selectedPackaging = '1/12carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/12carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/12
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- wrapper -->

                                                                    <div
                                                                        @click="selectedOption.push('1/10carton');
                                                                selectedPackaging = '1/10carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/10carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/10
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- wrapper -->

                                                                    <div
                                                                        @click="selectedOption.push('1/8carton');
                                                                selectedPackaging = '1/8carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/8carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/8
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- 1/6carton -->

                                                                    <div
                                                                        @click="selectedOption.push('1/6carton');
                                                                selectedPackaging = '1/6carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/6carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/6
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- wrapper -->

                                                                    <div
                                                                        @click="selectedOption.push('1/4carton');
                                                                selectedPackaging = '1/4carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/4carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/4
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- 1/2carton -->

                                                                    <div
                                                                        @click="selectedOption.push('1/2carton');
                                                                selectedPackaging = '1/2carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="1/2carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/2
                                                                                Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li>
                                                                    <!-- carton -->

                                                                    <div
                                                                        @click="selectedOption.push('carton');
                                                                selectedPackaging = 'carton';
                                                                openDropdown = false">

                                                                        <div class="flex items-center">
                                                                            <input id="default-radio-3" type="radio"
                                                                                value="carton"
                                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                                            <label for="default-radio-3"
                                                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Carton</label>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>




                                            <!-- Holds number input -->
                                            <div class="w-1/2 pl-2 pt-4">
                                                <form class="max-w-xs mx-auto">
                                                    <label for="counter-input"
                                                        class="relative flex px-8 mb-1 text-sm font-medium text-gray-900 dark:text-white">Holds:</label>
                                                    <div class="relative flex items-center px-8">
                                                        <button
                                                            @click="quantity = quantity > 1 ? quantity - 1 : 1; $nextTick(() => console.log('quantity:', quantity))"
                                                            type="button" id="decrement-button"
                                                            data-input-counter-decrement="counter-input"
                                                            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 2">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 1h16" />
                                                            </svg>
                                                        </button>
                                                        <input x-model="quantity" type="text" id="counter-input"
                                                            data-input-counter
                                                            class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center"
                                                            placeholder="50" value="50" required />
                                                        <button
                                                            @click="quantity = quantity + 1; $nextTick(() => console.log('quantity:', quantity))"
                                                            type="button" id="increment-button"
                                                            data-input-counter-increment="counter-input"
                                                            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 18">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 1v16M1 9h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Packet -->
                                            <div class="flex-1 py-4">
                                                <p class="py-4">
                                                    <!-- Show 'Pieces' for the first selected option -->
                                                    <span
                                                        x-text="selectedOption.length > 0 ? (selectedOption[0] === selectedOption[selectedOption.length - 1] ? 'Piece' : selectedOption[selectedOption.length - 1]) : ''"></span>
                                                    <span
                                                        x-text="selectedOption[selectedOption.length - 1] ? 's.' : ''"></span>
                                                    <!-- Adds 's.' if an option is selected -->
                                                </p>
                                            </div>
                                            <div class="flex-1">
                                                <button
                                                    @click="dropdownVisible = false;
                                                    open = false;
                                                    selectedPackaging && quantity && (
                                                    packagingOptions[selectedPackaging] = quantity,
                                                    $nextTick(() => console.log('Updated packaging options:', packagingOptions))
                                                    )"
                                                    type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2
                                                    py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    +
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                            </div>




                        </div>
                        {{-- </template> --}}
                    </div>


                    <!-- Step 3: Variation -->
                    <div x-show="step === 3" class="space-y-4">
                        <div class="space-y-2">
                            <p class="text-sm font-semibold">Colors</p>

                            <div class="flex items-center space-x-4">

                                <div class="flex items-center">
                                    <input id="white-checkbox" type="checkbox" name="colors[]" value="white"
                                        class="w-4 h-4 text-white bg-gray-100 border-gray-300 rounded focus:ring-white-500 dark:focus:ring-white-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="white-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">White</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="black-checkbox" type="checkbox" name="colors[]" value="black"
                                        class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black-500 dark:focus:ring-black-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="black-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Black</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="red-checkbox" type="checkbox" name="colors[]" value="red"
                                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Red</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="blue-checkbox" type="checkbox" name="colors[]" value="blue"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="blue-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Blue</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="green-checkbox" type="checkbox" name="colors[]" value="green"
                                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="green-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Green</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="purple-checkbox" type="checkbox" name="colors[]" value="purple"
                                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="purple-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Purple</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="teal-checkbox" type="checkbox" name="colors[]" value="teal"
                                        class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="teal-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Teal</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="yellow-checkbox" type="checkbox" name="colors[]" value="yellow"
                                        class="w-4 h-4 text-yellow-400 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="yellow-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yellow</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="orange-checkbox" type="checkbox" name="colors[]" value="orange"
                                        class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="orange-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Orange</label>
                                </div>
                            </div>

                        </div>




                        <div class="space-y-2">
                            <p class="text-sm font-semibold">Size</p>
                            <div class="space-x-4">
                                <label>
                                    <input type="checkbox" name="sizes[]" value="extraSmall" class="mr-2"
                                        {{ in_array('extraSmall', old('sizes', [])) ? 'checked' : '' }}>
                                    Extra Small
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="small" class="mr-2"
                                        {{ in_array('small', old('sizes', [])) ? 'checked' : '' }}>
                                    Small
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="medium" class="mr-2"
                                        {{ in_array('medium', old('sizes', [])) ? 'checked' : '' }}>
                                    Medium
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="large" class="mr-2"
                                        {{ in_array('large', old('sizes', [])) ? 'checked' : '' }}>
                                    Large
                                </label>
                                <label>
                                    <input type="checkbox" name="sizes[]" value="extraLarge" class="mr-2"
                                        {{ in_array('extraLarge', old('sizes', [])) ? 'checked' : '' }}>
                                    Extra Large
                                </label>
                            </div>
                        </div>

                    </div>


                    <!-- Step 4: Price Rules -->
                    <div x-show="step === 4" class="space-y-4">
                        <!-- Price for piece -->
                        <!-- Price per Piece Input (Always Displayed) -->
                        {{-- <div class="flex w-1/3">
                            <label :for="'customer_price_' + index" class="block text-sm font-semibold pr-2">Price per
                                Piece</label>
                            <input type="number" :id="'customer_price_' + index" x-model="layer.price"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                placeholder="Enter price for customer" required>
                            <p class="text-xs text-gray-900 dark:text-white">Price for people who buy pieces</p>
                        </div> --}}

                        <!-- Holds Input (Only for layers after the first one) -->
                        {{-- <template x-if="layer.type !== 'Piece'">
                            <div class="flex w-1/4">
                                <label :for="'holds_' + index" class="block text-sm font-semibold pr-2">Holds</label>
                                <input type="number" :id="'holds_' + index" x-model="layer.holds"
                                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                                    placeholder="Enter amount" required>
                            </div>
                        </template> --}}
                    </div>

                    <!-- Step 5: Images -->
                    <div x-show="step === 5" class="space-y-4">
                        <div>
                            <label for="image_a" class="block text-sm font-semibold">Package A Image</label>
                            <input type="file" id="image_a" name="image_a"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label for="image_b" class="block text-sm font-semibold">Package B Image</label>
                            <input type="file" id="image_b" name="image_b"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label for="image_c" class="block text-sm font-semibold">Package C Image</label>
                            <input type="file" id="image_c" name="image_c"
                                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                    </div>


                    <!-- Add scrolling behavior to Step switch -->
                    {{-- <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between">
                        <!-- Previous Button -->
                        <button x-show="step > 1"
                            @click.prevent="step--; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Previous
                        </button>

                        <!-- Next Button (positioned on the right for step 1 and onwards) -->
                        <button x-show="step < totalSteps"
                            @click.prevent="step++; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md ml-auto">
                            Next
                        </button>

                        <!-- Submit Button -->
                        <button x-show="step === totalSteps" type="submit"
                            class="bg-green-500 text-white py-2 px-4 rounded-md">
                            Submit
                        </button>
                    </div> --}}


                    <!-- Step Buttons -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between">
                        <!-- Previous Button (only visible when step > 1) -->
                        <button x-show="step > 1"
                            @click.prevent="step--; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Previous
                        </button>

                        <!-- Save as Draft and Next Buttons for steps 1-4 -->
                        <div x-show="step >= 1 && step < totalSteps" class="flex space-x-4 ml-auto">
                            <!-- Save as Draft Button (before Next) -->

                            <button type="button" x-show="step < totalSteps"
                                @click.prevent="
                                Alpine.nextTick(() => {
                                    console.log('Checking child component... Current step:', step);
                                    if ($refs.childComponent) {
                                        console.log('Child component available');
                                        $refs.childComponent.sendPackagingData();
                                    } else {
                                        console.error('Child component not available');
                                    }
                                    saveAsDraft();
                                })"
                                class="bg-gray-500 text-white py-2 px-4 rounded-md">
                                Save as Draft
                            </button>




                            <!-- Next Button -->
                            <button x-show="step < totalSteps"
                                @click.prevent="step++; $nextTick(() => $refs.tabs.children[step-1].scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' }))"
                                class="bg-blue-500 text-white py-2 px-4 rounded-md">
                                Next
                            </button>
                        </div>

                        <button type="button" x-show="step === totalSteps" @click.prevent="saveAsDraft()"
                            :disabled="!formIsValid" class="bg-gray-500 text-white py-2 px-4 rounded-md mr-4">
                            Save as Draft
                        </button>


                        <!-- Submit Button (only on the last step) -->
                        <button x-show="step === totalSteps" @click.prevent="submitForm()"
                            class="bg-green-500 text-white py-2 px-4 rounded-md ml-4">
                            Submit
                        </button>
                    </div>


                </div>
            </form>
        </div>
    </div>

</x-app-layout>
