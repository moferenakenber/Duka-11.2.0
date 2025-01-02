<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>

    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf

        <!-- Name Input -->
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Abebe Damtew">
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="abebedamtew@gmail.com">
            @error('email')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone Input -->
        <div class="mb-6">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
            <input type="text" id="phone" name="phone_number" value="{{ old('phone') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0911203040">
            @error('phone')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- City Input -->
        <div class="mb-6">
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
            <select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="addisababa" {{ old('city') == 'addisababa' ? 'selected' : '' }}>Addis Ababa</option>
                <option value="adama" {{ old('city') == 'adama' ? 'selected' : '' }}>Adama</option>
                <option value="direDawa" {{ old('city') == 'direDawa' ? 'selected' : '' }}>Dire Dawa</option>
                <option value="bahirDar" {{ old('city') == 'bahirDar' ? 'selected' : '' }}>Bahir Dar</option>
                <option value="bishoftu" {{ old('city') == 'bishoftu' ? 'selected' : '' }}>Bishoftu</option>
                <option value="dessie" {{ old('city') == 'dessie' ? 'selected' : '' }}>Dessie</option>
                <option value="gonder" {{ old('city') == 'gonder' ? 'selected' : '' }}>Gonder</option>
                <option value="jimma" {{ old('city') == 'jimma' ? 'selected' : '' }}>Jimma</option>
                <option value="jijiga" {{ old('city') == 'jijiga' ? 'selected' : '' }}>Jijiga</option>
                <option value="mekele" {{ old('city') == 'mekele' ? 'selected' : '' }}>Mekele</option>
                <option value="shashamanea" {{ old('city') == 'shashamanea' ? 'selected' : '' }}>Shashamanea</option>
            </select>
            @error('city')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500">Submit</button>
        </div>
    </form>


</x-app-layout>
