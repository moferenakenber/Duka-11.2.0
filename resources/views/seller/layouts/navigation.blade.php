<div class="btm-nav">

    <!-- Home Button -->
    <a href="/seller/dashboard"
        class="border-blue-600 text-blue-600 flex flex-col items-center
    {{ request()->is('seller/dashboard') ? 'bg-blue-200 active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>

        <span class="btm-nav-label">Home</span>
    </a>

    <!-- Customers Button -->
    <a href="/seller/customers"
        class="border-blue-600 text-blue-600 flex flex-col items-center
    {{ request()->is('seller/customers') ? 'bg-blue-200 active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a4 4 0 00-3-3.87M12 20v-2a4 4 0 013-3.87M6 20v-2a4 4 0 00-3-3.87M9 10a4 4 0 108 0 4 4 0 10-8 0z" />
        </svg>
        <span class="btm-nav-label">Customers</span>
    </a>



    <!-- Carts Button -->
    {{-- <a href="/seller/carts"
        class="border-blue-600 text-teal-600 flex flex-col items-center
    {{ request()->is('seller/carts') ? 'bg-teal-200 active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8M17 13l1.6 8M6 17h.01M18 17h.01" />
        </svg>

        <span class="btm-nav-label">Carts</span>
    </a> --}}

    <a href="/seller/carts"
        class="border-blue-600 text-teal-600 flex flex-col items-center
    {{ request()->is('seller/carts') ? 'bg-teal-200 active' : '' }}">

        <img src="{{ asset('images/1828533.png') }}" alt="Carts Icon" class="w-5 h-5">

        <span class="btm-nav-label">Carts</span>
    </a>




    <!-- More Button -->
    <a href="/seller/menu"
        class="border-blue-600 text-purple-600 flex flex-col items-center
    {{ request()->is('seller/menu') ? 'bg-purple-200 active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <span class="btm-nav-label">More</span>
    </a>

</div>
