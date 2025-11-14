<aside id="sidebar-multi-level-sidebar"
    class="dark:bg-gray-800 dark:border-gray-700 fixed left-0 top-16 z-40 h-[calc(100vh-4rem)] w-64 -translate-x-full transform overflow-y-auto border-r border-gray-200 bg-white pt-4 transition-transform xl:translate-x-0"
    aria-label="Sidebar">


    {{--  /* mobile */
          /* medium: icon-only */
          /* desktop: full */        --}}


    <div class="px-3 py-2 pr-2">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400' }} flex items-center rounded-lg p-2">

                    <x-lucide-layout-dashboard
                        class="{{ request()->routeIs('admin.dashboard') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="ms-3 md:inline xl:inline">Dashboard</span>
                </a>

            </li>

            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg cursor-default dark:text-white dark:hover:bg-gray-700 hover:bg-gray-100"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">

                    <x-lucide-box
                        class="{{ request()->routeIs('admin.items.*') ||
                        request()->routeIs('admin.variants.items.*') ||
                        request()->routeIs('admin.stocks.*') ||
                        request()->routeIs('admin.transfers.*')
                            ? 'text-orange-500 dark:text-white'
                            : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="flex-1 text-left ms-3 whitespace-nowrap rtl:text-right">Products</span>

                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>


                {{-- <ul id="dropdown-example" class="hidden py-2 space-y-2"> --}}
                <ul id="dropdown-example"
                    class="{{ request()->routeIs('admin.items.*') ||
                    request()->routeIs('admin.variants.items.*') ||
                    request()->routeIs('admin.stocks.*') ||
                    request()->routeIs('admin.transfers.*')
                        ? 'block'
                        : 'hidden' }} space-y-2 py-2">

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.items.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.items.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                Items
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.variants.items.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.variants.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                Variations
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.stocks.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.stocks.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">

                                {{-- Put this icon in the title
                            <x-lucide-boxes
                                class="{{ request()->routeIs('admin.stock.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" /> --}}

                                Stock
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.transfers.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.transfers.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">

                                {{-- Put this icon in the title
                            <x-lucide-calendar-arrow-down
                                class="{{ request()->routeIs('admin.stock-orders.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" /> --}}

                                Transfers
                            </a>
                        <li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="flex items-center w-full p-2 pl-4 text-gray-900 transition duration-75 rounded-lg dark:text-white dark:hover:bg-gray-700 group hover:bg-gray-100">
                                Prices
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="flex items-center w-full p-2 pl-4 text-gray-900 transition duration-75 rounded-lg dark:text-white dark:hover:bg-gray-700 group hover:bg-gray-100">
                                Discounts and Promotions
                            </a>
                        </li>
                    </div>

                </ul>
            </li>

            <li>
                <a href="#" onclick="return false;"
                    class="{{ request()->routeIs('admin.store.*') ? 'bg-orange-100 dark:bg-orange-700' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }} flex items-center rounded-lg p-2">

                    <x-lucide-store
                        class="{{ request()->routeIs('admin.store.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="flex-1 ms-3 whitespace-nowrap">Store</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.customers.index') }}"
                    class="{{ request()->routeIs('admin.customers.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }} flex items-center rounded-lg p-2">

                    <x-lucide-users
                        class="{{ request()->routeIs('admin.customers.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="ms-3">Customers</span>
                </a>

            </li>

            <li>
                <a href="{{ route('admin.carts.index') }}" @if (request()->routeIs('admin.carts.*')) aria-current="page" @endif
                    class="{{ request()->routeIs('admin.carts.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }} flex items-center rounded-lg p-2 transition duration-75">

                    <x-lucide-shopping-cart
                        class="{{ request()->routeIs('admin.carts.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="flex-1 ms-3 whitespace-nowrap">Carts</span>

                    {{-- optional badge: only show if $cartCount is provided --}}
                    @isset($cartCount)
                        <span
                            class="{{ request()->routeIs('admin.carts.*') ? 'bg-orange-200 text-orange-800 dark:bg-orange-600 dark:text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} ms-3 inline-flex items-center justify-center rounded-full px-2 py-0.5 text-xs font-medium">
                            {{ $cartCount }}
                        </span>
                    @endisset
                </a>
            </li>

            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg cursor-default dark:text-white dark:hover:bg-gray-700 hover:bg-gray-100"
                    aria-controls="more-dropdown" data-collapse-toggle="more-dropdown">

                    <x-lucide-ellipsis
                        class="{{ request()->is('admin/more/*') ||
                        request()->routeIs('admin.sales.*') ||
                        request()->routeIs('admin.deliverys.*') ||
                        request()->routeIs('admin.purchases.*') ||
                        request()->routeIs('admin.balances.*') ||
                        request()->routeIs('admin.documents.*') ||
                        request()->routeIs('admin.calendars.*') ||
                        request()->routeIs('admin.payments.*') ||
                        request()->routeIs('admin.tasks.*')
                            ? 'text-orange-500 dark:text-white'
                            : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="flex-1 text-left ms-3 whitespace-nowrap rtl:text-right">More</span>

                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <ul id="more-dropdown"
                    class="{{ request()->is('admin/more/*') ||
                    request()->routeIs('admin.sales.*') ||
                    request()->routeIs('admin.deliverys.*') ||
                    request()->routeIs('admin.purchases.*') ||
                    request()->routeIs('admin.balances.*') ||
                    request()->routeIs('admin.documents.*') ||
                    request()->routeIs('admin.calendars.*') ||
                    request()->routeIs('admin.payments.*') ||
                    request()->routeIs('admin.tasks.*')
                        ? 'block'
                        : 'hidden' }} space-y-2 py-2">

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.sales.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.sales.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-trending-up class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Sales
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.deliverys.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-truck class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Delivery
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="{{ route('admin.purchases.index') }}"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.purchases.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-scan-barcode class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Purchase Orders
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.balances.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-wallet class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Balance
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.documents.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-file class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Documents
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.calendars.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-calendar-days class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Calendar
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.payments.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-scan-barcode class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Payments
                            </a>
                        </li>
                    </div>

                    <div class="pl-11">
                        <li>
                            <a href="#"
                                class="dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('admin.tasks.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : '' }} group flex w-full items-center rounded-lg p-2 pl-4 text-gray-900 transition duration-75 hover:bg-gray-100">
                                {{-- <x-lucide-circle-check class="flex-shrink-0 w-5 h-5 transition duration-75" /> --}}
                                Tasks
                            </a>
                        </li>
                    </div>

                </ul>
            </li>

            <li>
                <a href="{{ route('admin.settings.index') }}"
                    class="{{ request()->routeIs('admin.setting.*') ? 'bg-orange-100 dark:bg-orange-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }} flex items-center rounded-lg p-2 transition duration-75">

                    <x-lucide-settings
                        class="{{ request()->routeIs('admin.settings.*') ? 'text-orange-500 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }} h-5 w-5 flex-shrink-0 transition duration-75" />

                    <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
