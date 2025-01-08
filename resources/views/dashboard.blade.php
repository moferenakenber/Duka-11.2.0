<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="flex flex-col max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Welcome, {{ Auth::user()->first_name }}! You are now logged in.</p>
                    {{-- {{ __("You're logged in!") }} --}}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
