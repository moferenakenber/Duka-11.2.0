<!-- index view for resource -->
<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sales') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Sale') }}
            </a>
        </div>
    </x-slot>

    <div class="flex flex-col">

        <div class="flex items-center justify-between w-full">
            <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">Open Carts</a>
            <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">Sales Orders</a>
            <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">Payments</a>
            <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">Deliveries</a>
            <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">Returns and Refunds</a>
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

    </div>
</x-app-layout>
