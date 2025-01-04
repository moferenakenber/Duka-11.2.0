<x-app-layout>

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
