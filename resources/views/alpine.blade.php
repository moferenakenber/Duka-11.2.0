<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>








    <div class="row">
        <div class="col-6 mx-auto">
            <div x-date = "{ open:true }" class="container">
                <div class="p-3 text-center border">Centered Horizontally</div>
                <p x-show="!open" class="p-3 text-center border">Hello from alpine</p>
                <button x-on="!open" class="p-3 text-center border"> ON or OFF </button>

                {{-- Data-less Alpine --}}
                <button x-data @click="alert('I\'ve been clicked!')">Click Me</button>
            </div>
        </div>
    </div>




    {{-- Text content Alpine makes it easy to control the text content of an element with the x-text directive. --}}

    <div x-data="{ title: 'Start Here' }">
        <h4>x-text</h4>
        <div x-text="title"></div>
    </div>

    {{-- Here is  a basic component --}}

    <div x-data="{ open: true }">

        <button @click="open = ! open" class="p-3 text-center border">Toggle</button>

        <span x-show="open">Contents</span>

        <div x-show="open">
            Content...
        </div>

    </div>


    {{-- x-if - Here is the same toggle from before, but this time using x-if instead of x-show. --}}

    {{-- Notice that x-if must be declared on a <template> tag. This is so that Alpine can leverage the existing browser behavior of the <template> element and use it as the source of the target <div> to be added and removed from the page. --}}

    <div x-data="{ open: false }">
        <button @click="open = ! open" class="p-3 text-center border">Expand</button>

        <template x-if="open">
            <div>
                Content...
            </div>
        </template>
    </div>


    {{-- Toggling with transitions --}}

    <div x-data="{ open: false }">
        <button @click="open = ! open" class="p-3 text-center border">Expands</button>

        <div x-show="open" x-transition>
            Content...
        </div>

        <div x-show="open" x-transition.duration.500ms>
            Content...
        </div>

        <div x-show="open" x-transition.duration.1000ms>
            Content...
        </div>

        <div x-show="open" x-transition:enter.duration.500ms x-transition:leave.duration.1000ms>
            Content...
        </div>

        <div x-show="open" x-transition.opacity>
            Content...
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90">
            Content...
        </div>

    </div>


    {{-- Binding attributes You can add HTML attributes like class, style, disabled, etc... to elements in Alpine using the x-bind directive.

        Here is an example of a dynamically bound class attribute: --}}


    <button x-data="{ red: false }" x-bind:class="red ? 'bg-red' : ''" @click="red = ! red">

        Toggle Red

    </button>

    {{-- As a shortcut, you can leave out the x-bind and use the shorthand : syntax directly: --}}

    <button ... :class="red ? 'bg-red' : ''">
    </button>

    <div x-data="{ statuses: ['open', 'closed', 'archived'] }">
        <template x-for="status in statuses">
            <div x-text="status"></div>
        </template>
    </div>

    <button x-data="{ open: true }" @click="open = false" x-show="open">
        Hide Me
    </button>

























    <div x-data="{
        open: false,
        selectedOption: [],
        quantity: 50,
        packagingOptions: {},
        selectedPackaging: '',
        dropdownVisible: false

    }" x-init="console.log('Initial state:', { selectedOption, selectedPackaging, quantity })" class="flex flex-col space-y-4">




        <h3 x-cloak x-show="open" class="flex justify-center items-center text-lg font-semibold pt-6">Packaging types
            and
            how much they hold
        </h3>

        <!-- Checked disabled piece -->
        <div class="flex items-center pt-4 px-8">
            <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="piece"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disabled-checked-checkbox"
                class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Piece</label>
        </div>

        <!-- Checked packet -->
        <div x-show="packagingOptions[selectedOption[0]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="packet"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[0]"></span>
                </label>
                <p class="ms-4"> - Holds <span x-text="packagingOptions[selectedOption[0]]"></span>
                    Pieces.</p>
            </div>
        </div>


        <!-- Checked cartoon -->
        <div x-show="packagingOptions[selectedOption[1]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="1/4 carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[1]"></span></label>
                <p class="ms-4"> - Holds <span x-text="packagingOptions[selectedOption[1]]"></span>
                    <span x-text="selectedOption[0]"></span>s</label> and <span
                        x-text="packagingOptions[selectedOption[1]]* packagingOptions[selectedOption[0]]"></span></label>
                    Pieces.
                </p>
            </div>
        </div>

        <!-- Checked 1/2 cartoon -->
        <div x-show="packagingOptions[selectedOption[2]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="1/2 carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[2]"></span></label>
                <p class="ms-4"> - Holds <span x-text="packagingOptions[selectedOption[2]]"></span>
                    <span x-text="selectedOption[1]"></span>s</label> and <span
                        x-text="packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]* packagingOptions[selectedOption[0]]"></span></label>
                    Pieces.
                </p>
            </div>
        </div>

        <!-- Checked cartoon -->

        <div x-show="packagingOptions[selectedOption[3]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[3]"></label>
                <p class="ms-4"> - Holds <span x-text="packagingOptions[selectedOption[3]]"></span> <span
                        x-text="selectedOption[2]"></span>s</label> and <span
                        x-text="selectedOption[1]"></span>s</label> and <span
                        x-text="packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]* packagingOptions[selectedOption[0]]"></span></label>
                    Pieces.</p>
            </div>
        </div>

        <!-- Checked cartoon -->

        <div x-show="packagingOptions[selectedOption[4]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[4]"></label>
                <p class="ms-4"> - Holds 20 Packets and<span
                        x-text=packagingOptions[selectedOption[4]]*packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]*
                        packagingOptions[selectedOption[0]]"></span></label>
                    Pieces.</p>
            </div>
        </div>
        <!-- Checked cartoon -->

        <div x-show="packagingOptions[selectedOption[5]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[5]"></label>
                <p class="ms-4"> - Holds 20 Packets and<span
                        x-text=packagingOptions[selectedOption[5]]*packagingOptions[selectedOption[4]]*packagingOptions[selectedOption[3]]*packagingOptions[selectedOption[2]]*packagingOptions[selectedOption[1]]*
                        packagingOptions[selectedOption[0]]"></span></label>
                    Pieces.</p>
            </div>
        </div>

        <!-- Sorry can not add anymore packaging! -->

        <div x-show="packagingOptions[selectedOption[6]]">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                    <span x-text="selectedOption[6]"></label>
                <p>can not add anymore packaging!</p>
            </div>
        </div>





        <button
            x-on:click="open = !open; dropdownVisible = !dropdownVisible; console.log(open); console.log(dropdownVisible)"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2
        py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add
        </button>









        <!-- Horizontal Checkbox dropdown - Holds number input - Horizontal Checkbox dropdown  -->
        <div x-show="dropdownVisible && open" x-transition>






            <div class="flex flex-col space-y-2">
                <div class="flex justify-center w-full">
                    <div class="flex space-x-2 w-full max-w-4xl">


                        <!-- Dropdown button -->
                        <div x-data="{ openDropdown: false }">

                            <div class="w-1/2">

                                <button @click="openDropdown = !openDropdown" id="dropdownBgHoverButton"
                                    id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button"
                                    x-text="selectedOption[selectedOption.length - 1] || 'Packaging options'">
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>



                                {{-- <button @click="openDropdown = !openDropdown" id="dropdownBgHoverButton"
                                    data-dropdown-toggle="dropdownBgHover"
                                    class="justify-center items-center mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button"
                                    x-text="selectedOption[selectedOption.length - 1] || 'Packaging options'">
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button> --}}


                                <!-- Dropdown menu -->

                            <div x-show="openDropdown" x-transition>


                                    <!-- Dropdown menu -->

                                <div id="dropdownDefaultRadio"
                                class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                                    <li>
                                        <!-- piece -->
                                        <div class="flex items-center">
                                            <input checked disabled id="default-radio-1" type="radio" name="packaging[]" value="piece"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Piece</label>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- doz -->

                                        <div
                                        @click="selectedOption.push('doz');
                                        selectedPackaging = 'doz';
                                        openDropdown = false;
                                        $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                            <div class="flex items-center">
                                                <input id="default-radio-2" type="radio" name="packaging[]" value="doz"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Doz</label>
                                            </div>

                                        </div>

                                    </li>
                                    <li>
                                        <!-- bundle -->

                                        <div
                                        @click="selectedOption.push('bundle');
                                        selectedPackaging = 'bundle'; openDropdown = false;
                                        $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                            <div class="flex items-center">
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="bundle"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bundle</label>
                                            </div>
                                        </div>


                                    </li>
                                    <li>
                                        <!-- packet -->

                                        <div
                                        @click="selectedOption.push('packet');
                                        selectedPackaging = 'packet'; openDropdown = false;
                                        $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                            <div class="flex items-center">
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="packet"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Packet</label>
                                            </div>
                                        </div>


                                    </li>
                                    <li>
                                        <!-- bag -->

                                        <div
                                        @click="selectedOption.push('bag');
                                        selectedPackaging = 'bag';
                                        openDropdown = false;
                                        $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                            <div class="flex items-center">
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="bag"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bag</label>
                                            </div>
                                        </div>


                                    </li>
                                    <li>
                                        <!-- wrapper -->

                                        <div
                                        @click="selectedOption.push('wrapper');
                                        selectedPackaging = 'wrapper';
                                        openDropdown = false">

                                            <div class="flex items-center">
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="wrapper"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wrapper</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="bottle"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bottle</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="case"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Case</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="crate"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Crate</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="container"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Container</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/12carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/12 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/10carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/10 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/8carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/8 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/6carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/6 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/4carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/4 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="1/2carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1/2 Carton</label>
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
                                                <input id="default-radio-3" type="radio" name="packaging[]" value="carton"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Carton</label>
                                            </div>
                                        </div>


                                    </li>
                                    </ul>
                                </div>


















                                    {{-- <div id="dropdownBgHover"
                                        class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownBgHoverButton">
                                            <li>
                                                <div
                                                    class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    <input checked disabled id="checkbox-item-4" type="checkbox"
                                                        name="packaging[]" value="piece"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="checkbox-item-4"
                                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Piece</label>
                                                </div>
                                            </li>
                                            <li>

                                                <div
                                                    @click="selectedOption.push('doz');
                                                    selectedPackaging = 'doz';
                                                    openDropdown = false;
                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">

                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-5" type="checkbox"
                                                            name="packaging[]" value="doz"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-5"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Doz</label>
                                                    </div>
                                                </div>

                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('bundle'); selectedPackaging = 'bundle'; openDropdown = false;
                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="bundle"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Bundle</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('packet'); selectedPackaging = 'packet'; openDropdown = false;
                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="packet"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Packet</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('bag'); selectedPackaging = 'bag'; openDropdown = false;
                                                    $nextTick(() => console.log('selectedOption:', selectedOption, 'selectedPackaging:', selectedPackaging))">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="bag"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Bag</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('wrapper'); selectedPackaging = 'wrapper'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="wrapper"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Wrapper</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('bottle'); selectedPackaging = 'bottle'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="bottle"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Bottle</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('case'); selectedPackaging = 'case'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="case"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Case</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('crate'); selectedPackaging = 'crate'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="crate"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Crate</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('container'); selectedPackaging = 'container'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="container"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Container</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/12carton'); selectedPackaging = '1/12carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/12carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/12
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/10carton'); selectedPackaging = '1/10carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/10carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/10
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/8carton'); selectedPackaging = '1/8carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/8carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/8
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/6carton'); selectedPackaging = '1/6carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/6carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/6
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/4carton'); selectedPackaging = '1/4carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/4carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/4
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('1/2carton'); selectedPackaging = '1/2carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="1/2carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">1/2
                                                            Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    @click="selectedOption.push('carton'); selectedPackaging = 'carton'; openDropdown = false">
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="checkbox-item-6" type="checkbox"
                                                            name="packaging[]" value="carton"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="checkbox-item-6"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Carton</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> --}}

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
                                        <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <input x-model="quantity" type="text" id="counter-input" data-input-counter
                                        class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center"
                                        placeholder="50" value="50" required />
                                    <button
                                        @click="quantity = quantity + 1; $nextTick(() => console.log('quantity:', quantity))"
                                        type="button" id="increment-button"
                                        data-input-counter-increment="counter-input"
                                        class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Packet -->
                        <div class="flex-1 py-4">
                            <p class="py-4"> <!-- Show 'Pieces' for the first selected option -->
                                <span
                                    x-text="selectedOption.length > 0 ? (selectedOption[0] === selectedOption[selectedOption.length - 1] ? 'Piece' : selectedOption[selectedOption.length - 1]) : ''"></span>
                                <span x-text="selectedOption[selectedOption.length - 1] ? 's.' : ''"></span>
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
            py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
                        </div>


                    </div>
                </div>
            </div>


        </div>




    </div>





















































































































    <div class="py-12">
        <div class="flex flex-col max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
