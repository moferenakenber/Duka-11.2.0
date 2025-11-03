<x-app-layout>
  <div
    x-data="{
      showSuccess: {{ session('success') ? 'true' : 'false' }},
      showInfo: {{ session('info') ? 'true' : 'false' }},
    }"
  >
    <!-- Success Message -->
    <div
      x-show="showSuccess"
      x-init="setTimeout(() => (showSuccess = false), 3000)"
      class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
      role="alert"
    >
      <span class="font-medium">Success</span>
      {{ session('success') }}
    </div>

    <!-- Info Message -->
    <div
      x-show="showInfo"
      x-init="setTimeout(() => (showInfo = false), 3000)"
      class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
      role="alert"
    >
      <span class="font-medium">Info</span>
      {{ session('info') }}
    </div>
  </div>

  <x-slot name="header">
    <div class="flex justify-between items-center">
      <!-- Left side: Title -->
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Customers') }}
      </h2>

      <!-- Right side: Add Product Button -->
      <a
        href="{{ route('admin.customers.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        {{ __('Add Customer') }}
      </a>
    </div>
  </x-slot>

  <div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone no</th>
          <th>Email</th>
          <th>City</th>
          <th>Created by</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @foreach ($customers as $customer)
          <tr>
            <th>{{ $customer->id }}</th>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->city }}</td>

            <td>
              @if ($customer->creator)
                {{ $customer->creator->first_name }} {{ $customer->creator->last_name }}
                <!-- Display the user's name -->
              @else
                  N/A
                  <!-- If no associated user, display N/A -->
              @endif
            </td>

            <td>{{ $customer->created_at }}</td>

            <td class="px-6 py-2 text-sm text-gray-800 flex items-center space-x-4">
              <!-- View Button -->
              <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-green-600 hover:text-green-800">
                View
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @if ($errors->any())
    <div class="mt-4">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</x-app-layout>
