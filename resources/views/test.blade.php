<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- <body class="font-sans antialiased">
        <body class="bg-gray-100">







{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer>
    </script>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css"
        rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.min.css"
        rel="stylesheet">
</head>

<body class="bg-gray-100"> --}}



{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi Step Form</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.3/dist/flowbite.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head> --}}




<body class="bg-gray-100">
    {{--
  <div x-data="{
      step: 1,
      totalSteps: 5,
      progress() {
          return (this.step / this.totalSteps) * 100;
      }
  }" class="max-w-4xl mx-auto p-8 pb-16">

    <!-- Step Progress Bar -->
    <div class="mb-6">
      <div class="flex items-center justify-between mb-2">
        <span class="font-semibold text-sm">Step <span x-text="step"></span> of 5</span>
        <span class="font-semibold text-sm" x-text="Math.round(progress()) + '%'"></span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-blue-500 h-2 rounded-full" :style="'width: ' + progress() + '%'" ></div>
      </div>
    </div>

    <!-- Tabs for the Form -->
    <div class="mb-6">
      <ul class="flex space-x-4">
        <li @click="step = 1" :class="{'bg-blue-500 text-white': step === 1}" class="cursor-pointer py-2 px-4 rounded-md">Vital Information</li>
        <li @click="step = 2" :class="{'bg-blue-500 text-white': step === 2}" class="cursor-pointer py-2 px-4 rounded-md">Packaging Information</li>
        <li @click="step = 3" :class="{'bg-blue-500 text-white': step === 3}" class="cursor-pointer py-2 px-4 rounded-md">Variation</li>
        <li @click="step = 4" :class="{'bg-blue-500 text-white': step === 4}" class="cursor-pointer py-2 px-4 rounded-md">Price Rules</li>
        <li @click="step = 5" :class="{'bg-blue-500 text-white': step === 5}" class="cursor-pointer py-2 px-4 rounded-md">Images</li>
      </ul>
    </div>

    <!-- Step 1: Vital Information -->
    <div x-show="step === 1" class="space-y-4">
      <div>
        <label for="product_name" class="block text-sm font-semibold">Product Name</label>
        <input type="text" id="product_name" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter product name">
      </div>
      <div>
        <label for="product_description" class="block text-sm font-semibold">Product Description</label>
        <textarea id="product_description" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Write product description here..."></textarea>
      </div>
      <div>
        <label for="status" class="block text-sm font-semibold">Status</label>
        <select id="status" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
          <option value="available">Available</option>
          <option value="unavailable">Unavailable</option>
          <option value="in_stock">In Stock</option>
          <option value="out_of_stock">Out of Stock</option>
        </select>
      </div>
    </div>

    <!-- Step 2: Packaging Information -->
    <div x-show="step === 2" class="space-y-4">
      <div>
        <label for="package_a" class="block text-sm font-semibold">Package A (e.g. packet, doz.)</label>
        <input type="number" id="package_a" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter amount for Package A">
      </div>
      <div>
        <label for="package_b" class="block text-sm font-semibold">Package B (e.g. carton, doz.)</label>
        <input type="number" id="package_b" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter amount for Package B">
      </div>
      <div>
        <p class="text-sm font-semibold">Total Quantity:</p>
        <p id="total_quantity" class="text-sm mt-2">Amount A * Amount B</p>
      </div>
    </div>

    <!-- Step 3: Variation -->
    <div x-show="step === 3" class="space-y-4">
      <div class="space-y-2">
        <p class="text-sm font-semibold">Colors</p>
        <div class="space-x-4">
          <label><input type="checkbox" class="mr-2"> Black</label>
          <label><input type="checkbox" class="mr-2"> White</label>
          <label><input type="checkbox" class="mr-2"> Red</label>
          <label><input type="checkbox" class="mr-2"> Blue</label>
          <label><input type="checkbox" class="mr-2"> Yellow</label>
        </div>
      </div>

      <div class="space-y-2">
        <p class="text-sm font-semibold">Size</p>
        <div class="space-x-4">
          <label><input type="checkbox" class="mr-2"> Small</label>
          <label><input type="checkbox" class="mr-2"> Medium</label>
          <label><input type="checkbox" class="mr-2"> Large</label>
          <label><input type="checkbox" class="mr-2"> Extra Large</label>
        </div>
      </div>
    </div>

    <!-- Step 4: Price Rules -->
    <div x-show="step === 4" class="space-y-4">
      <div>
        <label for="customer_price" class="block text-sm font-semibold">Price for Customer</label>
        <input type="number" id="customer_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter price for customer">
      </div>
      <div>
        <label for="seller_price" class="block text-sm font-semibold">Price for Seller</label>
        <input type="number" id="seller_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter price for seller">
      </div>
      <div>
        <label for="user_price" class="block text-sm font-semibold">Price for User</label>
        <input type="number" id="user_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full" placeholder="Enter price for user">
      </div>
    </div>

    <!-- Step 5: Images -->
    <div x-show="step === 5" class="space-y-4">
      <div>
        <label for="image_a" class="block text-sm font-semibold">Package A Image</label>
        <input type="file" id="image_a" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div>
        <label for="image_b" class="block text-sm font-semibold">Package B Image</label>
        <input type="file" id="image_b" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div>
        <label for="image_c" class="block text-sm font-semibold">Package C Image</label>
        <input type="file" id="image_c" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div>
        <label for="front_page_images" class="block text-sm font-semibold">Front Page Images (up to 5)</label>
        <input type="file" id="front_page_images" multiple class="mt-2 p-2 border border-gray-300 rounded-md w-full">
      </div>
    </div>

  </div>

  <!-- Navigation Buttons -->
  <div class="fixed bottom-0 left-0 right-0 bg-white py-4 px-8 flex justify-between items-center shadow-lg">
    <button @click="step > 1 ? step-- : null" class="bg-gray-300 text-black py-2 px-4 rounded-md" :disabled="step === 1">Previous</button>
    <button @click="step < totalSteps ? step++ : null" class="bg-blue-500 text-white py-2 px-4 rounded-md" :disabled="step === totalSteps">Next</button>
  </div> --}}



  <form action="/submit-endpoint" method="POST" enctype="multipart/form-data">
    <div x-data="{
        step: 1,
        totalSteps: 5,
        progress() {
            return (this.step / this.totalSteps) * 100;
        }
                  }" class="max-w-4xl mx-auto p-8">

        <!-- Step Progress Bar -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="font-semibold text-sm">Step <span x-text="step"></span> of 5</span>
                <span class="font-semibold text-sm" x-text="Math.round(progress()) + '%'"></span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" :style="'width: ' + progress() + '%'"></div>
            </div>
        </div>

        <!-- Tabs for the Form -->
        <div class="mb-6">
            <ul class="flex space-x-4">
                <li @click="step = 1" :class="{ 'bg-blue-500 text-white': step === 1 }"
                    class="cursor-pointer py-2 px-4 rounded-md">Vital
                    Information</li>
                <li @click="step = 2" :class="{ 'bg-blue-500 text-white': step === 2 }"
                    class="cursor-pointer py-2 px-4 rounded-md">Packaging
                    Information</li>
                <li @click="step = 3" :class="{ 'bg-blue-500 text-white': step === 3 }"
                    class="cursor-pointer py-2 px-4 rounded-md">Variation</li>
                <li @click="step = 4" :class="{ 'bg-blue-500 text-white': step === 4 }"
                    class="cursor-pointer py-2 px-4 rounded-md">Price Rules</li>
                <li @click="step = 5" :class="{ 'bg-blue-500 text-white': step === 5 }"
                    class="cursor-pointer py-2 px-4 rounded-md">Images</li>
            </ul>
        </div>

        <!-- Step 1: Vital Information -->
        <div x-show="step === 1" class="space-y-4">
            <div>
                <label for="product_name" class="block text-sm font-semibold">Product Name</label>
                <input type="text" id="product_name" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter product name">
            </div>
            <div>
                <label for="product_description" class="block text-sm font-semibold">Product
                    Description</label>
                <textarea id="product_description" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Write product description here..."></textarea>
            </div>
            <div>
                <label for="status" class="block text-sm font-semibold">Status</label>
                <select id="status" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                    <option value="in_stock">In Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
        </div>

        <!-- Step 2: Packaging Information -->
        <div x-show="step === 2" class="space-y-4">
            <div>
                <label for="package_a" class="block text-sm font-semibold">Package A (e.g. packet,
                    doz.)</label>
                <input type="number" id="package_a" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter amount for Package A">
            </div>
            <div>
                <label for="package_b" class="block text-sm font-semibold">Package B (e.g. carton,
                    doz.)</label>
                <input type="number" id="package_b" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter amount for Package B">
            </div>
            <div>
                <p class="text-sm font-semibold">Total Quantity:</p>
                <p id="total_quantity" class="text-sm mt-2">Amount A * Amount B
                </p>
            </div>
        </div>

        <!-- Step 3: Variation -->
        <div x-show="step === 3" class="space-y-4">
            <div class="space-y-2">
                <p class="text-sm font-semibold">Colors</p>
                <div class="space-x-4">
                    <label><input type="checkbox" class="mr-2"> Black</label>
                    <label><input type="checkbox" class="mr-2"> White</label>
                    <label><input type="checkbox" class="mr-2"> Red</label>
                    <label><input type="checkbox" class="mr-2"> Blue</label>
                    <label><input type="checkbox" class="mr-2"> Yellow</label>
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-sm font-semibold">Size</p>
                <div class="space-x-4">
                    <label><input type="checkbox" class="mr-2"> Small</label>
                    <label><input type="checkbox" class="mr-2"> Medium</label>
                    <label><input type="checkbox" class="mr-2"> Large</label>
                    <label><input type="checkbox" class="mr-2"> Extra
                        Large</label>
                </div>
            </div>
        </div>

        <!-- Step 4: Price Rules -->
        <div x-show="step === 4" class="space-y-4">
            <div>
                <label for="customer_price" class="block text-sm font-semibold">Price for
                    Customer</label>
                <input type="number" id="customer_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter price for customer">
            </div>
            <div>
                <label for="seller_price" class="block text-sm font-semibold">Price for
                    Seller</label>
                <input type="number" id="seller_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter price for seller">
            </div>
            <div>
                <label for="user_price" class="block text-sm font-semibold">Price for User</label>
                <input type="number" id="user_price" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter price for user">
            </div>
        </div>

        <!-- Step 5: Images -->
        <div x-show="step === 5" class="space-y-4">
            <div>
                <label for="image_a" class="block text-sm font-semibold">Package A Image</label>
                <input type="file" id="image_a" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            </div>
            <div>
                <label for="image_b" class="block text-sm font-semibold">Package B Image</label>
                <input type="file" id="image_b" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            </div>
            <div>
                <label for="image_c" class="block text-sm font-semibold">Package C Image</label>
                <input type="file" id="image_c" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            </div>
            <div>
                <label for="front_page_images" class="block text-sm font-semibold">Front Page Images (up
                    to 5)</label>
                <input type="file" id="front_page_images" multiple
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <button @click="step > 1 ? step-- : null" class="bg-gray-300 text-black py-2 px-4 rounded-md"
                :disabled="step === 1">Previous</button>
            <button @click="step < totalSteps ? step++ : null" class="bg-blue-500 text-white py-2 px-4 rounded-md"
                :disabled="step === totalSteps">Next</button>
        </div>

    </div>
  </form>



