<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">


                <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
                    aria-controls="sidebar-multi-level-sidebar" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 xl:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <x-lucide-menu class="w-6 h-6" />
                </button>


                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-xl font-semibold dark:text-white whitespace-nowrap sm:text-2xl">
                        Mezgebe Dirijit
                    </span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full dark:focus:ring-gray-600 focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                alt="user photo" />
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->first_name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100"
                                    role="menuitem">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100"
                                    role="menuitem">
                                    Settings
                                </a>
                            </li>
                            <li>
                                {{--
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>

                  <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">Logout</button>
                  </form>
                --}}

                                {{--
                  <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                  @csrf
                  <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">Sign out</button>
                  </form>
                --}}

                                <form action="{{ route('logout') }}" method="POST"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100"
                                    role="menuitem">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
