<!-- index view for resource -->
<!-- index view for resource -->
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Left side: Title -->
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Purchases') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('admin.customers.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Add Purchase') }}
            </a>
        </div>
    </x-slot>


    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col drawer-content">
            <div class="navbar bg-base-100">
                <div class="flex-1 px-2 mx-2">
                    <div class="dropdown lg:hidden">
                        <label tabindex="0" class="m-1 text-white btn bg-primary">
                            Users Management
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block w-6 h-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path>
                            </svg>
                        </label>
                        <ul class="p-2 shadow dropdown-content menu bg-base-100 rounded-box w-52">
                            <li><a href="#">User Management</a></li>
                            <li><a href="#">Payroll Process</a></li>
                            <li><a href="#">Payroll Payment</a></li>
                            <li><a href="#">Payment History</a></li>
                            <li><a href="#">User Roles and Permissions</a></li>
                            <li><a href="#">User Profiles</a></li>
                            <li><a href="#">User Authentication and Authorization</a></li>
                            <li><a href="#">User Access Control</a></li>
                            <li><a href="#">User Activity Logs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="justify-end hidden lg:flex-1">
                    <ul class="p-0 menu menu-horizontal">
                        <li><a href="#">User Management</a></li>
                        <li><a href="#">Payroll Process</a></li>
                        <li><a href="#">Payroll Payment</a></li>
                        <li><a href="#">Payment History</a></li>
                        <li><a href="#">User Roles and Permissions</a></li>
                        <li><a href="#">User Profiles</a></li>
                        <li><a href="#">User Authentication and Authorization</a></li>
                        <li><a href="#">User Access Control</a></li>
                        <li><a href="#">User Activity Logs</a></li>
                    </ul>
                </div>
            </div>
            <div class="drawer-side">
            </div>
        </div>
    </div>




    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col drawer-content">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">Purchases</div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li><a href="#">Open Purchases</a></li>
                        <li><a href="#">Supplier Management</a></li>
                        <li><a href="#">Inventory Replenishment</a></li>
                        <li><a href="#">Purchase Order</a></li>
                        <li><a href="#">Payments</a></li>
                        <li><a href="#">Deliveries</a></li>
                        <li><a href="#">Returns and Refunds</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->

        </div>
    </div>



    <div class="container mx-auto">
        <table class="w-full divide-y divide-gray-200 table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">First
                        Name</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Last Name
                    </th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">City</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email
                    </th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Phone
                        Number</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Created
                        By</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Mark</td>
                    <td class="px-6 py-4 whitespace-nowrap">Otto</td>
                    <td class="px-6 py-4 whitespace-nowrap">San Francisco</td>
                    <td class="px-6 py-4 whitespace-nowrap">mdo@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap">123-456-7890</td>
                    <td class="px-6 py-4 whitespace-nowrap">Admin</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-10">
        <div class="w-full max-w-xs p-6 space-y-6 bg-white rounded-lg shadow-xl">
            <!-- Dashboard Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
            </div>

            <!-- User Management Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Payroll</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Payroll Process</li>
                    <li class="py-1 text-sm text-blue-600">Payment History</li>
                </ul>
            </div>

            <!-- Customers Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Customers</h2>
            </div>

            <!-- Products Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Products</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Inventory</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Inventory Management</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Inventory Shifting</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Inventory Replenishment</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Promotion and Discounts</li>
                </ul>
            </div>

            <!-- Sales Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Sales</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Open Carts</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Sales Order</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Payments</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Deliveries</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Returns and Refunds</li>
                </ul>
            </div>

            <!-- Purchases Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Purchases</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Open Purchases</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Supplier Management</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Inventory Replenishment</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Purchase Order</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Payments</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Deliveries</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Returns and Refunds</li>
                </ul>
            </div>

            <!-- Balance Sheet Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Balance Sheet</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Bank Accounts</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Cash</li>
                </ul>
            </div>

            <!-- Projects Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Projects</h2>
                <ul class="pl-4 space-y-2 list-none">
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Project Managers</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Tasks</li>
                    <li class="py-1 text-sm transition duration-300 hover:text-blue-600">Expenses</li>
                </ul>
            </div>

            <!-- Calendar Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Calendar</h2>
            </div>

            <!-- Analytics Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Analytics</h2>
            </div>
        </div>
    </div>




    <div class="p-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">


        <div class="grid grid-cols-4 gap-4 p-6">
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Dashboard
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                User Administration
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Balance Sheet
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Calendar
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Customers
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Products
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Stock
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Orders
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Carts
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Sales
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Delivery
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Projects
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Purchases
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Suppliers
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Expenses
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Invoices
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Reports
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Returns
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Payments
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Notifications
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Settings
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Analytics
            </button>
            <button
                class="px-2 py-1 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-100 focus:ring focus:ring-gray-200">
                Support
            </button>
        </div>

        <div x-data="calendar()" class="max-w-md p-4 mx-auto bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <button @click="prevMonth()" class="px-2 py-1 bg-gray-200 rounded">Prev</button>
                <h2 class="text-lg font-bold" x-text="monthYear"></h2>
                <button @click="nextMonth()" class="px-2 py-1 bg-gray-200 rounded">Next</button>
            </div>

            <!-- Week Days -->
            <div class="grid grid-cols-7 mb-2 font-semibold text-center">
                <template x-for="day in weekDays" :key="day">
                    <div x-text="day"></div>
                </template>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-7 gap-1 text-center">
                <template x-for="blank in blanks" :key="blank">
                    <div class="h-10"></div>
                </template>

                <template x-for="date in daysInMonth" :key="date">
                    <div @click="selectDate(date)"
                        class="flex items-center justify-center h-10 rounded cursor-pointer hover:bg-blue-100"
                        :class="{ 'bg-blue-500 text-white': isSelected(date) }" x-text="date">
                    </div>
                </template>
            </div>

            <!-- Selected Date -->
            <div class="mt-4 text-center" x-show="selectedDate">
                <p>Selected Date: <span x-text="selectedDate"></span></p>
            </div>
        </div>

        <script>
            function calendar() {
                return {
                    current: new Date(),
                    selectedDate: null,
                    weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                    get monthYear() {
                        return this.current.toLocaleString('default', {
                            month: 'long',
                            year: 'numeric'
                        });
                    },

                    get daysInMonth() {
                        const year = this.current.getFullYear();
                        const month = this.current.getMonth();
                        const numDays = new Date(year, month + 1, 0).getDate();
                        return Array.from({
                            length: numDays
                        }, (_, i) => i + 1);
                    },

                    get blanks() {
                        const firstDay = new Date(this.current.getFullYear(), this.current.getMonth(), 1).getDay();
                        return Array.from({
                            length: firstDay
                        });
                    },

                    prevMonth() {
                        this.current.setMonth(this.current.getMonth() - 1);
                    },

                    nextMonth() {
                        this.current.setMonth(this.current.getMonth() + 1);
                    },

                    selectDate(date) {
                        const year = this.current.getFullYear();
                        const month = this.current.getMonth() + 1;
                        this.selectedDate = `${year}-${String(month).padStart(2,'0')}-${String(date).padStart(2,'0')}`;
                    },

                    isSelected(date) {
                        const year = this.current.getFullYear();
                        const month = this.current.getMonth() + 1;
                        return this.selectedDate === `${year}-${String(month).padStart(2,'0')}-${String(date).padStart(2,'0')}`;
                    }
                }
            }
        </script>



        <div>
            <h42 class="mb-4 text-lg font-bold">Interactive Map</h2>
                <map id="map" class="w-full h-64"></map>
        </div>




</x-app-layout>
