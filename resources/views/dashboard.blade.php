<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="flex flex-col mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex-col overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Welcome, {{ Auth::user()->first_name }}! You are now logged in.</p>
                    {{-- {{ __("You're logged in!") }} --}}

                    <div class="flex flex-wrap gap-4 mt-4">
                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3"><span
                                class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>Visitors</span>
                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3"><span
                                class="flex w-2.5 h-2.5 bg-purple-500 rounded-full me-1.5 shrink-0"></span>Sessions</span>
                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3"><span
                                class="flex w-2.5 h-2.5 bg-indigo-500 rounded-full me-1.5 shrink-0"></span>Customers</span>
                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3"><span
                                class="flex w-2.5 h-2.5 bg-blue-200 rounded-full me-1.5 shrink-0"></span>Sales</span>
                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3"><span
                                class="flex w-2.5 h-2.5 bg-teal-500 rounded-full me-1.5 shrink-0"></span>Revenue</span>

                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
