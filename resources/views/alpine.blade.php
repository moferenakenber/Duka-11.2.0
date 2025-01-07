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


















    <div x-data="{ open: false }" class="flex flex-col space-y-4">
        <h3 class="flex justify-center items-center text-lg font-semibold pt-6">Packaging types
            and how much they hold
        </h3>

        <!-- Checked disabled piece -->
        <div class="flex items-center pt-4 px-8">
            <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="piece"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disabled-checked-checkbox"
                class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Piece</label>
        </div>

        <!-- Checked packet -->
        <div x-show="open" class="flex items-center pt-2 px-8">
            <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="packet"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disabled-checked-checkbox"
                class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Packet</label>
            <p class="ms-4"> - Holds 50 Pieces.</p>
        </div>

        <!-- Checked cartoon -->
        <div x-show="open">
            <div class="flex items-center pt-2 px-8">
                <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="carton"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="disabled-checked-checkbox"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Carton</label>
                <p class="ms-4"> - Holds 20 Packets and 1000 Pieces.</p>
            </div>
        </div>

        <!-- add button -->
        <button x-on:click="open = !open; console.log(open)"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2
                            py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add
        </button>



        <!-- Horizontal Checkbox dropdown - Holds number input - Horizontal Checkbox dropdown  -->
        <div x-show="open">


            <div x-data="{ open: false, selectedOption: 'Packaging options' }">

                <div class="flex flex-col space-y-2">
                    <div class="flex justify-center w-full">
                        <div class="flex space-x-2 w-full max-w-4xl">


                            <!-- Dropdown button -->
                            <div class="w-1/2">
                                <button @click="open = !open" id="dropdownBgHoverButton"
                                    data-dropdown-toggle="dropdownBgHover"
                                    class="justify-center items-center mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button" x-text="selectedOption || 'Packaging options'">
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>


                                <!-- Dropdown menu -->
                                <div disabled checked id="dropdownBgHover"
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

                                            <div @click="selectedOption = 'doz'; open = false">
                                                <div
                                                    class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    <input id="checkbox-item-5" type="checkbox" name="packaging[]"
                                                        value="doz"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="checkbox-item-5"
                                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Doz</label>
                                                </div>
                                            </div>

                                        </li>

                                        <li>
                                            <div
                                                class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="checkbox-item-6" type="checkbox" name="packaging[]"
                                                    value="bundle"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="checkbox-item-6"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Bundle</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>




                            <!-- Holds number input -->
                            <div class="w-1/2 pl-2 pt-4">
                                <form class="max-w-xs mx-auto">
                                    <label for="counter-input"
                                        class="relative flex px-8 mb-1 text-sm font-medium text-gray-900 dark:text-white">Holds:</label>
                                    <div class="relative flex items-center px-8">
                                        <button type="button" id="decrement-button"
                                            data-input-counter-decrement="counter-input"
                                            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <input type="text" id="counter-input" data-input-counter
                                            class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center"
                                            placeholder="" value="12" required />
                                        <button type="button" id="increment-button"
                                            data-input-counter-increment="counter-input"
                                            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Packet -->
                            <div class="flex-1 py-4">
                                <p class="py-4">Pieces</p>
                            </div>

                            <div class="flex-1">
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2
                                py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>


    </div>








    <div x-data="{ open: false, selectedOption: '', quantity: 12, packagingOptions: { piece: 1, packet: 50, carton: 1000 }, selectedPackaging: '' }" class="flex flex-col space-y-4">
        <!-- Checked disabled piece -->
        <div class="flex items-center pt-4 px-8">
            <input disabled checked id="disabled-checked-checkbox" type="checkbox" value="piece"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disabled-checked-checkbox"
                class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Piece</label>
        </div>

        <!-- Add button -->
        <button x-on:click="open = !open; console.log(open)"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add
        </button>

        <!-- Horizontal Checkbox dropdown - Holds number input - Horizontal Checkbox dropdown -->
        <div x-show="open" x-transition>
            <div x-data="{ openDropdown: false }">
                <div class="flex flex-col space-y-2">
                    <div class="flex justify-center w-full">
                        <div class="flex space-x-2 w-full max-w-4xl">
                            <!-- Dropdown button -->
                            <div class="w-1/2">
                                <button @click="openDropdown = !openDropdown" class="justify-center items-center mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span x-text="selectedOption || 'Packaging options'"></span>
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div x-show="openDropdown" x-transition class="z-10 w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                                        <li>
                                            <div @click="selectedOption = 'Piece'; selectedPackaging = 'piece'; openDropdown = false" class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input type="checkbox" :checked="selectedPackaging === 'piece'" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Piece</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div @click="selectedOption = 'Packet'; selectedPackaging = 'packet'; openDropdown = false" class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input type="checkbox" :checked="selectedPackaging === 'packet'" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Packet</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div @click="selectedOption = 'Carton'; selectedPackaging = 'carton'; openDropdown = false" class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input type="checkbox" :checked="selectedPackaging === 'carton'" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Carton</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Holds number input -->
                            <div class="w-1/2 pl-2 pt-4">
                                <form class="max-w-xs mx-auto">
                                    <label for="counter-input" class="relative flex px-8 mb-1 text-sm font-medium text-gray-900 dark:text-white">Holds:</label>
                                    <div class="relative flex items-center px-8">
                                        <button type="button" @click="quantity = quantity > 1 ? quantity - 1 : 1" class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <input type="text" id="counter-input" class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" x-model="quantity" />
                                        <button type="button" @click="quantity = quantity + 1" class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Checked packet -->
                            <div x-show="selectedPackaging && quantity" class="flex items-center pt-2 px-8">
                                <input disabled checked id="disabled-checked-checkbox" :value="selectedPackaging"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="disabled-checked-checkbox" class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                                    <span x-text="selectedOption"></span>
                                </label>
                                <p class="ms-4"> - Holds <span x-text="quantity * packagingOptions[selectedPackaging]"></span> Items.</p>
                            </div>

                            <!-- Add + button -->
                            <div class="flex-1">
                                <button @click="selectedPackaging && quantity && $nextTick(() => alert(`Added ${quantity * packagingOptions[selectedPackaging]} ${selectedOption}`))" type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm mt-5 px-2 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    +
                                </button>
                            </div>
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
