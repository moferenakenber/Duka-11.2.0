<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <!-- Left side: Title -->
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('User Details') }}
      </h2>

      <!-- Right side: Back to Users Button -->
      <a
        href="{{ route('admin.users.index') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        {{ __('Back to Users') }}
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <!-- User Details -->
          <div class="space-y-4">
            <h3 class="text-lg font-semibold">User Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- First Name -->
              <div>
                <strong>First Name:</strong>
                <p>{{ $user->first_name }}</p>
              </div>

              <!-- Last Name -->
              <div>
                <strong>Last Name:</strong>
                <p>{{ $user->last_name }}</p>
              </div>

              <!-- Email -->
              <div>
                <strong>Email:</strong>
                <p>{{ $user->email }}</p>
              </div>

              <!-- Phone Number -->
              <div>
                <strong>Phone Number:</strong>
                <p>{{ $user->phone_number }}</p>
              </div>

              <!-- Role -->
              <div>
                <strong>Role:</strong>
                <p>{{ ucwords($user->role) }}</p>
              </div>

              <!-- Created By -->
              <div>
                <strong>Created By:</strong>
                <p>
                  @if ($user->creator)
                    {{ $user->creator->first_name }} {{ $user->creator->last_name }}
                  @else
                    N/A
                  @endif
                </p>
              </div>

              <!-- Created At -->
              <div>
                <strong>Created At:</strong>
                <p>{{ $user->created_at->format('M d, Y H:i') }}</p>
              </div>

              <!-- Updated At -->
              <div>
                <strong>Updated At:</strong>
                <p>{{ $user->updated_at->format('M d, Y H:i') }}</p>
              </div>
            </div>
          </div>

          <!-- Actions -->
          <div class="mt-6 flex space-x-4">
            <!-- Edit Button -->
            <a
              href="{{ route('admin.users.edit', $user->id) }}"
              class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
              Edit
            </a>

            <!-- Delete Button -->
            <form
              action="{{ route('admin.users.destroy', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this user?');"
            >
              @csrf
              @method('DELETE')
              <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
              >
                Delete
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
