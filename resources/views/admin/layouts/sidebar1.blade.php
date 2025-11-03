<!-- Sidebar -->

<aside
  x-data="{ open: false }"
  class="hidden w-30 bg-gray-900 text-white h-screen flex-shrink-0 sm:flex items-center justify-center basis-1/8"
>
  <div class="flex flex-col h-full">
    <div class="flex flex-col items-center justify-center">
      <!-- Logo -->
      <div class="flex-1 space-y-2 px-4 py-4">
        <div class="px-4 py-4 flex items-center justify-center">
          <a href="{{ route('admin.dashboard') }}">
            <x-application-logo class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>
      </div>

      <div class="border-t border-gray-700 my-2"></div>
      {{-- <--- Optional separator --}}
      <!--Sidebar Links -->
      <nav class="flex flex-col flex-grow space-y-2 px-4 py-4">
        <x-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')">
          {{ __('Dashboard') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('user_management.index')" :active="request()->routeIs('user_management.index')">
          {{ __('User Management') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('admin.customers.index')" :active="request()->routeIs('customers.index')">
          {{ __('Customers') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('product.index')" :active="request()->routeIs('product.index')">
          {{ __('Products') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('sale.index')" :active="request()->routeIs('sale.index')">
          {{ __('Sales') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('purchase.index')" :active="request()->routeIs('purchase.index')">
          {{ __('Purchases') }}
        </x-sidebar-link>

        {{--
          <div class="relative inline-block text-left">
          <button type="button" id="dropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Inventory
          <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
          </button>
          
          <div id="dropdownContent" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
          <div class="py-1 rounded-md bg-white">
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Items</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Item Kits</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Categories</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manufacturers</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifiers</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tags</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Attributes</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price Rules</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price Check</a>
          </div>
          </div>
          </div>
          
          <script>
          document.getElementById('dropdownButton').addEventListener('click', function() {
          document.getElementById('dropdownContent').classList.toggle('hidden');
          });
          
          // Close the dropdown when clicking outside
          document.addEventListener('click', function(event) {
          if (!event.target.matches('#dropdownButton') && !event.target.closest('#dropdownContent')) {
          document.getElementById('dropdownContent').classList.add('hidden');
          }
          });
          </script>
        --}}

        <div class="relative inline-block text-left">
          <button
            type="button"
            id="dropdownButton"
            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Inventory
            <svg
              class="-mr-1 ml-2 h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"
              />
            </svg>
          </button>

          <div
            id="dropdownContent"
            class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
          >
            <div class="py-1 rounded-md bg-white">
              <a href="{{ route('product.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Items
              </a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Item Kits</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Categories</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manufacturers</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifiers</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tags</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Attributes</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price Rules</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price Check</a>
            </div>
          </div>
        </div>

        <script>
          document.getElementById('dropdownButton').addEventListener('click', function () {
            document.getElementById('dropdownContent').classList.toggle('hidden');
          });

          // Close the dropdown when clicking outside
          document.addEventListener('click', function (event) {
            if (!event.target.matches('#dropdownButton') && !event.target.closest('#dropdownContent')) {
              document.getElementById('dropdownContent').classList.add('hidden');
            }
          });
        </script>
      </nav>
    </div>
  </div>
</aside>
