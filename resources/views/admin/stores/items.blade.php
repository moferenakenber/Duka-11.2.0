<x-app-layout>
    {{-- Header Section --}}
    <x-slot name="header">
        <div class="flex flex-col items-start justify-start gap-4 sm:flex-row sm:items-center">

            {{-- Now on the Left (Desktop) / Top (Mobile) --}}
            <a href="{{ route('admin.stores.index') }}"
               class="inline-flex items-center px-4 py-2 text-xs font-bold transition-all border-2 rounded-xl border-[#f6a45d]/40 text-orange-900 hover:bg-[#f6a45d]/10 bg-white shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Back to Stores
            </a>

            {{-- Now on the Right (Desktop) / Bottom (Mobile) --}}
            <div>
                <span class="block text-[10px] font-black uppercase tracking-widest text-orange-900/60">Variation Management</span>
                <h2 class="text-2xl font-black tracking-tight text-orange-950">
                    Items in {{ $store->name }}
                </h2>
            </div>
        </div>
    </x-slot>

    {{-- Main Content Container --}}
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($items as $item)
                <a href="{{ route('admin.stores.items.variants', ['store' => $store->id, 'item' => $item->id]) }}"
                   class="flex flex-col transition-all duration-300 border-2 shadow-sm bg-[#f6a45d]/15 border-[#f6a45d]/40 rounded-2xl hover:shadow-lg hover:bg-[#f6a45d]/25 group active:scale-95">

                    <div class="p-3 sm:p-5">
                        <div class="flex items-center justify-center w-10 h-10 mb-3 bg-white border-2 border-orange-200 shadow-sm rounded-xl sm:w-14 sm:h-14">
                            <i data-lucide="package" class="w-5 h-5 sm:w-7 sm:h-7 text-[#f6a45d]"></i>
                        </div>

                        <div class="overflow-hidden">
                            <span class="block text-[8px] sm:text-[10px] font-black uppercase tracking-widest text-orange-900/60 mb-1">
                                ID #{{ $item->id }}
                            </span>
                            <h3 class="text-sm font-black leading-tight text-orange-950 sm:text-lg line-clamp-2">
                                {{ $item->product_name }}
                            </h3>
                        </div>

                        <div class="flex items-center mt-3 text-[10px] font-bold text-[#f6a45d] uppercase sm:hidden">
                            View <i data-lucide="chevron-right" class="w-3 h-3 ml-1"></i>
                        </div>
                    </div>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center p-12 text-center border-2 border-gray-200 border-dashed col-span-full rounded-3xl bg-gray-50">
                    <i data-lucide="package-search" class="w-12 h-12 mb-4 text-gray-300"></i>
                    <h3 class="text-xl font-bold text-gray-800">No items found</h3>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
