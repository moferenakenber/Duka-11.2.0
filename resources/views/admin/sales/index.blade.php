<!-- index view for resource -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Left side: Title -->

            <h2 class="flex items-center gap-2 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                <x-lucide-trending-up class="w-5 h-5 text-orange-500 dark:text-white" />
                {{ __('Sales') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('admin.customers.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Add Sale') }}
            </a>
        </div>
    </x-slot>

    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select your country</label>
        <select id="tabs"
            class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
            <option>Sales Orders</option>
            <option>Payments</option>
            <option>Deliveries</option>
            <option>Returns and Refunds</option>
            <option>Invoices</option>
        </select>
    </div>
    <ul
        class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow dark:divide-gray-700 dark:text-gray-400 sm:flex">
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-white active rounded-s-lg focus:outline-none focus:ring-4 focus:ring-blue-300"
                aria-current="page">
                Sales Orders
            </a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Payments
            </a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Deliveries
            </a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-gray-200 dark:border-gray-700 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700 rounded-e-lg border-s-0 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Returns and Refunds
            </a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-gray-200 dark:border-gray-700 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700 rounded-e-lg border-s-0 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Invoices
            </a>
        </li>
    </ul>

    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col drawer-content">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">Sales</div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li><a>Open Carts</a></li>
                        <li><a>Sales Orders</a></li>
                        <li><a>Payments</a></li>
                        <li><a>Deliveries</a></li>
                        <li><a>Returns and Refunds</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->
        </div>
    </div>
</x-app-layout>
