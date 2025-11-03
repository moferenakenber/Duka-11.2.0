<!-- Create View for Item -->
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create User') }}
    </h2>
  </x-slot>

  <form
    class="max-w-sm mx-auto"
    action="{{ route('admin.user_managements.store') }}"
    method="POST"
    enctype="multipart/form-data"
  >
    @csrf

    <!-- first_name -->
    <div class="mt-6 mb-6">
      <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
      <input
        type="text"
        id="first_name"
        name="first_name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="John"
        required
      />
    </div>

    <!-- last_name -->
    <div class="mb-6">
      <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
      <input
        type="text"
        id="last_name"
        name="last_name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Doe"
        required
      />
    </div>

    <!-- phone_number -->
    <div class="mb-6">
      <label for="phone-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        Phone number:
      </label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
          <svg
            class="w-4 h-4 text-gray-500 dark:text-gray-400"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 19 18"
          >
            <path
              d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"
            />
          </svg>
        </div>
        <input
          type="text"
          id="phone-input"
          name="phone_number"
          aria-describedby="helper-text-explanation"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          pattern="^[0-9]{10}$"
          placeholder="0912345792"
          required
        />
      </div>
      <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
        Input a phone number that matches the format.
      </p>
    </div>

    <!-- email -->
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
      <input
        type="email"
        id="email"
        name="email"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="john.doe@company.com"
        required
      />
    </div>

    <!-- role -->
    <div class="mb-6">
      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        Select an option
      </label>
      <select
        id="countries"
        name="role"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      >
        <option selected>Choose a Role</option>
        <option value="admin">Admin</option>
        <option value="seller">Seller</option>
        <option value="stock_keeper">Stock Keeper</option>
        <option value="user">User</option>
      </select>
    </div>

    <!-- password -->
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
      <input
        type="password"
        id="password"
        name="password"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="•••••••••"
        required
      />
    </div>

    <div class="mb-6">
      <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        Confirm Password
      </label>
      <input
        type="password"
        id="password_confirmation"
        name="password_confirmation"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="•••••••••"
        required
      />
    </div>

    <!-- submit button -->
    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
      Submit
    </button>
  </form>

  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</x-app-layout>
