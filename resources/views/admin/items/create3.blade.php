<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create Item') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div x-data="{ open: false }" class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen overflow-y-auto px-4">
      <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex items-center mb-4">
          <input
            disabled
            checked
            id="disabled-radio-2"
            type="radio"
            value=""
            name="disabled-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
          <label for="disabled-radio-2" class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Piece</label>
        </div>

        <div x-show="open" class="flex flex-col space-y-2 mb-4">
          <!-- Label for the first layer -->
          <p class="text-lg text-gray-900 dark:text-white">First layer packaging</p>

          <!-- Radio input with label and description in one row -->
          <div class="flex items-center space-x-4">
            <!-- Radio input -->
            <input
              disabled
              checked
              id="disabled-radio-2"
              type="radio"
              value=""
              name="disabled-radio"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />

            <!-- Label -->
            <label for="disabled-radio-2" class="text-sm font-medium text-gray-400 dark:text-gray-500">Packet</label>

            <!-- Description -->
            <p class="text-xs text-gray-900 dark:text-white">A Packet holds 50 pieces</p>
          </div>
        </div>

        <div x-show="open" class="flex flex-col space-y-2 mb-4">
          <!-- Label for the first layer -->
          <p class="text-lg text-gray-900 dark:text-white">Second layer packaging</p>

          <!-- Radio input with label and description in one row -->
          <div class="flex items-center space-x-4">
            <!-- Radio input -->
            <input
              disabled
              checked
              id="disabled-radio-2"
              type="radio"
              value=""
              name="disabled-radio"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />

            <!-- Label -->
            <label for="disabled-radio-2" class="text-sm font-medium text-gray-400 dark:text-gray-500">Carton</label>

            <!-- Description -->
            <p class="text-xs text-gray-900 dark:text-white">A Carton holds 20 packets and 1000 pieces</p>
          </div>
        </div>

        <!-- Add Packaging Button -->
        <div @click="open = true" class="mb-4">
          <button
            type="button"
            class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Add Packaging
          </button>
        </div>

        <button
          x-show="open"
          id="dropdownBgHoverButton"
          data-dropdown-toggle="dropdownBgHover"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button"
        >
          Dropdown checkbox
          <svg
            class="w-2.5 h-2.5 ms-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 10 6"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 4 4 4-4"
            />
          </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
          <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-item-4"
                  type="checkbox"
                  value=""
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                  checked
                  disabled
                />
                <label
                  for="checkbox-item-4"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Piece
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-bag"
                  type="checkbox"
                  value="Bag"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-bag"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Bag
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-bottle"
                  type="checkbox"
                  value="Bottle"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-bottle"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Bottle
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-bundle"
                  type="checkbox"
                  value="Bundle"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-bundle"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Bundle
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-carton"
                  type="checkbox"
                  value="Carton"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-carton"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Carton
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-case"
                  type="checkbox"
                  value="Case"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-case"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Case
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-container"
                  type="checkbox"
                  value="Container"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-container"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Container
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-crate"
                  type="checkbox"
                  value="Crate"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-crate"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Crate
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-doz"
                  type="checkbox"
                  value="Doz"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-doz"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Doz
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-packet"
                  type="checkbox"
                  value="Packet"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-packet"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Packet
                </label>
              </div>
            </li>
            <li>
              <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input
                  id="checkbox-wrapper"
                  type="checkbox"
                  value="Wrapper"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="checkbox-wrapper"
                  class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >
                  Wrapper
                </label>
              </div>
            </li>
          </ul>
        </div>

        <form x-show="open" class="max-w-xs mx-auto">
          <label for="bedrooms-input" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">
            Choose quantity:
          </label>
          <div class="relative flex items-center max-w-[11rem]">
            <button
              type="button"
              id="decrement-button"
              data-input-counter-decrement="bedrooms-input"
              class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
            >
              <svg
                class="w-3 h-3 text-gray-900 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 18 2"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M1 1h16"
                />
              </svg>
            </button>
            <input
              type="text"
              id="bedrooms-input"
              data-input-counter
              data-input-counter-min="1"
              data-input-counter-max="5000"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder=""
              value="12"
              required
            />
            <div
              class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse"
            >
              <svg
                class="w-2.5 h-2.5 text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"
                />
              </svg>
              <span>Piece's</span>
            </div>
            <button
              type="button"
              id="increment-button"
              data-input-counter-increment="bedrooms-input"
              class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
            >
              <svg
                class="w-3 h-3 text-gray-900 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 18 18"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 1v16M1 9h16"
                />
              </svg>
            </button>
          </div>
          <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Please input how much pieces holds
          </p>
        </form>
      </form>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
      <div class="mt-4 bg-red-100 text-red-800 p-4 rounded-md">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</x-app-layout>
