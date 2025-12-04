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

            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-sm font-medium text-left">User</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">Role</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">Email</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">IP Address</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">Remember Me</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">Expires After</th>
                            <th class="px-4 py-2 text-sm font-medium text-left">Actions</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($sessions as $session)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                {{-- Full Name --}}
                                <td class="px-4 py-2 text-sm">
                                    @if ($session->user)
                                        {{ $session->user->first_name }} {{ $session->user->last_name }}
                                    @else
                                        Unknown
                                    @endif
                                </td>

                                {{-- Role Badge --}}
                                <td class="px-4 py-2 text-sm">
                                    @if ($session->user)
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($session->user->role === 'admin') bg-red-100 text-red-700
                                            @elseif($session->user->role === 'seller') bg-blue-100 text-blue-700
                                            @elseif($session->user->role === 'stock_keeper') bg-yellow-100 text-yellow-700
                                            @else bg-gray-100 text-gray-700 @endif">
                                            {{ ucfirst($session->user->role) }}
                                        </span>
                                    @else
                                        Unknown
                                    @endif
                                </td>

                                {{-- Email --}}
                                <td class="px-4 py-2 text-sm">
                                    {{ $session->email ?? 'Unknown' }}
                                </td>

                                {{-- IP --}}
                                <td class="px-4 py-2 text-sm">
                                    {{ $session->ip_address }}
                                </td>

                                {{-- Remember me --}}
                                <td class="px-4 py-2 text-sm">
                                    @if ($session->remember_me)
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Yes
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-200 rounded-full">
                                            No
                                        </span>
                                    @endif
                                </td>


                                {{-- Expiration --}}
                                <td class="px-4 py-2 text-sm">
                                    <div x-data="countdown('{{ $session->expires_at }}')" x-init="init()" x-text="timeLeft"></div>
                                </td>

                                <script>
                                function countdown(expiration) {
                                    return {
                                        timeLeft: '',
                                        interval: null,
                                        init() {
                                            const expireTime = new Date(expiration).getTime();
                                            this.update();
                                            this.interval = setInterval(() => this.update(), 1000);
                                        },
                                        update() {
                                            const now = new Date().getTime();
                                            let distance = new Date(expiration).getTime() - now;

                                            if (distance <= 0) {
                                                this.timeLeft = 'Expired';
                                                clearInterval(this.interval);
                                                return;
                                            }

                                            const hours = Math.floor(distance / (1000 * 60 * 60));
                                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            this.timeLeft = `${hours}h ${minutes}m ${seconds}s`;
                                        }
                                    }
                                }
                                </script>

                                {{-- Delete session --}}
                                <td class="px-4 py-2 text-sm">
                                    <form action="{{ route('admin.sessions.destroy', $session->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Sign this user out?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">
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
