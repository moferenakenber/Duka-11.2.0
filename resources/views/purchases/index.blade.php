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

    <div class="w-full overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Summary</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">1</td>
                    <td class="px-4 py-4 whitespace-nowrap">1001</td>
                    <td class="px-4 py-4 whitespace-nowrap">Sample Product</td>
                    <td class="px-4 py-4 whitespace-nowrap">Meta title example</td>
                    <td class="px-4 py-4 whitespace-nowrap">sample-product</td>
                    <td class="px-4 py-4 whitespace-nowrap">This is a sample summary.</td>
                </tr>
            </tbody>
        </table>
    </div>


</x-app-layout>
