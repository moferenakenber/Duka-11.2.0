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

</x-app-layout>
