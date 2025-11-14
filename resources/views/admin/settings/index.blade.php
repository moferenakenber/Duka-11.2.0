<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Settings
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl">
            <div class="p-6 bg-white shadow dark:bg-gray-800 sm:rounded-lg">

                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">
                    General Settings
                </h3>

                @if (session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Company Name</label>
                        <input type="text" name="company_name"
                            class="block w-full mt-1 border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Default Currency</label>
                        <select name="currency"
                            class="block w-full mt-1 border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="ETB">ETB</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>

                    <!-- User Management -->
                    <a href="{{ route('admin.users.index') }}"
                        class="block p-6 transition bg-white shadow dark:bg-gray-800 rounded-xl hover:shadow-lg">
                        <x-lucide-user class="w-8 h-8 mb-3 text-orange-500" />
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">User Management</h3>
                    </a>


                    <button type="submit"
                        class="px-4 py-2 font-semibold text-white bg-orange-600 rounded-lg hover:bg-orange-700">
                        Save Settings
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
