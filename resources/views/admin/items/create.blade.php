<!-- Create View for Item -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>




    <div class="container mx-auto mt-10" x-data="{ step: 1 }">
        <!-- Tabs Navigation -->
        <div class="mt-6  text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <!-- Step 1 Tab -->
                <li class="me-2">
                    <a href="#" @click.prevent="step = 1" :class="step === 1 ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent'"
                       class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Step 1: Vital Information
                    </a>
                </li>
                <!-- Step 2 Tab -->
                <li class="me-2">
                    <a href="#" @click.prevent="step = 2" :class="step === 2 ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent'"
                       class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Step 2: Packaging Information
                    </a>
                </li>
                <!-- Step 3 Tab -->
                <li class="me-2">
                    <a href="#" @click.prevent="step = 3" :class="step === 3 ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent'"
                       class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Step 3: Variation
                    </a>
                </li>
                <!-- Step 4 Tab -->
                <li class="me-2">
                    <a href="#" @click.prevent="step = 4" :class="step === 4 ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent'"
                       class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Step 4: Price Rules
                    </a>
                </li>
                <!-- Step 5 Tab -->
                <li class="me-2">
                    <a href="#" @click.prevent="step = 5" :class="step === 5 ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent'"
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Step 5: Images
                    </a>
                </li>
            </ul>
        </div>





        <!-- Tab Content -->
        <form id="multiStepForm" @submit.prevent="alert('Form submitted successfully!')">
            <!-- Step 1 Content -->
            <div x-show="step === 1">

                {{-- <div class="mb-4 mt-4">
                    <label for="name" class="block mb-2">Product Name</label>
                    <input type="text" id="name" name="name" class="input input-bordered w-full" required>
                </div> --}}

                <div class="mb-6 mt-4">
                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                    <input type="text" name="name" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name">
                </div>


                <div class="mb-4">
                    {{-- <label for="email" class="block mb-2">Product Describtion</label>
                    <input type="email" id="email" name="email" class="input input-bordered w-full" required> --}}


                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your product description</label>
                    <textarea id="message" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here..."></textarea>


                </div>



                <div class="flex items-center mb-4">
                    <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Category</span>
                </div>

                <div class="flex flex-wrap space-x-4 mb-4">
                    <div class="flex items-center">
                        <input id="office-checkbox" type="checkbox" value="office" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="office-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Office</label>
                    </div>

                    <div class="flex items-center">
                        <input id="school-checkbox" type="checkbox" value="school" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="school-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">School</label>
                    </div>

                    <div class="flex items-center">
                        <input id="kids-checkbox" type="checkbox" value="kids" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="kids-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kids</label>
                    </div>

                    <div class="flex items-center">
                        <input id="gift-checkbox" type="checkbox" value="gift" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="gift-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gift</label>
                    </div>

                    <div class="flex items-center">
                        <input id="government-checkbox" type="checkbox" value="government" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="government-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Government</label>
                    </div>
                </div>








                <button type="button" @click="step = 2" class="btn btn-primary mt-4">Next</button>
            </div>











            <!-- Step 2 Content -->
            <div x-show="step === 2">

                <div class="mb-4 mt-4">
                    <label for="address" class="block mb-2">Product Describtion</label>
                    <input type="text" id="address" name="address" class="input input-bordered w-full" required>
                </div>
                <div class="mb-4">
                    <label for="city" class="block mb-2">City</label>
                    <input type="text" id="city" name="city" class="input input-bordered w-full" required>
                </div>





















                <div x-data="packagingForm()" class="mt-4 space-y-4">
                    <!-- First Packaging Input -->
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <label for="package-name-1" class="block text-sm font-medium text-gray-900 dark:text-white">Packaging Name</label>
                            <input x-model="firstPackagingName" type="text" id="package-name-1" placeholder="Packet" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Holds Label Above Arrow -->
                        <div class="flex items-center justify-center">
                            <span class="text-sm text-gray-500">Holds</span>
                        </div>

                        <!-- Holds Input (Smaller) -->
                        <div class="w-20">
                            <input x-model.number="firstHolds" type="number" id="holds-number" placeholder="Number" class="mt-1 block w-full p-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Arrow Between the Inputs -->
                        <div class="flex items-center justify-center">
                            <span class="text-xl text-gray-500">→</span>
                        </div>

                        <!-- Packaging Name After Holds -->
                        <div class="flex-1">
                            <label for="package-name-2" class="block text-sm font-medium text-gray-900 dark:text-white">Packaging Name</label>
                            <input x-model="secondPackagingName" type="text" id="package-name-2" placeholder="Pieces" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Dynamic Packaging Form Fields -->
                    <template x-for="(item, index) in packagingList" :key="index">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <label :for="'package-name-' + (index + 3)" class="block text-sm font-medium text-gray-900 dark:text-white">Packaging Name</label>
                                <input :id="'package-name-' + (index + 3)" type="text" :placeholder="'Cartoon'" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <!-- Holds Label Above Arrow -->
                            <div class="flex items-center justify-center">
                                <span class="text-sm text-gray-500">Holds</span>
                            </div>

                            <!-- Holds Input (Smaller) -->
                            <div class="w-20">
                                <input x-model.number="item.holds" type="number" :id="'holds-number-' + (index + 3)" placeholder="Number" class="mt-1 block w-full p-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <!-- Arrow Between the Inputs -->
                            <div class="flex items-center justify-center">
                                <span class="text-xl text-gray-500">→</span>
                            </div>

                            <!-- Display the first packaging name in the third field -->
                            <div class="flex-1">
                                <span class="mt-1 block text-sm text-gray-900 dark:text-white" x-text="firstPackagingName"></span>
                            </div>

                            <!-- Cancel (X) Button to remove packaging -->
                            <div class="ml-2">
                                <button @click="removePackaging(index)" class="text-red-500 text-xl">&times;</button>
                            </div>
                        </div>
                    </template>

                    <!-- Result of Holds Multiplication -->
                    <div x-show="firstHolds && packagingList.length > 0" class="mt-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                            <span>Result: </span>
                            <span x-text="calculateTotalHolds()"></span> pieces
                        </div>
                    </div>

                    <!-- Add Packaging Button (Placed at the Bottom) -->
                    <div class="mt-6 text-center">
                        <button @click="addPackaging" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Packaging</button>
                    </div>
                </div>

                <script>
                    function packagingForm() {
                        return {
                            firstPackagingName: 'Packet', // Default value for first packaging name
                            secondPackagingName: 'Pieces', // Default value for second packaging name
                            firstHolds: 50, // Default value for how many pieces in first packaging
                            packagingList: [],
                            addPackaging() {
                                // Add the packaging to the list
                                this.packagingList.push({
                                    name: this.secondPackagingName,
                                    holds: 20, // Default for cartoon holds, can be modified by user
                                });

                                // Clear the second packaging input field after adding
                                this.secondPackagingName = '';
                            },
                            removePackaging(index) {
                                // Remove packaging from the list based on index
                                this.packagingList.splice(index, 1);
                            },
                            calculateTotalHolds() {
                                // Multiply the first holds and the subsequent holds from the list
                                let total = this.firstHolds;

                                this.packagingList.forEach(item => {
                                    total *= item.holds;
                                });

                                return total;
                            }
                        };
                    }
                </script>






















                <div class="flex justify-between">
                    {{-- <button type="button" @click="step = 1" class="btn btn-secondary">Previous</button> --}}
                    <button type="button" @click="step = 3" class="btn btn-primary">Next</button>
                </div>














            </div>













            <!-- Step 3 Content -->
            <div x-show="step === 3">

                <div class="mb-4 mt-4">
                    <label for="cardNumber" class="block mb-2">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" class="input input-bordered w-full" required>
                </div>
                <div class="mb-4">
                    <label for="expiry" class="block mb-2">Expiry Date</label>
                    <input type="text" id="expiry" name="expiry" class="input input-bordered w-full" required>
                </div>
                <div class="flex justify-between">
                    {{-- <button type="button" @click="step = 1" class="btn btn-secondary">Previous</button> --}}
                    <button type="button" @click="step = 4" class="btn btn-primary">Next</button>
                </div>
            </div>

             <!-- Step 4 Content -->
            <div x-show="step === 4">

                <div class="mb-4 mt-4">
                    <label for="cardNumber" class="block mb-2">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" class="input input-bordered w-full" required>
                </div>
                <div class="mb-4">
                    <label for="expiry" class="block mb-2">Expiry Date</label>
                    <input type="text" id="expiry" name="expiry" class="input input-bordered w-full" required>
                </div>
                <div class="flex justify-between">
                    {{-- <button type="button" @click="step = 1" class="btn btn-secondary">Previous</button> --}}
                    <button type="button" @click="step = 5" class="btn btn-primary">Next</button>
                </div>
            </div>

             <!-- Step 5 Content -->
            <div x-show="step === 5">

                <div class="mb-4 mt-4">
                    <label for="cardNumber" class="block mb-2">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" class="input input-bordered w-full" required>
                </div>
                <div class="mb-4">
                    <label for="expiry" class="block mb-2">Expiry Date</label>
                    <input type="text" id="expiry" name="expiry" class="input input-bordered w-full" required>
                </div>
                <div class="flex justify-between">
                    {{-- <button type="button" @click="step = 2" class="btn btn-secondary">Previous</button> --}}
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>
    </div>


