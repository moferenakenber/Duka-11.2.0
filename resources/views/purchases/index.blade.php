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


    <!-- Customer Table -->
    <div class="bootstrap-wrapper">
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Created By</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>


</x-app-layout>