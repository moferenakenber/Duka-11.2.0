<div class="fixed bottom-0 left-0 z-50 flex items-center justify-around w-full h-16 bg-white border-t dock">

    <!-- Home Button -->
    {{-- <a href="/seller/dashboard"
        class="flex flex-col items-center justify-center {{ request()->is('seller/dashboard') ? 'dock-active text-[#F6A45D]' : 'text-gray-500' }}">
        <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                <polyline points="1 11 12 2 23 11" fill="none" stroke="currentColor" stroke-width="2"></polyline>
                <path d="m5,13v7c0,1.1.9,2,2,2h10c1.1,0,2-.9,2-2v-7" fill="none" stroke="currentColor"
                    stroke-width="2"></path>
                <line x1="12" y1="22" x2="12" y2="18" stroke="currentColor"
                    stroke-width="2"></line>
            </g>
        </svg>
        <span class="text-xs dock-label">Home</span>
    </a> --}}

    <a href="/seller/dashboard" class="flex flex-col items-center justify-center text-gray-500">
        <x-lucide-house
            class="size-[1.2em] {{ request()->is('seller/dashboard') ? 'text-[#F6A45D]' : 'text-gray-500' }}" />
        <span class="text-xs dock-label">Home</span>
    </a>

    <!-- Customers Button -->
    <a href="/seller/customers" class="flex flex-col items-center justify-center text-gray-500">
        <x-lucide-users
            class="size-[1.2em] {{ request()->is('seller/customers') ? 'text-[#F6A45D]' : 'text-gray-500' }}" />
        <span class="text-xs dock-label">Customers</span>
    </a>

    <!-- Carts Button -->
    <a href="/seller/carts" class="flex flex-col items-center justify-center text-gray-500">
        <x-lucide-shopping-cart
            class="size-[1.2em] {{ request()->is('seller/carts') ? 'text-[#F6A45D]' : 'text-gray-500' }}" />
        <span class="text-xs dock-label">Carts</span>
    </a>

    <!-- More/Menu Button -->
    <a href="/seller/menu" class="flex flex-col items-center justify-center text-gray-500">
        <x-lucide-menu class="size-[1.2em] {{ request()->is('seller/menu') ? 'text-[#F6A45D]' : 'text-gray-500' }}" />
        <span class="text-xs dock-label">More</span>
    </a>


</div>
