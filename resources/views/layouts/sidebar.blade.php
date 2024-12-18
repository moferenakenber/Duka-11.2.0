<!-- Sidebar -->

<aside x-data="{ open: false }" class="hidden w-30 bg-gray-900 text-white h-screen flex-shrink-0 sm:flex items-center justify-center basis-1/8">

    <div class="flex flex-col h-full">
        <div class="flex flex-col items-center justify-center">

            <!-- Logo -->
            <div class="flex-1 space-y-2 px-4 py-4">

                <div class="px-4 py-4 flex items-center justify-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

            </div>

            <div class="border-t border-gray-700 my-2"></div>    {{-- <--- Optional separator --}}
            <!--Sidebar Links -->
            <nav class="flex flex-col flex-grow space-y-2 px-4 py-4">
                    <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-sidebar-link>


                    <x-sidebar-link :href="route('user_management.index')" :active="request()->routeIs('user_management.index')">
                        {{ __('User Management') }}
                    </x-sidebar-link>

                    <x-sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.index')">
                        {{ __('Customers') }}
                    </x-sidebar-link>

            </nav>

        </div>
    </div>
</aside>

