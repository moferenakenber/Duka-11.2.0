<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add User') }}
            </a>
        </div>
    </x-slot>


    <!-- Customer Table -->
    <div class="bootstrap-wrapper">
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Created By</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>

    <div class="flex justify-center mt-10">
        <div class="w-full max-w-xs bg-white shadow-xl rounded-lg p-6 space-y-6">
            <!-- Dashboard Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
            </div>

            <!-- User Management Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Payroll</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Payroll Process</li>
                    <li class="text-sm py-1 text-blue-600">Payment History</li>
                </ul>
            </div>

            <!-- Customers Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Customers</h2>
            </div>

            <!-- Products Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Products</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Inventory</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Inventory Management</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Inventory Shifting</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Inventory Replenishment</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Promotion and Discounts</li>
                </ul>
            </div>

            <!-- Sales Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Sales</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Open Carts</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Sales Order</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Payments</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Deliveries</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Returns and Refunds</li>
                </ul>
            </div>

            <!-- Purchases Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Purchases</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Open Purchases</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Supplier Management</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Inventory Replenishment</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Purchase Order</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Payments</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Deliveries</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Returns and Refunds</li>
                </ul>
            </div>

            <!-- Balance Sheet Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Balance Sheet</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Bank Accounts</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Cash</li>
                </ul>
            </div>

            <!-- Projects Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Projects</h2>
                <ul class="list-none space-y-2 pl-4">
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Project Managers</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Tasks</li>
                    <li class="text-sm py-1 hover:text-blue-600 transition duration-300">Expenses</li>
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
</x-app-layout>
