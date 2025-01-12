<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="row">
        <div class="col-6 mx-auto">
            <div x-data="{ open: false }" class="container d-flex flex-column align-items-center">


                <!-- 1 x-init -->

                {{-- The x-init directive allows you to hook into the initialization phase of any element in Alpine --}}
                <!-- White Border Box -->
                <div
                    class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
                    <h3 class="text-center mb-3 font-extrabold text-2xl text-white">1 - x-init -> x-init="console.log('I\'m being initialized!')"
                        and
                        $nextTick()</h3>

                    <p>"I'm being initialized!" will be output in the console before it makes further DOM updates</p>

                    <p>Sometimes, you want to wait until after Alpine has completely finished rendering to execute some
                        code</p>
                    <p>By using Alpine's internal $nextTick magic, you can make this happen.
                        <pre>
                            <code>
                                &lt;div x-init="$nextTick(() = & gt; { ... })"&gt;&lt;/div&gt;

                            </code>
                        </pre>
                    </p>
                    <p>Auto-evaluate init() method</p>
                    <p>If the x-data object of a component contains an init() method, it will be called automatically.
                        <pre>
                            <code>
                                    &lt;div x-date="{
                                    init() {
                                    console.log('I am called automatically')
                                }"&gt;
                                ...
                                &lt;/div&gt
                            </code>
                        </pre>
                    </p>
                    <p>This is also the case for components that were registered using the Alpine.data() syntax.</p>
                    <pre>
                        <code>
                            Alpine.data('dropdown', () => ({
                                init() {
                                    console.log('I will get evaluated when initializing each "dropdown" component.')
                                },
                            }))
                        </code>
                    </pre>

                    <p>If you have both an x-data object containing an init() method and an x-init directive, the x-data
                        method will
                        be called before the directive.</p>
                    <pre>
                        <code>
                            &lt;div
                                x-data="{
                                    init() {
                                        console.log('I am called first')
                                    }
                                }"
                                x-init="console.log('I am called second')"
                            &gt;
                                ...
                            &lt;/div&gt;
                        </code>
                    </pre>


                    <!-- In the below example, "I'm being initialized!" will be output in the console before it makes further DOM updates. -->
                    <div x-init="console.log('I\'m being initialized!')"></div>
                </div>

                <!-- 2 x-show -->

                <!-- White Border Box -->
                <div class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4">
                    <!-- Conditionally visible text based on 'open' state -->
                    <h3 class="text-center mb-3 font-extrabold text-2xl">Toggle Visibility and Alert Demo</h3>
                    <h3 class="text-center mb-3 font-extrabold text-2xl">2 - x-show="<span x-text="open"></span>"</h3>
                    <p x-show="open" class="p-3 text-center border w-100">
                        Hello from Alpine
                    </p>

                    {{-- x-if - Here is the same toggle from before, but this time using x-if instead of x-show. --}}

                    {{-- Notice that x-if must be declared on a <template> tag. This is so that Alpine can leverage the existing browser behavior of the <template> element
                        and use it as the  source of the target <div> to be added and removed from the page. --}}

                    <div
                        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
                        <h3 class="text-center mb-3 font-extrabold text-2xl">template x-if="open"</h3>
                        <div x-data="{ open: false }">
                            <button @click="open = ! open" class="p-3 text-center border">Expand</button>

                            <template x-if="open">
                                <div>
                                    Content...
                                </div>
                            </template>
                        </div>
                    </div>


                    <!-- 3 x-bind -->

                    {{-- Binding attributes You can add HTML attributes like class, style, disabled, etc... to elements in Alpine using the x-bind directive.
                            Here is an example of a dynamically bound class attribute: --}}
                    <!-- White Border Box -->
                    <div
                        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
                        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">3 -
                            x-bind:class="red ? 'bg-red-500 text-white' : 'bg-gray-300 text-black'"
                            @click="red = ! red"</h3>
                        <button x-data="{ red: false }"
                            x-bind:class="red ? 'bg-red-500 text-white' : 'bg-gray-300 text-black'" @click="red = ! red"
                            class="p-3 border rounded-lg">
                            Toggle Red
                        </button>
                    </div>

                    <!-- 4 x-on -->

                    <!-- Button to toggle the state of 'open' -->
                    <h3 class="text-center mb-3 font-extrabold text-2xl"> 4 - x-on:click="open = !open"</h3>
                    <div class="my-3 text-center">
                        <button x-on:click="open = !open" class="p-3 border">
                            ON or OFF
                        </button>
                    </div>
                </div>

                <!-- White Border Box -->
                <div class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4">
                    <!-- Button with no data but executes a click action -->
                    <h3 class="text-center mb-3 font-extrabold text-2xl">x-data @click="alert('I\'ve been clicked!')"
                    </h3>
                    <div class="my-3 text-center">
                        <button x-data @click="alert('I\'ve been clicked!')" class="p-3 border">
                            Click Me
                        </button>
                    </div>
                </div>

                <!-- 5 x-text -->
                <div class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4">
                    <!-- Text content Alpine makes it easy to control the text content -->
                    <h3 class="text-center mb-3 font-extrabold text-2xl">x-data="{ title: 'Start Here' }"</h3>
                    <h3 class="text-center mb-3 font-extrabold text-2xl">5 - x-text="title"</h3>

                    </h3>
                    <div x-data="{ title: 'Start Here' }" class="text-center">
                        <div class="my-3" x-text="title"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>






    {{-- Toggling with transitions --}}
    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl">x-transition's</h3>
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
    </div>





    {{-- As a shortcut, you can leave out the x-bind and use the shorthand : syntax directly: --}}
    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">As a shortcut, you can leave out the x-bind and
            use the shorthand :class</h3>

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
    </div>

    {{-- Because x-data is evaluated as a normal JavaScript object, in addition to state, you can store methods and even getters. --}}
    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">toggle()</h3>

        <div x-data="{ open: false, toggle() { this.open = !this.open } }">
            <button @click="toggle()">Toggle Content</button>

            <div x-show="open">
                Content...
            </div>
        </div>
    </div>

    {{-- JavaScript getters are handy when the sole purpose of a method is to return data based on other state. --}}
    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">getters - Let's refactor our component to use a
            getter called isOpen instead of accessing open directly.</h3>

        <div x-data="{
            open: false,
            get isOpen() { return this.open },
            toggle() { this.open = !this.open },
        }">
            <button @click="toggle()"><span>@click="toggle()" - </span> Content</button>

            <h3 class="text-center mb-3 font-extrabold text-2xl text-white">isOpen - getter</h3>
            <div x-show="isOpen">
                <span>x-show="isOpen" - </span>Content...
            </div>
        </div>



    </div>

    {{-- using Alpine.data --}}
    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">Alpine.data in a script tag</h3>

        <div x-data="dropdown">
            <button @click="toggle">Toggle Content</button>

            <div x-show="open">
                Content...
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('dropdown', () => ({
                    open: false,

                    toggle() {
                        this.open = !this.open
                    },
                }))
            })
        </script>


    </div>



    <!-- 6 x-html -->

    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">6 - x-html</h3>

        <p>x-html sets the "innerHTML" property of an element to the result of a given expression.</p>

        <pre>
            <code>
                &lt;div x-data=&quot;{ username: '&lt;strong&gt;calebporzio&lt;/strong&gt;' }&quot;&gt;
                Username: &lt;span x-html=&quot;username&quot;&gt;&lt;/span&gt;
                &lt;/div&gt;
            </code>
        </pre>

        <div x-data="{ username: '<strong>calebporzio</strong>' }">
            Username: <span x-html="username"></span>

        </div>
    </div>


    <!-- 7 x-model -->

    <!-- White Border Box -->
    <div
        class="bg-gray-800 p-6 border-4 border-white rounded-lg shadow-lg mt-4 flex flex-col justify-center items-center">
        <h3 class="text-center mb-3 font-extrabold text-2xl text-white">7 - x-model</h3>

        <p>x-model allows you to bind the value of an input element to Alpine data.</p>



        <pre>
            <code>
                &lt;div x-data=&quot;{ username: '&lt;strong&gt;calebporzio&lt;/strong&gt;' }&quot;&gt;
                Username: &lt;span x-html=&quot;username&quot;&gt;&lt;/span&gt;
                &lt;/div&gt;
            </code>
        </pre>

        <div x-data="{ username: '<strong>calebporzio</strong>' }">
            Username: <span x-html="username"></span>

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
