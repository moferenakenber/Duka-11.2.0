<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customers') }}
        </h2>

        <a href="{{ route('customers.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ __('Add Customer') }}
        </a>
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
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->customerFirstName }}</td>
                        <td>{{ $customer->customerLastName }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->customerEmail }}</td>
                        <td>{{ $customer->customerPhoneNo }}</td>
                        <td>{{ $customer->user->fullname }}</td>
                        {{--                        <td>{{ optional($customer->user)->username }}--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
