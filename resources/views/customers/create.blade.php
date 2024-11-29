<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto text-left text-sm text-white-700">
                <thead class="bg-gray-100 text-white-600">
                    <tr>
                        <th class="px-4 py-3 font-semibold">First Name</th>
                        <th class="px-4 py-3 font-semibold">Last Name</th>
                        <th class="px-4 py-3 font-semibold">City</th>
                        <th class="px-4 py-3 font-semibold">Email</th>
                        <th class="px-4 py-3 font-semibold">Phone Number</th>
                        <th class="px-4 py-3 font-semibold">Created By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $customer->customerFirstName }}</td>
                            <td class="px-4 py-2">{{ $customer->customerLastName }}</td>
                            <td class="px-4 py-2">{{ $customer->city }}</td>
                            <td class="px-4 py-2">{{ $customer->customerEmail }}</td>
                            <td class="px-4 py-2">{{ $customer->customerPhoneNo }}</td>
                            <td class="px-4 py-2">{{ $customer->user->fullname }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
</x-app-layout>