</body>

</html>

{{-- <div class="max-w-4xl mx-auto mt-8 p-8 bg-white shadow-lg rounded-lg" x-data="formData()" x-init="init()">
    <!-- Progress Bar -->
    <div class="flex justify-between mb-4">
      <div class="flex-1 bg-gray-200 rounded-full h-2">
        <div class="bg-blue-500 h-2 rounded-full" :style="`width: ${progress}%`"></div>
      </div>
    </div>

    <!-- Form Steps -->
    <form @submit.prevent="submitForm">
      <!-- Step 1: Vital Information -->
      <div x-show="step === 1" x-transition>
        <h3 class="text-2xl font-semibold mb-4">Step 1: Vital Information</h3>
        <label class="block text-sm font-medium">Product Name</label>
        <input type="text" class="input input-bordered w-full mt-2" x-model="productName" placeholder="Enter product name">

        <label class="block text-sm font-medium mt-4">Product Description</label>
        <textarea class="input input-bordered w-full mt-2" x-model="productDescription" placeholder="Write product description here..."></textarea>
      </div>

      <!-- Step 2: Packaging Information -->
      <div x-show="step === 2" x-transition>
        <h3 class="text-2xl font-semibold mb-4">Step 2: Packaging Information</h3>
        <!-- Add your packaging fields here -->
        <label class="block text-sm font-medium">Packaging Type</label>
        <input type="text" class="input input-bordered w-full mt-2" x-model="packagingType" placeholder="Enter packaging type">
      </div>

      <!-- Step 3: Variation -->
      <div x-show="step === 3" x-transition>
        <h3 class="text-2xl font-semibold mb-4">Step 3: Variation</h3>
        <!-- Add your variation fields here -->
        <label class="block text-sm font-medium">Color</label>
        <input type="text" class="input input-bordered w-full mt-2" x-model="color" placeholder="Enter color variation">
      </div>

      <!-- Step 4: Price Rules -->
      <div x-show="step === 4" x-transition>
        <h3 class="text-2xl font-semibold mb-4">Step 4: Price Rules</h3>
        <!-- Add your price rule fields here -->
        <label class="block text-sm font-medium">Price</label>
        <input type="number" class="input input-bordered w-full mt-2" x-model="price" placeholder="Enter price">
      </div>

      <!-- Step 5: Images -->
      <div x-show="step === 5" x-transition>
        <h3 class="text-2xl font-semibold mb-4">Step 5: Images</h3>
        <!-- Tabs for Image Selection -->
        <div x-data="{ activeTab: 1 }">
          <ul class="flex space-x-4">
            <li @click="activeTab = 1" :class="{'border-b-2 border-blue-500': activeTab === 1}" class="cursor-pointer py-2">Image 1</li>
            <li @click="activeTab = 2" :class="{'border-b-2 border-blue-500': activeTab === 2}" class="cursor-pointer py-2">Image 2</li>
          </ul>

          <!-- Image Tab Content -->
          <div x-show="activeTab === 1" class="mt-4">
            <input type="file" class="input input-bordered w-full">
            <label class="text-sm mt-2">Upload Image 1</label>
          </div>
          <div x-show="activeTab === 2" class="mt-4">
            <input type="file" class="input input-bordered w-full">
            <label class="text-sm mt-2">Upload Image 2</label>
          </div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="flex justify-between mt-6">
        <button type="button" x-show="step > 1" @click="prevStep" class="btn btn-secondary">Previous</button>
        <button type="button" x-show="step < 5" @click="nextStep" class="btn btn-primary">Next</button>
        <button type="submit" x-show="step === 5" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>

  <script>
    function formData() {
      return {
        step: 1,
        progress: 0,
        productName: '',
        productDescription: '',
        packagingType: '',
        color: '',
        price: '',
        init() {
          this.updateProgress();
        },
        nextStep() {
          if (this.step < 5) {
            this.step++;
            this.updateProgress();
          }
        },
        prevStep() {
          if (this.step > 1) {
            this.step--;
            this.updateProgress();
          }
        },
        updateProgress() {
          this.progress = (this.step - 1) * 25;
        },
        submitForm() {
          alert('Form submitted!');
        }
      };
    }
  </script>

</body>

</html>
































{{-- <!DOCTYPE html>
<html lang="en" data-theme="retro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>



    <div class="container mx-auto mt-6 max-w-sm">

        <h1 class="text-5xl mb-4">Alpine JS World</h1>



    </div>
    <div class="flex gap-5">
        <div>
          <span class="countdown font-mono text-4xl">
            <span style="--value:15;"></span>
          </span>
          days
        </div>
        <div>
          <span class="countdown font-mono text-4xl">
            <span style="--value:10;"></span>
          </span>
          hours
        </div>
        <div>
          <span class="countdown font-mono text-4xl">
            <span style="--value:24;"></span>
          </span>
          min
        </div>
        <div>
          <span class="countdown font-mono text-4xl">
            <span style="--value:${counter};"></span>
          </span>
          sec
        </div>

        <div class="rating">
            <input type="radio" name="rating-1" class="mask mask-star" />
            <input type="radio" name="rating-1" class="mask mask-star" checked="checked" />
            <input type="radio" name="rating-1" class="mask mask-star" />
            <input type="radio" name="rating-1" class="mask mask-star" />
            <input type="radio" name="rating-1" class="mask mask-star" />
          </div>
      </div>


      <div>
        <ul class="steps" id="steps">
          <li class="step step-primary">Register</li>
          <li class="step">Choose plan</li>
          <li class="step">Purchase</li>
          <li class="step">Receive Product</li>
        </ul>

        <!-- Buttons -->
        <div class="mt-4">
          <button class="btn btn-primary" id="nextStep">Next</button>
          <button class="btn btn-secondary" id="prevStep">Previous</button>
        </div>
      </div>

      <script>
                                document.addEventListener("DOMContentLoaded", () => {
                    const steps = document.querySelectorAll(".step");
                    let currentStep = 0;

                    // Update the steps' classes
                    function updateSteps() {
                        steps.forEach((step, index) => {
                        if (index <= currentStep) {
                            step.classList.add("step-primary");
                        } else {
                            step.classList.remove("step-primary");
                        }
                        });
                    }

                    // Move to the next step
                    document.getElementById("nextStep").addEventListener("click", () => {
                        if (currentStep < steps.length - 1) {
                        currentStep++;
                        updateSteps();
                        }
                    });

                    // Move to the previous step
                    document.getElementById("prevStep").addEventListener("click", () => {
                        if (currentStep > 0) {
                        currentStep--;
                        updateSteps();
                        }
                    });

                    // Initialize the steps
                    updateSteps();
                    });

      </script>


                        <div id="inputContainer" class="space-y-4 max-w-xs mx-auto mt-4">
                            <div id="inputContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                <input type="text" class="input input-bordered w-full" placeholder="Enter value" />
                                <button class="btn btn-primary" id="addInput">+</button>
                                </div>
                            </div>
                        </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                const inputContainer = document.getElementById("inputContainer");
                const addInputButton = document.getElementById("addInput");

                // Add a new input field when the "+" button is clicked
                addInputButton.addEventListener("click", () => {
                    const newInputGroup = document.createElement("div");
                    newInputGroup.classList.add("flex", "items-center", "space-x-2", "mt-2");

                    // Create the new input field
                    const newInput = document.createElement("input");
                    newInput.type = "text";
                    newInput.classList.add("input", "input-bordered", "w-full");
                    newInput.placeholder = "Enter value";

                    // Create the remove button
                    const removeButton = document.createElement("button");
                    removeButton.textContent = "−";
                    removeButton.classList.add("btn", "btn-error");

                    // Remove the input field when the "-" button is clicked
                    removeButton.addEventListener("click", () => {
                    newInputGroup.remove();
                    });

                    // Append the new input and remove button to the group
                    newInputGroup.appendChild(newInput);
                    newInputGroup.appendChild(removeButton);

                    // Add the group to the container
                    inputContainer.appendChild(newInputGroup);
                });
                });

            </script>







    <div>
        <div class="navbar bg-base-100">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li><a>Dashboard</a></li>
                        <li><a>User Management</a></li>
                        <li><a>Customers</a></li>
                        <li><a>Products</a></li>
                        <li><a>Sales</a></li>
                        <li><a>Purchases</a></li>
                    </ul>
                </div>
            </div>
            <div class="navbar-center">
                <a class="btn btn-ghost text-xl">daisyUI</a>
            </div>

            <div class="navbar-end">

                <div class="dropdown dropdown-end">
                    <button tabindex="0" role="button" class="btn btn-circle btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a>Add Cart</a></li>
                        <li><a>Add Customer</a></li>
                        <li><a>Add Product</a></li>
                        <li><a>Add Delivery</a></li>
                        <li><a>Add Purchase order</a></li>
                    </ul>
                </div>

                <div class="dropdown dropdown-end">

                    <button class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <button class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                    </button>

                </div>
            </div>
        </div>



        <div class="flex h-screen">
            <!-- Other content -->
            <div class="flex-1 bg-[#E8EBEE]">
                <!-- Content inside the div -->

                <div class="">

                </div>

                <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
                    navbar-main="" navbar-scroll="true">

                    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                        <nav>
                            <!-- breadcrumb -->
                            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                                <li class="text-sm leading-normal">
                                    <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                                </li>
                                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                                    aria-current="page">Tables</li>
                            </ol>
                            <h6 class="mb-0 font-bold capitalize">Tables</h6>
                        </nav>

                        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                            <div class="flex items-center md:ml-auto md:pr-4">
                                <div
                                    class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                                    <span
                                        class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </span>
                                    <input type="text"
                                        class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Type here...">
                                </div>
                            </div>

                            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                                <!-- online builder btn  -->
                                <li class="flex items-center">
                                    <a href="../pages/sign-in.html"
                                        class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                                        <i class="fa fa-user sm:mr-1" aria-hidden="true"></i>
                                        <span class="hidden sm:inline">Sign In</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Blue</td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Purple</td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Red</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="bg-base-200">
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Blue</td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Purple</td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Red</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Blue</td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover">
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Purple</td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Red</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Blue</td>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Purple</td>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Red</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                    </th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                    </th>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                                        alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Hart Hagerty</div>
                                                <div class="text-sm opacity-50">United States</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Zemlak, Daniel and Leannon
                                        <br />
                                        <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                                    </td>
                                    <td>Purple</td>
                                    <th>
                                        <button class="btn btn-ghost btn-xs">details</button>
                                    </th>
                                </tr>
                                <!-- row 2 -->
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                    </th>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                                                        alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Brice Swyre</div>
                                                <div class="text-sm opacity-50">China</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Carroll Group
                                        <br />
                                        <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                                    </td>
                                    <td>Red</td>
                                    <th>
                                        <button class="btn btn-ghost btn-xs">details</button>
                                    </th>
                                </tr>
                                <!-- row 3 -->
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                    </th>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                                                        alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Marjy Ferencz</div>
                                                <div class="text-sm opacity-50">Russia</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Rowe-Schoen
                                        <br />
                                        <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                                    </td>
                                    <td>Crimson</td>
                                    <th>
                                        <button class="btn btn-ghost btn-xs">details</button>
                                    </th>
                                </tr>
                                <!-- row 4 -->
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                    </th>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                                                        alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">Yancy Tear</div>
                                                <div class="text-sm opacity-50">Brazil</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Wyman-Ledner
                                        <br />
                                        <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                                    </td>
                                    <td>Indigo</td>
                                    <th>
                                        <button class="btn btn-ghost btn-xs">details</button>
                                    </th>
                                </tr>
                            </tbody>
                            <!-- foot -->
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Favorite Color</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>




                    <div class="overflow-x-auto">
                        <table class="table table-xs">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>company</th>
                                    <th>location</th>
                                    <th>Last Login</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Littel, Schaden and Vandervort</td>
                                    <td>Canada</td>
                                    <td>12/16/2020</td>
                                    <td>Blue</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Zemlak, Daniel and Leannon</td>
                                    <td>United States</td>
                                    <td>12/5/2020</td>
                                    <td>Purple</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Carroll Group</td>
                                    <td>China</td>
                                    <td>8/15/2020</td>
                                    <td>Red</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Marjy Ferencz</td>
                                    <td>Office Assistant I</td>
                                    <td>Rowe-Schoen</td>
                                    <td>Russia</td>
                                    <td>3/25/2021</td>
                                    <td>Crimson</td>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td>Yancy Tear</td>
                                    <td>Community Outreach Specialist</td>
                                    <td>Wyman-Ledner</td>
                                    <td>Brazil</td>
                                    <td>5/22/2020</td>
                                    <td>Indigo</td>
                                </tr>
                                <tr>
                                    <th>6</th>
                                    <td>Irma Vasilik</td>
                                    <td>Editor</td>
                                    <td>Wiza, Bins and Emard</td>
                                    <td>Venezuela</td>
                                    <td>12/8/2020</td>
                                    <td>Purple</td>
                                </tr>
                                <tr>
                                    <th>7</th>
                                    <td>Meghann Durtnal</td>
                                    <td>Staff Accountant IV</td>
                                    <td>Schuster-Schimmel</td>
                                    <td>Philippines</td>
                                    <td>2/17/2021</td>
                                    <td>Yellow</td>
                                </tr>
                                <tr>
                                    <th>8</th>
                                    <td>Sammy Seston</td>
                                    <td>Accountant I</td>
                                    <td>O'Hara, Welch and Keebler</td>
                                    <td>Indonesia</td>
                                    <td>5/23/2020</td>
                                    <td>Crimson</td>
                                </tr>
                                <tr>
                                    <th>9</th>
                                    <td>Lesya Tinham</td>
                                    <td>Safety Technician IV</td>
                                    <td>Turner-Kuhlman</td>
                                    <td>Philippines</td>
                                    <td>2/21/2021</td>
                                    <td>Maroon</td>
                                </tr>
                                <tr>
                                    <th>10</th>
                                    <td>Zaneta Tewkesbury</td>
                                    <td>VP Marketing</td>
                                    <td>Sauer LLC</td>
                                    <td>Chad</td>
                                    <td>6/23/2020</td>
                                    <td>Green</td>
                                </tr>
                                <tr>
                                    <th>11</th>
                                    <td>Andy Tipple</td>
                                    <td>Librarian</td>
                                    <td>Hilpert Group</td>
                                    <td>Poland</td>
                                    <td>7/9/2020</td>
                                    <td>Indigo</td>
                                </tr>
                                <tr>
                                    <th>12</th>
                                    <td>Sophi Biles</td>
                                    <td>Recruiting Manager</td>
                                    <td>Gutmann Inc</td>
                                    <td>Indonesia</td>
                                    <td>2/12/2021</td>
                                    <td>Maroon</td>
                                </tr>
                                <tr>
                                    <th>13</th>
                                    <td>Florida Garces</td>
                                    <td>Web Developer IV</td>
                                    <td>Gaylord, Pacocha and Baumbach</td>
                                    <td>Poland</td>
                                    <td>5/31/2020</td>
                                    <td>Purple</td>
                                </tr>
                                <tr>
                                    <th>14</th>
                                    <td>Maribeth Popping</td>
                                    <td>Analyst Programmer</td>
                                    <td>Deckow-Pouros</td>
                                    <td>Portugal</td>
                                    <td>4/27/2021</td>
                                    <td>Aquamarine</td>
                                </tr>
                                <tr>
                                    <th>15</th>
                                    <td>Moritz Dryburgh</td>
                                    <td>Dental Hygienist</td>
                                    <td>Schiller, Cole and Hackett</td>
                                    <td>Sri Lanka</td>
                                    <td>8/8/2020</td>
                                    <td>Crimson</td>
                                </tr>
                                <tr>
                                    <th>16</th>
                                    <td>Reid Semiras</td>
                                    <td>Teacher</td>
                                    <td>Sporer, Sipes and Rogahn</td>
                                    <td>Poland</td>
                                    <td>7/30/2020</td>
                                    <td>Green</td>
                                </tr>
                                <tr>
                                    <th>17</th>
                                    <td>Alec Lethby</td>
                                    <td>Teacher</td>
                                    <td>Reichel, Glover and Hamill</td>
                                    <td>China</td>
                                    <td>2/28/2021</td>
                                    <td>Khaki</td>
                                </tr>
                                <tr>
                                    <th>18</th>
                                    <td>Aland Wilber</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Kshlerin, Rogahn and Swaniawski</td>
                                    <td>Czech Republic</td>
                                    <td>9/29/2020</td>
                                    <td>Purple</td>
                                </tr>
                                <tr>
                                    <th>19</th>
                                    <td>Teddie Duerden</td>
                                    <td>Staff Accountant III</td>
                                    <td>Pouros, Ullrich and Windler</td>
                                    <td>France</td>
                                    <td>10/27/2020</td>
                                    <td>Aquamarine</td>
                                </tr>
                                <tr>
                                    <th>20</th>
                                    <td>Lorelei Blackstone</td>
                                    <td>Data Coordiator</td>
                                    <td>Witting, Kutch and Greenfelder</td>
                                    <td>Kazakhstan</td>
                                    <td>6/3/2020</td>
                                    <td>Red</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>company</th>
                                    <th>location</th>
                                    <th>Last Login</th>
                                    <th>Favorite Color</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>



                    <div class="h-96 overflow-x-auto">
                        <table class="table table-pin-rows">
                            <thead>
                                <tr>
                                    <th>A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ant-Man</td>
                                </tr>
                                <tr>
                                    <td>Aquaman</td>
                                </tr>
                                <tr>
                                    <td>Asterix</td>
                                </tr>
                                <tr>
                                    <td>The Atom</td>
                                </tr>
                                <tr>
                                    <td>The Avengers</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>B</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Batgirl</td>
                                </tr>
                                <tr>
                                    <td>Batman</td>
                                </tr>
                                <tr>
                                    <td>Batwoman</td>
                                </tr>
                                <tr>
                                    <td>Black Canary</td>
                                </tr>
                                <tr>
                                    <td>Black Panther</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>C</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Captain America</td>
                                </tr>
                                <tr>
                                    <td>Captain Marvel</td>
                                </tr>
                                <tr>
                                    <td>Catwoman</td>
                                </tr>
                                <tr>
                                    <td>Conan the Barbarian</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Daredevil</td>
                                </tr>
                                <tr>
                                    <td>The Defenders</td>
                                </tr>
                                <tr>
                                    <td>Doc Savage</td>
                                </tr>
                                <tr>
                                    <td>Doctor Strange</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>E</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Elektra</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>F</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fantastic Four</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>G</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ghost Rider</td>
                                </tr>
                                <tr>
                                    <td>Green Arrow</td>
                                </tr>
                                <tr>
                                    <td>Green Lantern</td>
                                </tr>
                                <tr>
                                    <td>Guardians of the Galaxy</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>H</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hawkeye</td>
                                </tr>
                                <tr>
                                    <td>Hellboy</td>
                                </tr>
                                <tr>
                                    <td>Incredible Hulk</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>I</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Iron Fist</td>
                                </tr>
                                <tr>
                                    <td>Iron Man</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>M</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Marvelman</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>R</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Robin</td>
                                </tr>
                                <tr>
                                    <td>The Rocketeer</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>S</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>The Shadow</td>
                                </tr>
                                <tr>
                                    <td>Spider-Man</td>
                                </tr>
                                <tr>
                                    <td>Sub-Mariner</td>
                                </tr>
                                <tr>
                                    <td>Supergirl</td>
                                </tr>
                                <tr>
                                    <td>Superman</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>T</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Teenage Mutant Ninja Turtles</td>
                                </tr>
                                <tr>
                                    <td>Thor</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>W</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>The Wasp</td>
                                </tr>
                                <tr>
                                    <td>Watchmen</td>
                                </tr>
                                <tr>
                                    <td>Wolverine</td>
                                </tr>
                                <tr>
                                    <td>Wonder Woman</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>X</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>X-Men</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Z</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Zatanna</td>
                                </tr>
                                <tr>
                                    <td>Zatara</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="overflow-x-auto">
                        <table class="table table-xs table-pin-rows table-pin-cols">
                            <thead>
                                <tr>
                                    <th></th>
                                    <td>Name</td>
                                    <td>Job</td>
                                    <td>company</td>
                                    <td>location</td>
                                    <td>Last Login</td>
                                    <td>Favorite Color</td>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Littel, Schaden and Vandervort</td>
                                    <td>Canada</td>
                                    <td>12/16/2020</td>
                                    <td>Blue</td>
                                    <th>1</th>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Hart Hagerty</td>
                                    <td>Desktop Support Technician</td>
                                    <td>Zemlak, Daniel and Leannon</td>
                                    <td>United States</td>
                                    <td>12/5/2020</td>
                                    <td>Purple</td>
                                    <th>2</th>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Brice Swyre</td>
                                    <td>Tax Accountant</td>
                                    <td>Carroll Group</td>
                                    <td>China</td>
                                    <td>8/15/2020</td>
                                    <td>Red</td>
                                    <th>3</th>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Marjy Ferencz</td>
                                    <td>Office Assistant I</td>
                                    <td>Rowe-Schoen</td>
                                    <td>Russia</td>
                                    <td>3/25/2021</td>
                                    <td>Crimson</td>
                                    <th>4</th>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td>Yancy Tear</td>
                                    <td>Community Outreach Specialist</td>
                                    <td>Wyman-Ledner</td>
                                    <td>Brazil</td>
                                    <td>5/22/2020</td>
                                    <td>Indigo</td>
                                    <th>5</th>
                                </tr>
                                <tr>
                                    <th>6</th>
                                    <td>Irma Vasilik</td>
                                    <td>Editor</td>
                                    <td>Wiza, Bins and Emard</td>
                                    <td>Venezuela</td>
                                    <td>12/8/2020</td>
                                    <td>Purple</td>
                                    <th>6</th>
                                </tr>
                                <tr>
                                    <th>7</th>
                                    <td>Meghann Durtnal</td>
                                    <td>Staff Accountant IV</td>
                                    <td>Schuster-Schimmel</td>
                                    <td>Philippines</td>
                                    <td>2/17/2021</td>
                                    <td>Yellow</td>
                                    <th>7</th>
                                </tr>
                                <tr>
                                    <th>8</th>
                                    <td>Sammy Seston</td>
                                    <td>Accountant I</td>
                                    <td>O'Hara, Welch and Keebler</td>
                                    <td>Indonesia</td>
                                    <td>5/23/2020</td>
                                    <td>Crimson</td>
                                    <th>8</th>
                                </tr>
                                <tr>
                                    <th>9</th>
                                    <td>Lesya Tinham</td>
                                    <td>Safety Technician IV</td>
                                    <td>Turner-Kuhlman</td>
                                    <td>Philippines</td>
                                    <td>2/21/2021</td>
                                    <td>Maroon</td>
                                    <th>9</th>
                                </tr>
                                <tr>
                                    <th>10</th>
                                    <td>Zaneta Tewkesbury</td>
                                    <td>VP Marketing</td>
                                    <td>Sauer LLC</td>
                                    <td>Chad</td>
                                    <td>6/23/2020</td>
                                    <td>Green</td>
                                    <th>10</th>
                                </tr>
                                <tr>
                                    <th>11</th>
                                    <td>Andy Tipple</td>
                                    <td>Librarian</td>
                                    <td>Hilpert Group</td>
                                    <td>Poland</td>
                                    <td>7/9/2020</td>
                                    <td>Indigo</td>
                                    <th>11</th>
                                </tr>
                                <tr>
                                    <th>12</th>
                                    <td>Sophi Biles</td>
                                    <td>Recruiting Manager</td>
                                    <td>Gutmann Inc</td>
                                    <td>Indonesia</td>
                                    <td>2/12/2021</td>
                                    <td>Maroon</td>
                                    <th>12</th>
                                </tr>
                                <tr>
                                    <th>13</th>
                                    <td>Florida Garces</td>
                                    <td>Web Developer IV</td>
                                    <td>Gaylord, Pacocha and Baumbach</td>
                                    <td>Poland</td>
                                    <td>5/31/2020</td>
                                    <td>Purple</td>
                                    <th>13</th>
                                </tr>
                                <tr>
                                    <th>14</th>
                                    <td>Maribeth Popping</td>
                                    <td>Analyst Programmer</td>
                                    <td>Deckow-Pouros</td>
                                    <td>Portugal</td>
                                    <td>4/27/2021</td>
                                    <td>Aquamarine</td>
                                    <th>14</th>
                                </tr>
                                <tr>
                                    <th>15</th>
                                    <td>Moritz Dryburgh</td>
                                    <td>Dental Hygienist</td>
                                    <td>Schiller, Cole and Hackett</td>
                                    <td>Sri Lanka</td>
                                    <td>8/8/2020</td>
                                    <td>Crimson</td>
                                    <th>15</th>
                                </tr>
                                <tr>
                                    <th>16</th>
                                    <td>Reid Semiras</td>
                                    <td>Teacher</td>
                                    <td>Sporer, Sipes and Rogahn</td>
                                    <td>Poland</td>
                                    <td>7/30/2020</td>
                                    <td>Green</td>
                                    <th>16</th>
                                </tr>
                                <tr>
                                    <th>17</th>
                                    <td>Alec Lethby</td>
                                    <td>Teacher</td>
                                    <td>Reichel, Glover and Hamill</td>
                                    <td>China</td>
                                    <td>2/28/2021</td>
                                    <td>Khaki</td>
                                    <th>17</th>
                                </tr>
                                <tr>
                                    <th>18</th>
                                    <td>Aland Wilber</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Kshlerin, Rogahn and Swaniawski</td>
                                    <td>Czech Republic</td>
                                    <td>9/29/2020</td>
                                    <td>Purple</td>
                                    <th>18</th>
                                </tr>
                                <tr>
                                    <th>19</th>
                                    <td>Teddie Duerden</td>
                                    <td>Staff Accountant III</td>
                                    <td>Pouros, Ullrich and Windler</td>
                                    <td>France</td>
                                    <td>10/27/2020</td>
                                    <td>Aquamarine</td>
                                    <th>19</th>
                                </tr>
                                <tr>
                                    <th>20</th>
                                    <td>Lorelei Blackstone</td>
                                    <td>Data Coordinator</td>
                                    <td>Witting, Kutch and Greenfelder</td>
                                    <td>Kazakhstan</td>
                                    <td>6/3/2020</td>
                                    <td>Red</td>
                                    <th>20</th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <td>Name</td>
                                    <td>Job</td>
                                    <td>company</td>
                                    <td>location</td>
                                    <td>Last Login</td>
                                    <td>Favorite Color</td>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>


                <div class="flex justify-center p-6">
                    <button class="btn">Button</button>
                </div>




                <form action="{{ route('admin.items.store') }}" method="POST"
                    class="space-y-4 p-6 bg-gray-100 rounded-md">
                    @csrf
                    <!-- Item Name -->
                    <div class="flex flex-col">
                        <label for="name" class="font-medium text-gray-700">Item Name</label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 p-2 border rounded-md" placeholder="Enter item name">
                    </div>

                    <!-- Pieces in a box -->
                    <div class="flex flex-col">
                        <label for="pieces_per_box" class="font-medium text-gray-700">Pieces per Box</label>
                        <input type="number" id="pieces_per_box" name="pieces_per_box" min="1" required
                            class="mt-1 p-2 border rounded-md" placeholder="Number of pieces in a single box">
                    </div>

                    <!-- Boxes in a larger box -->
                    <div class="flex flex-col">
                        <label for="boxes_per_large_box" class="font-medium text-gray-700">Boxes per Larger
                            Box</label>
                        <input type="number" id="boxes_per_large_box" name="boxes_per_large_box" min="1"
                            required class="mt-1 p-2 border rounded-md" placeholder="Number of boxes in a larger box">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Save Item
                        </button>
                    </div>
                </form>








            </div>
        </div>

        <div x-data="{ activeTab: 1 }">
            <!-- Tab Buttons (if you already have them) -->
            <div>
                <button :class="{ 'active': activeTab === 1 }" @click="activeTab = 1">Tab 1</button>
                <button :class="{ 'active': activeTab === 2 }" @click="activeTab = 2">Tab 2</button>
                <button :class="{ 'active': activeTab === 3 }" @click="activeTab = 3">Tab 3</button>
            </div>

            <!-- Tab Contents -->
            <div>
                <div x-show="activeTab === 1" class="tab-content">
                    <h2>Content for Tab 1</h2>
                    <p>This is the content for Tab 1.</p>
                </div>
                <div x-show="activeTab === 2" class="tab-content">
                    <h2>Content for Tab 2</h2>
                    <p>This is the content for Tab 2.</p>
                </div>
                <div x-show="activeTab === 3" class="tab-content">
                    <h2>Content for Tab 3</h2>
                    <p>This is the content for Tab 3.</p>
                </div>
            </div>
        </div>




</body>

</html> --}}
