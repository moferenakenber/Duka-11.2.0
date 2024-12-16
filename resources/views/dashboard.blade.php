<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex flex-col justify-center items-center gap-0">
                    <h1 class="text-3xl font-bold underline text-white">Hello, Tailwind!</h1>
                    <p class="text-lg text-white">This is a paragraph.</p>
                    <div class="text-xs sm:text-sm md:text-lg lg:text-xl text-white">
                        This text changes size based on screen width.
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 p-6">
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Dashboard
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        User Administration
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Balance Sheet
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Calendar
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Customers
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Products
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Stock
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Orders
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Carts
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Sales
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Delivery
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Projects
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Purchases
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Suppliers
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Expenses
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Invoices
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Reports
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Returns
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Payments
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Notifications
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Settings
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Analytics
                    </button>
                    <button class="bg-white text-gray-800 border border-gray-300 rounded-lg shadow-md px-2 py-1 hover:bg-gray-100 focus:ring focus:ring-gray-200">
                        Support
                    </button>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

