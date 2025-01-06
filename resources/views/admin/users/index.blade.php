<x-app-layout>

        <div x-data="{
            showSuccess: {{ session('success') ? 'true' : 'false' }},
            showInfo: {{ session('info') ? 'true' : 'false' }}
        }">
            <!-- Success Message -->
            <div
                x-show="showSuccess"
                x-init="setTimeout(() => showSuccess = false, 3000)"
                class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">Success</span> {{ session('success') }}
            </div>

            <!-- Info Message -->
            <div
                x-show="showInfo"
                x-init="setTimeout(() => showInfo = false, 3000)"
                class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                role="alert">
                <span class="font-medium">Info</span> {{ session('info') }}
            </div>
        </div>


    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Left side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>

            <!-- Right side: Add User Button -->
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add User') }}
            </a>
        </div>
    </x-slot>

    <div class="overflow-x-auto p-2">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone no</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created by</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($users as $user)
                    <!-- row 1 -->
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->creator)
                                {{ $user->creator->first_name }} {{ $user->creator->last_name }}
                            @else
                                {{ __('N/A') }}
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>

                        <td class="px-6 py-2 text-sm text-gray-800 flex items-center space-x-4">

                            <!-- View Button -->
                            <a href="{{ route('admin.users.show', $user->id) }}"
                                class="text-green-600 hover:text-green-800">View</a>

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-center">{{ __('No Users found') }}</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</x-app-layout>
