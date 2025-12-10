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
    <div class="flex items-center justify-between">
      <!-- Left side: Title -->
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Stores') }}
      </h2>

      <!-- Right side: Add Store Button -->
      <a
        href="{{ route('admin.stores.create') }}"
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
      >
        {{ __('Add Store') }}
      </a>
    </div>
  </x-slot>

  <div class="overflow-x-auto">
    <table class="table w-full table-compact">
      <!-- head -->
      <thead>
        <tr>
          <th>ID</th>
          <th>Store Name</th>
          <th>Location</th>
          <th>Manager</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($stores as $store)
          <tr>
            <th>{{ $store->id }}</th>
            <td>{{ $store->name }}</td>
            <td>{{ $store->location ?? '—' }}</td>
            <td>{{ $store->manager ?? '—' }}</td>
            <td>{{ $store->created_at->format('Y-m-d') }}</td>
            <td class="flex items-center px-6 py-2 space-x-2 text-sm text-gray-800">
              <!-- View Items in Store -->
                <a href="{{ route('admin.stores.items', $store->id) }}" class="btn btn-sm btn-info">
                    Items
                </a>

              <!-- Edit Store -->
              <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-sm btn-primary">
                Edit
              </a>
              <!-- Delete Store -->
              <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-error">Delete</button>
              </form>
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
