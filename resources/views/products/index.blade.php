<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Product') }}
            </a>
        </div>
    </x-slot>


    <!-- Product Table -->
    <div class="bootstrap-wrapper">
        <div class="container flex">
            <div class="w-full max-w-4xl">
                <table class="table table-striped text-black border-collapse w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border border-gray-300">ID</th>
                            <th class="px-4 py-2 border border-gray-300">User ID</th>
                            <th class="px-4 py-2 border border-gray-300">Title</th>
                            <th class="px-4 py-2 border border-gray-300">Meta Title</th>
                            <th class="px-4 py-2 border border-gray-300">Slug</th>
                            <th class="px-4 py-2 border border-gray-300">Summary</th>
                            <th class="px-4 py-2 border border-gray-300">Type</th>
                            <th class="px-4 py-2 border border-gray-300">SKU</th>
                            <th class="px-4 py-2 border border-gray-300">Price</th>
                            <th class="px-4 py-2 border border-gray-300">Discount</th>
                            <th class="px-4 py-2 border border-gray-300">Quantity</th>
                            <th class="px-4 py-2 border border-gray-300">Shop</th>
                            <th class="px-4 py-2 border border-gray-300">Created At</th>
                            <th class="px-4 py-2 border border-gray-300">Updated At</th>
                            <th class="px-4 py-2 border border-gray-300">Published At</th>
                            <th class="px-4 py-2 border border-gray-300">Starts At</th>
                            <th class="px-4 py-2 border border-gray-300">Ends At</th>
                            <th class="px-4 py-2 border border-gray-300">Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row (Replace with dynamic data) -->
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">2</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">3</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">4</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">5</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">6</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300">7</td>
                            <td class="px-4 py-2 border border-gray-300">1001</td>
                            <td class="px-4 py-2 border border-gray-300">Sample Product</td>
                            <td class="px-4 py-2 border border-gray-300">Meta title example</td>
                            <td class="px-4 py-2 border border-gray-300">sample-product</td>
                            <td class="px-4 py-2 border border-gray-300">This is a sample summary.</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">SP123</td>
                            <td class="px-4 py-2 border border-gray-300">$100.00</td>
                            <td class="px-4 py-2 border border-gray-300">$10.00</td>
                            <td class="px-4 py-2 border border-gray-300">50</td>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-01 10:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-10 12:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-15 09:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-05 08:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">2024-12-20 18:00:00</td>
                            <td class="px-4 py-2 border border-gray-300">Sample content here.</td>
                        </tr>
                        <!-- Repeat rows for each product -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</x-app-layout>
