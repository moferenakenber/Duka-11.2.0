<!-- index view for resource -->
<!-- index view for resource -->
<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Purchases') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Purchase') }}
            </a>
        </div>
    </x-slot>


    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
          <div class="navbar bg-base-100">
            <div class="flex-1 px-2 mx-2">
              <div class="dropdown lg:hidden">
                <label tabindex="0" class="btn m-1 bg-primary text-white">
                  Users Management
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path></svg>
                </label>
                <ul class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
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
            <div class="hidden lg:flex-1 justify-end">
              <ul class="menu menu-horizontal p-0">
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
        <div class="drawer-content flex flex-col">
          <!-- Navbar -->
          <div class="navbar bg-base-300 w-full">
            <div class="flex-none lg:hidden">
              <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  class="inline-block h-6 w-6 stroke-current">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </label>
            </div>
            <div class="mx-2 flex-1 px-2">Purchases</div>
            <div class="hidden flex-none lg:block">
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
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
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




    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">


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


</x-app-layout>
