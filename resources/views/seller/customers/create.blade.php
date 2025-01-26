@extends('seller.layouts.app')

@section('content')

    {{-- <div class="p-2 flex flex-col h-full justify-center items-center">
        <div
            class="p-2 text-gray-900 bg-gray-100 {{-- dark:text-gray-100 --}} {{-- bg-white --}} {{-- dark:bg-gray-800   shadow-sm sm:rounded-lg overflow-y-auto mx-auto max-w-2xl w-full rounded-lg border-b border-gray-400/50">

            <!-- Top nav
            <!-- Button Container to align buttons on opposite corners
            <div class="relative flex justify-between w-full">
                <h2 class="absolute left-1/2 transform -translate-x-1/2 font-semibold text-lg">Add Customer</h2>

                <!-- Back Button aligned to the left (with gray color)
                <a href="javascript:history.back()"
                    class="inline-flex items-center h-8 pl-2 pr-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">

                    <!-- Left Arrow Icon
                    <svg class="w-5 h-5 mr-2 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M15.293 10.293a1 1 0 0 0 0-1.414L10.707 4.707a1 1 0 0 0-1.414 1.414L12.586 9H3a1 1 0 1 0 0 2h9.586l-3.293 3.293a1 1 0 1 0 1.414 1.414l4.586-4.586z"
                            clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
            </div>

        </div>
    </div> --}}


    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto p-2.5">
            <div class="relative flex items-center justify-between mb-4">
                <!-- Back Button -->
                <a href="/seller/customers" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <!-- Title -->
                <h1 class="absolute left-1/2 transform -translate-x-1/2 text-xl font-semibold">Add Customer</h1>
                <!-- Right Arrow Icon -->
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0" />
                </svg> --}}
            </div>


            <!-- Customer Details-->
            {{-- <div class="flex flex-col h-full pb-16 pt-1 justify-center items-center px-4"> --}}
                <div class="flex flex-col h-full pb-16 pt-1 justify-center items-center">

                {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
                <div
                    class="bg-white dark:bg-gray-800 flex-1 overflow-y-auto mx-auto w-full max-w-2xl m rounded-lg shadow-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100 rounded-lg shadow-lg overflow-y-auto">

                        <form class="max-w-sm mx-auto" action="{{ route('admin.customers.store') }}" method="POST">
                            @csrf

                            <!-- first_name -->
                            <div class="mt-6 mb-6">
                                <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                    name</label>
                                <input type="text" id="first_name" name="first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="John" required />
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- last_name -->
                            <div class="mb-6">
                                <label for="last_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                    name</label>
                                <input type="text" id="last_name" name="last_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Doe" required />
                                @error('last_name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Phone Input -->
                            <div class="mb-6">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                    Number</label>
                                <input type="text" id="phone" name="phone_number" value="{{ old('phone') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0911203040">
                                @error('phone_number')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="abebedamtew@gmail.com">
                                @error('email')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City Input -->
                            <div class="mb-6">
                                <label for="city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                <select id="city" name="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="addisababa" {{ old('city') == 'addisababa' ? 'selected' : '' }}>Addis
                                        Ababa
                                    </option>
                                    <option value="adama" {{ old('city') == 'adama' ? 'selected' : '' }}>Adama</option>
                                    <option value="direDawa" {{ old('city') == 'direDawa' ? 'selected' : '' }}>Dire Dawa
                                    </option>
                                    <option value="bahirDar" {{ old('city') == 'bahirDar' ? 'selected' : '' }}>Bahir Dar
                                    </option>
                                    <option value="bishoftu" {{ old('city') == 'bishoftu' ? 'selected' : '' }}>Bishoftu
                                    </option>
                                    <option value="dessie" {{ old('city') == 'dessie' ? 'selected' : '' }}>Dessie</option>
                                    <option value="gonder" {{ old('city') == 'gonder' ? 'selected' : '' }}>Gonder</option>
                                    <option value="jimma" {{ old('city') == 'jimma' ? 'selected' : '' }}>Jimma</option>
                                    <option value="jijiga" {{ old('city') == 'jijiga' ? 'selected' : '' }}>Jijiga</option>
                                    <option value="mekele" {{ old('city') == 'mekele' ? 'selected' : '' }}>Mekele</option>
                                    <option value="shashamanea" {{ old('city') == 'shashamanea' ? 'selected' : '' }}>
                                        Shashamanea
                                    </option>
                                </select>
                                @error('city')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-4">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
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





        </div>
    </div>






@endsection
