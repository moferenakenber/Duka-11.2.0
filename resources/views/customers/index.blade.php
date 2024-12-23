<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customers') }}
            </h2>

            <!-- Right side: Add Product Button -->
            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add Customer') }}
            </a>
        </div>
    </x-slot>

    <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>City</th>
              <th>Created by</th>
              <th>Created at</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->
                @foreach($customers as $customer)
                    <tr>
                        <th>{{ $customer->id }}</th>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->city }}</td>
                        {{-- <td>{{ $customer->user->name }}</td> <!-- Assuming the 'user' relationship is defined in the Customer model --> --}}

                        <td>
                            @if($customer->user)
                                {{ $customer->user->name }}  <!-- Display the user's name -->
                            @else
                                N/A  <!-- If no associated user, display N/A -->
                            @endif
                        </td>

                        <td>{{ $customer->created_at }}</td>
                    </tr>
                @endforeach
          </tbody>
        </table>
      </div>

</x-app-layout>
