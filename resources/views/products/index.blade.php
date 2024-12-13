<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div x-data="{ open: false }" class="flex flex-col h-screen">
        <!-- Navbar -->
        <header class="bg-white shadow flex justify-between items-center px-6 py-4">
            <div>
                <button @click="open = !open" class="text-blue-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <div class="text-xl font-bold">Dashboard</div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Hello, User</span>
                <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-full h-10 w-10">
            </div>
        </header>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="bg-blue-800 text-white w-64 space-y-6 py-7 px-3 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:relative lg:block" :class="{'-translate-x-full': !open, 'translate-x-0': open}">
                <div class="text-2xl font-bold text-center">Dashboard</div>
                <nav class="space-y-3">
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">User Management</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Payroll</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Payroll Process</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Payment History</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Customers</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Products</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Inventory</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Inventory Management</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Inventory Shifting</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Inventory Replenishment</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Promotion and Discounts</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Sales</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Open Carts</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Sales Order</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Payments</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Deliverys</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Returns and Refunds</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Purchases</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Open Purchases</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Supplier Management</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Purchase Order</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Balance Sheet</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Bank Accounts</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Cash</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Projects</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Project Managers</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Tasks</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Expenses</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Calendar</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-600">Analytics</a>
                </nav>
            </aside>

            <!-- Main content area -->
            <main class="flex-1 p-6">
                <h1 class="text-2xl font-semibold text-gray-800">Welcome to the Dashboard</h1>
                <p class="mt-2 text-gray-600">Select an option from the sidebar to get started.</p>
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-white text-gray-600 text-center py-4 shadow-md">
            &copy; 2024 Dashboard. All rights reserved.
        </footer>
    </div>
</body>
</html>
