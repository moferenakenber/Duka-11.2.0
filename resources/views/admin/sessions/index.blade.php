<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Active Sessions') }}
            </h2>
        </div>
    </x-slot>

    @if (session('success'))
        <div x-data="{ showToast: true }" x-show="showToast" x-transition
             class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg right-5 top-5"
             x-init="setTimeout(() => (showToast = false), 3000)">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <div class="mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">

            <!-- Sessions Table -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-auto dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                User
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                Email
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                IP Address
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                Remember Me
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                Expires At
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-left text-gray-900 dark:text-gray-200">
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($sessions as $session)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $session->user?->name ?? 'Unknown' }}
                                </td>

                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $session['email'] ?? 'Unknown' }}
                                </td>

                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $session['ip_address'] }}
                                </td>

                                <td class="px-4 py-2 text-sm">
                                    @if ($session['remember_me'])
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Yes
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $session['expires_at'] }}
                                </td>

                                <td class="px-4 py-2 text-sm">
                                    <form action="{{ route('admin.sessions.destroy', $session['id']) }}"
                                          method="POST"
                                          onsubmit="return confirm('Sign this user out?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                                            Delete Session
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No active sessions found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