{{--





    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Vital Info</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Variation</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Offer</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Images</button>
            </li>
        </ul>
    </div>

    <div id="default-styled-tab-content">
        <!-- Vital Info Tab Content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Form Fields for Vital Info -->
            <form>
                <label for="product_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <label for="product_description" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">Product Description</label>
                <textarea id="product_description" name="product_description" rows="3" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>

                <label class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                <div class="flex space-x-4 mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Kids</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Office</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Gift</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Government</span>
                    </label>
                </div>
            </form>

            <!-- Next Button -->
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 absolute bottom-4 right-4">
                Next
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>

        <!-- Variation Tab Content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <!-- Form Fields for Variation -->
            <form>
                <label for="product_variation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Variation</label>
                <input type="text" id="product_variation" name="product_variation" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </form>

            <!-- Next Button -->
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 absolute bottom-4 right-4">
                Next
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>

        <!-- Offer Tab Content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
            <!-- Form Fields for Offer -->
            <form>
                <label for="product_offer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Offer</label>
                <input type="text" id="product_offer" name="product_offer" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </form>

            <!-- Next Button -->
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 absolute bottom-4 right-4">
                Next
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>

        <!-- Images Tab Content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <!-- Form Fields for Images -->
            <form>
                <label for="product_images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Images</label>
                <input type="file" id="product_images" name="product_images" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </form>
        </div>
    </div>





























    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Vital Info</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Variation</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Offer</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Images</button>
            </li>
        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
    </div>










    <div x-data="{ openTab: 1 }" class="w-full max-w-4xl mx-auto mt-10">
        <!-- Tab Navigation -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                <li class="me-2" role="presentation">
                    <button @click.prevent="openTab = 1" :class="{'text-blue-600 bg-gray-100': openTab === 1}" class="inline-block p-4 border-b-2 rounded-t-lg">Vital Info</button>
                </li>
                <li class="me-2" role="presentation">
                    <button @click.prevent="openTab = 2" :class="{'text-blue-600 bg-gray-100': openTab === 2}" class="inline-block p-4 border-b-2 rounded-t-lg">Variation</button>
                </li>
                <li class="me-2" role="presentation">
                    <button @click.prevent="openTab = 3" :class="{'text-blue-600 bg-gray-100': openTab === 3}" class="inline-block p-4 border-b-2 rounded-t-lg">Offer</button>
                </li>
                <li role="presentation">
                    <button @click.prevent="openTab = 4" :class="{'text-blue-600 bg-gray-100': openTab === 4}" class="inline-block p-4 border-b-2 rounded-t-lg">Images</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div id="default-styled-tab-content">
            <!-- Vital Info Tab -->
            <div x-show="openTab === 1" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <form>
                    <div class="mb-4">
                        <label for="product-name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" id="product-name" name="product_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-4">
                        <label for="product-description" class="block text-sm font-medium text-gray-700">Product Description</label>
                        <textarea id="product-description" name="product_description" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter product description" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="category[]" value="kids" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-sm">Kids</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="category[]" value="office" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-sm">Office</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="category[]" value="gift" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-sm">Gift</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="category[]" value="government" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-sm">Government</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Variation Tab -->
            <div x-show="openTab === 2" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <form>
                    <div class="mb-4">
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                        <input type="text" id="size" name="size" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter size" required>
                    </div>
                    <div class="mb-4">
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter color" required>
                    </div>
                    <div class="mb-4">
                        <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Stock Keeping Unit)</label>
                        <input type="text" id="sku" name="sku" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter SKU" required>
                    </div>
                </form>
            </div>

            <!-- Offer Tab -->
            <div x-show="openTab === 3" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <form>
                    <div class="mb-4">
                        <label for="offer-details" class="block text-sm font-medium text-gray-700">Offer Details</label>
                        <textarea id="offer-details" name="offer_details" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter offer details"></textarea>
                    </div>
                </form>
            </div>

            <!-- Images Tab -->
            <div x-show="openTab === 4" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <form>
                    <div class="mb-4">
                        <label for="product-images" class="block text-sm font-medium text-gray-700">Product Images</label>
                        <input type="file" id="product-images" name="product_images[]" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" multiple>
                    </div>
                </form>
            </div>
        </div>

        <!-- Next Button -->
        <div class="flex justify-end mt-4">
            <button @click.prevent="openTab = openTab < 4 ? openTab + 1 : 4" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                Next
            </button>
        </div>
    </div>

















    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
            </li>
        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
    </div>




    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <li class="me-2">
            <a href="#" aria-current="page" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">Profile</a>
        </li>
        <li class="me-2">
            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Dashboard</a>
        </li>
        <li class="me-2">
            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Settings</a>
        </li>
        <li class="me-2">
            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Contacts</a>
        </li>
        <li>
            <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
        </li>
    </ul>








        <div x-data="{ openTab: 1 }" class="w-full max-w-4xl mx-auto mt-10">
            <!-- Tab Navigation -->
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="me-2">
                    <a href="#" @click.prevent="openTab = 1" :class="{'text-blue-600 bg-gray-100': openTab === 1}" class="inline-block p-4 rounded-t-lg">Vital Info</a>
                </li>
                <li class="me-2">
                    <a href="#" @click.prevent="openTab = 2" :class="{'text-blue-600 bg-gray-100': openTab === 2}" class="inline-block p-4 rounded-t-lg">Variation</a>
                </li>
                <li class="me-2">
                    <a href="#" @click.prevent="openTab = 3" :class="{'text-blue-600 bg-gray-100': openTab === 3}" class="inline-block p-4 rounded-t-lg">Offer</a>
                </li>
                <li class="me-2">
                    <a href="#" @click.prevent="openTab = 4" :class="{'text-blue-600 bg-gray-100': openTab === 4}" class="inline-block p-4 rounded-t-lg">Images</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="mt-6">
                <!-- Vital Info Tab -->
                <div x-show="openTab === 1" class="tab-pane">
                    <form class="space-y-4">
                        <div>
                            <label for="product-name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" id="product-name" name="product_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter product name">
                        </div>
                        <div>
                            <label for="product-description" class="block text-sm font-medium text-gray-700">Product Description</label>
                            <textarea id="product-description" name="product_description" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter product description"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="category[]" value="kids" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    <span class="ml-2 text-sm">Kids</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="category[]" value="office" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    <span class="ml-2 text-sm">Office</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="category[]" value="gift" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    <span class="ml-2 text-sm">Gift</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="category[]" value="government" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    <span class="ml-2 text-sm">Government</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Variation Tab -->
                <div x-show="openTab === 2" class="tab-pane">
                    <p class="text-gray-700">Here you can manage product variations (size, color, etc.).</p>
                </div>

                <!-- Offer Tab -->
                <div x-show="openTab === 3" class="tab-pane">
                    <p class="text-gray-700">Provide details about any special offers for this product.</p>
                </div>

                <!-- Images Tab -->
                <div x-show="openTab === 4" class="tab-pane">
                    <p class="text-gray-700">Upload images for the product here.</p>
                </div>
            </div>
        </div>






        <div class="max-w-4xl mx-auto p-4 bg-white rounded-lg shadow-md">




        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Name Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Product Name</h2>
            <div class="mb-4">
                <label for="name" class="block text-gray-600">Product Name</label>
                <input type="text" id="name" name="name"
                    class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-600">Product Description</label>
                <textarea rows="5" name="description" placeholder="Enter product description"
                    class="w-full p-2 border border-gray-300 rounded-md mt-1"></textarea>
            </div>

            <!-- Category Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Category</h2>
            <div class="mb-4">
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="office" class="form-checkbox text-blue-500">
                        <span class="ml-2">Office</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="school" class="form-checkbox text-blue-500">
                        <span class="ml-2">School</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="cartoon" class="form-checkbox text-blue-500">
                        <span class="ml-2">Kids</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="gift" class="form-checkbox text-blue-500">
                        <span class="ml-2">Gift</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="catoption[]" value="government"
                            class="form-checkbox text-blue-500">
                        <span class="ml-2">Government</span>
                    </label>
                </div>
            </div>

            <!-- Packaging Selling Options Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Packaging Selling Options</h2>
            <div class="mb-4">
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="pieces" class="form-checkbox text-blue-500">
                        <span class="ml-2">Pieces</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="packet" class="form-checkbox text-blue-500">
                        <span class="ml-2">Packet</span>
                    </label>
                    <label class="inline-flex items-center text-gray-600">
                        <input type="checkbox" name="pacoption[]" value="cartoon" class="form-checkbox text-blue-500">
                        <span class="ml-2">Cartoon</span>
                    </label>
                </div>
            </div>

            <!-- Pricing Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Pricing</h2>
            <div class="mb-4">
                <label for="price" class="block text-gray-600">Price</label>
                <input type="number" name="price" min="0"
                    class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>

            <!-- Status Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Status</h2>
            <div class="mb-4">
                <label for="status" class="block text-gray-600">Product Status</label>
                <select name="status" class="w-full p-2 border border-gray-300 rounded-md mt-1">
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
            </div>

            <!-- Stock Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Stock</h2>
            <div class="mb-4">
                <label for="stock" class="block text-gray-600">Stock</label>
                <input type="number" name="stock" min="0" step="1"
                    class="w-full p-2 border border-gray-300 rounded-md mt-1">
            </div>

            <!-- Packaging Standard Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Packaging Standard</h2>
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:gap-4">
                <label for="piecesinapacket" class="sm:w-1/2 text-gray-600">1 Packet Holds</label>
                <input type="number" name="piecesinapacket" min="0" max="1000" step="1"
                    class="w-full sm:w-1/2 p-2 border border-gray-300 rounded-md mt-1">
                <span class="ml-2 text-gray-600">pieces</span>
            </div>
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:gap-4">
                <label for="packetsinacartoon" class="sm:w-1/2 text-gray-600">1 Carton Holds</label>
                <input type="number" name="packetsinacartoon" min="0" max="1000" step="1"
                    class="w-full sm:w-1/2 p-2 border border-gray-300 rounded-md mt-1">
                <span class="ml-2 text-gray-600">packets</span>
            </div>


            <!-- Upload Section -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Upload Images</h2>
            <div class="mb-4">
                <label for="formFileMultiple" class="form-label">Upload Multiple Images</label>
                <input class="form-control w-full p-2 border border-gray-300 rounded-md mt-1" type="file"
                    name="images[]" id="formFileMultiple" multiple>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    Add Product
                </button>
            </div>
        </form>
    </div>
    <div x-data="{ openTab: 1 }" class="w-full max-w-4xl mx-auto mt-10">
        <!-- Tabs -->
        <div class="flex border-b">
            <button
                @click="openTab = 1"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 1}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Tab 1
            </button>
            <button
                @click="openTab = 2"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 2}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Tab 2
            </button>
            <button
                @click="openTab = 3"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 3}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Tab 3
            </button>
        </div>

        <!-- Tab Content -->
        <div class="mt-6">
            <!-- Tab 1 Content -->
            <div x-show="openTab === 1" class="tab-pane">
                <p class="text-gray-700">This is the content for Tab 1. You can add any content here!</p>
            </div>
            <!-- Tab 2 Content -->
            <div x-show="openTab === 2" class="tab-pane">
                <p class="text-gray-700">This is the content for Tab 2. Feel free to modify this content as needed.</p>
            </div>
            <!-- Tab 3 Content -->
            <div x-show="openTab === 3" class="tab-pane">
                <p class="text-gray-700">This is the content for Tab 3. Customize this section for your needs.</p>
            </div>
        </div>
    </div>


    <div x-data="{ openTab: 1 }" class="w-full max-w-4xl mx-auto mt-10">
        <!-- Tab Navigation for desktop -->
        <div class="hidden sm:flex border-b">
            <button
                @click="openTab = 1"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 1}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Sales Orders
            </button>
            <button
                @click="openTab = 2"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 2}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Payments
            </button>
            <button
                @click="openTab = 3"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 3}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Deliveries
            </button>
            <button
                @click="openTab = 4"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 4}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Returns and Refunds
            </button>
            <button
                @click="openTab = 5"
                :class="{'text-blue-600 border-b-2 border-blue-600': openTab === 5}"
                class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-blue-600 focus:outline-none">
                Invoices
            </button>
        </div>

        <!-- Tab Dropdown for mobile -->
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select your tab</label>
            <select
                id="tabs"
                x-model="openTab"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">Sales Orders</option>
                <option value="2">Payments</option>
                <option value="3">Deliveries</option>
                <option value="4">Returns and Refunds</option>
                <option value="5">Invoices</option>
            </select>
        </div>

        <!-- Tab Content -->
        <div class="mt-6">
            <!-- Sales Orders Content -->
            <div x-show="openTab === 1" class="tab-pane">
                <p class="text-gray-700">This is the content for Sales Orders. You can add any content here!</p>
            </div>
            <!-- Payments Content -->
            <div x-show="openTab === 2" class="tab-pane">
                <p class="text-gray-700">This is the content for Payments. Customize this section for your needs.</p>
            </div>
            <!-- Deliveries Content -->
            <div x-show="openTab === 3" class="tab-pane">
                <p class="text-gray-700">This is the content for Deliveries. You can add delivery-related details here.</p>
            </div>
            <!-- Returns and Refunds Content -->
            <div x-show="openTab === 4" class="tab-pane">
                <p class="text-gray-700">This is the content for Returns and Refunds. Add relevant information here.</p>
            </div>
            <!-- Invoices Content -->
            <div x-show="openTab === 5" class="tab-pane">
                <p class="text-gray-700">This is the content for Invoices. Provide invoice details here.</p>
            </div>
        </div>
    </div>


--}}







</x-app-layout>
