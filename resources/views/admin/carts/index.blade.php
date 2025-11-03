<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('All Carts') }}
        {{--
          {{dd(__('Your Carts'))}}
          {{ dd(Lang::get('cart.Your Carts'));}}
        --}}
      </h2>
      <!-- Right side: Add Product Button -->
      <a
        href="{{ route('admin.carts.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        {{ __('Add Cart') }}
      </a>
    </div>
  </x-slot>

  <!-- Errors -->
  @if ($errors->any())
    <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
      <h3 class="font-semibold">There were some problems with your input:</h3>
      <ul class="list-disc pl-5 mt-2">
        @foreach ($errors->all() as $error)
          <li class="text-sm">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="overflow-x-auto">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-6">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Carts</th>
            <th scope="col" class="px-6 py-3">Created by</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($carts as $cart)
            <tr
              class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
            >
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @if ($cart->customer)
                  {{ $cart->customer->first_name }}'s Cart
                @else
                  No customer assigned
                @endif
              </th>
              <td class="px-6 py-4">
                @if ($cart->seller)
                  {{ $cart->seller->first_name }} {{ $cart->seller->last_name }}
                @elseif ($cart->user)
                  {{ $cart->user->name }} (User)
                @else
                  N/A
                @endif
              </td>
              <td class="px-6 py-4">
                <a
                  href="{{ route('admin.carts.show', $cart->id) }}"
                  class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                >
                  View Details
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
</x-app-layout>
