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
        </div>
    </div>
    <div class="text-xs sm:text-sm md:text-lg lg:text-xl text-white">
        This text changes size based on screen width.
    </div>
    <div class=""></div>

    <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; padding: 2rem;">

        <button class="feature-btn">Dashboard</button>
        <button class="feature-btn">User Administration</button>
        <button class="feature-btn">Balance Sheet</button>
        <button class="feature-btn">Customers</button>
        <button class="feature-btn">Products</button>
        <button class="feature-btn">Stock</button>
        <button class="feature-btn">Orders</button>
        <button class="feature-btn">Carts</button>
        <button class="feature-btn">Sales</button>
        <button class="feature-btn">Delivery</button>
        <button class="feature-btn">Projects</button>
        <button class="feature-btn">Purchases</button>
        <button class="feature-btn">Suppliers</button>
        <button class="feature-btn">Expenses</button>
        <button class="feature-btn">Invoices</button>
        <button class="feature-btn">Reports</button>
        <button class="feature-btn">Returns</button>
        <button class="feature-btn">Payments</button>
        <button class="feature-btn">Notifications</button>
        <button class="feature-btn">Settings</button>
        <button class="feature-btn">Analytics</button>
        <button class="feature-btn">Support</button>

    </div>

</x-app-layout>
