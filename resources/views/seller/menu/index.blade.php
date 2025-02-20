@extends('seller.layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto p-4">
            <div class="relative flex items-center justify-between mb-4 pt-1">
                {{-- <button class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button> --}}
                <h1 class="absolute left-1/2 transform -translate-x-1/2 text-xl font-semibold w-6 h-6">More</h1>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
                </svg> --}}
            </div>

            <div class="grid gap-4">
                <div class="flex items-center">
                    <img src="user_profile.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h2 class="text-lg font-semibold">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h2>
                        <button class="text-blue-500 hover:underline">View your profile</button>
                    </div>


                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 16h10M2 9h20M2 20h20" />
                    </svg>
                    <span class="ml-2">Messages</span>
                    <span class="bg-red-500 text-white rounded-full px-2 py-1 ml-2">9</span>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25l6-6 4 4 8-8" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 7h18" />
                    </svg>

                    <span class="ml-2">Sales</span>
                </a>

                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-10a1 1 0 00-1-1H7a1 1 0 00-1 1v10h5" />
                    </svg>
                    <span class="ml-2">Purchases</span>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Orders</span>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Balance</span>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 0a9 9 0 1118 0" />
                    </svg>
                    <span class="ml-2">Tasks</span>
                  </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Calandar</span>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-white hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1c0 .276.224 1 1 1h8c.776 0 1-.724 1-1l-1-1 3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Friends</span>
                </a>


                {{-- {/* Add more menu items here */} --}}

            </div>

            <form action="{{ route('logout') }}" method="POST" class="block px-4 pt-72 pb-16 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                @csrf
                <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md">Sign out</button>
            </form>
        </div>
    </div>
@endsection
