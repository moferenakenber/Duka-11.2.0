@extends('seller.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="container p-6 mx-auto">
        <!-- Page Header -->
        <h1 class="mb-6 text-2xl font-semibold text-center text-gray-800 dark:text-gray-100">
    Settings
</h1>


        <!-- Profile Section -->
        <div class="flex items-center justify-between p-4 mb-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl">
            <div class="flex items-center">
                <img src="{{ asset('images/user_profile.jpg') }}" alt="User Profile"
                     class="object-cover w-12 h-12 mr-4 rounded-full">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </h2>
                    <button class="text-sm text-blue-500 hover:underline">View your profile</button>
                </div>
            </div>

            <!-- Theme Toggle -->
            {{-- <div>
                <label for="themeToggle" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="themeToggle" class="sr-only" />
                        <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow dot -left-1 -top-1"></div>
                    </div>
                    <div class="ml-3 font-medium text-gray-700 dark:text-gray-300">
                        Dark Mode
                    </div>
                </label>
            </div> --}}

            <div>
                        <input type="checkbox" value="synthwave" class="toggle theme-controller" />
                    </div>
        </div>

        <!-- Notifications Section (optional) -->
        <div class="p-4 mb-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl">
            <h3 class="mb-2 font-semibold text-gray-800 text-md dark:text-gray-100">Notifications</h3>
            <p class="mb-3 text-sm text-gray-500 dark:text-gray-400">Manage your notification preferences.</p>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2">
                    <span>Email Notifications</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2">
                    <span>Push Notifications</span>
                </label>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="block px-4 pb-16 text-sm text-gray-700 pt-72 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
            @csrf
            <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                Sign out
            </button>
        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const dot = toggle.nextElementSibling.querySelector('.dot');

    // Load saved theme
    if (localStorage.theme === 'dark') {
        html.classList.add('dark');
        toggle.checked = true;
        dot.classList.add('translate-x-full', 'bg-gray-800');
    }

    toggle.addEventListener('change', function() {
        if (this.checked) {
            html.classList.add('dark');
            localStorage.theme = 'dark';
            dot.classList.add('translate-x-full', 'bg-gray-800');
        } else {
            html.classList.remove('dark');
            localStorage.theme = 'light';
            dot.classList.remove('translate-x-full', 'bg-gray-800');
        }
    });
});
</script>
@endsection
