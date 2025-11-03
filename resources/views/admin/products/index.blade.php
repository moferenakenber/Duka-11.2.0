<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <!-- Left side: Title -->
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Products') }}
      </h2>

      <!-- Right side: Add Product Button -->
      <a
        href="{{ route('admin.customers.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        {{ __('Add Product') }}
      </a>
    </div>
  </x-slot>

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
              class="inline-block h-6 w-6 stroke-current"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </label>
        </div>
        <div class="mx-2 flex-1 px-2">Products</div>
        <div class="hidden flex-none lg:block">
          <ul class="menu menu-horizontal">
            <!-- Navbar menu content here -->
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Product Catalog</a></li>
            <li><a href="#">Product Categories</a></li>
            <li><a href="#">Product Attributes</a></li>
            <li><a href="#">Product Reviews</a></li>
            <li><a href="#">Product Variations</a></li>
            <li><a href="#">Product Pricing and Discounts</a></li>
            <li><a href="#">Product Inventory Management</a></li>
          </ul>
        </div>
      </div>
      <!-- Page content here -->
      Content
    </div>
  </div>

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
