<!-- Sidebar -->

<aside x-data="{ open: false }" class="hidden w-60 bg-gray-800 text-white h-screen flex-shrink-0 sm:flex">

    <div class="flex flex-col h-full">
        <div class="flex flex-col">

            <!-- Logo -->
            <div class="flex-1 space-y-2 px-4 py-4">

                <div class="flex w-full justify-center items-center px-4 py-3">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

            </div>

            <!--Sidebar Links -->
            <nav class="flex-1 space-y-2 px-4 py-4">
                    <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-sidebar-link>

                    <x-sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.index')">
                        {{ __('Customers') }}
                    </x-sidebar-link>

            </nav>

        </div>
    </div>
</aside>

