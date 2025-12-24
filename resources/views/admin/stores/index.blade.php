<x-app-layout>
    <div x-data="{
        showSuccess: {{ session('success') ? 'true' : 'false' }},
        showInfo: {{ session('info') ? 'true' : 'false' }},
    }" class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- Header Section --}}
        <div class="flex flex-col items-center justify-between gap-4 mb-8 sm:flex-row">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-orange-950">
                    {{ __('Stores') }}
                </h2>
                <p class="text-sm font-medium text-gray-500">Manage your network of {{ $stores->count() }} locations.</p>
            </div>

            <a href="{{ route('admin.stores.create') }}"
                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 text-sm font-bold text-white transition-all duration-200 bg-[#f6a45d] rounded-2xl shadow-md hover:bg-[#e8934d] hover:shadow-lg">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                {{ __('Add New Store') }}
            </a>
        </div>

        {{-- Responsive Card Grid --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($stores as $store)
                <div class="group relative flex flex-col bg-[#f6a45d]/15 border border-[#f6a45d]/40 rounded-3xl transition-all duration-300 hover:shadow-md hover:bg-[#f6a45d]/20">

                    {{-- Card Header --}}
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-white border border-[#f6a45d]/40 text-[#f6a45d] shadow-sm">
                                    <i data-lucide="store" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold uppercase tracking-widest text-orange-900/80">Store ID #{{ $store->id }}</span>
                                    <h3 class="text-lg font-bold text-orange-950">{{ $store->name }}</h3>
                                </div>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-700">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-[#f6a45d]"></i>
                                {{ $store->location ?? 'No location set' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <i data-lucide="user" class="w-4 h-4 mr-2 text-[#f6a45d]"></i>
                                <span class="font-bold">Manager:</span>&nbsp;{{ $store->manager ?? 'Unassigned' }}
                            </div>
                        </div>
                    </div>

                    {{-- Actions Bar --}}
                    <div class="mt-auto border-t border-[#f6a45d]/20 p-4 bg-white/50 rounded-b-3xl">
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.stores.items', $store->id) }}"
                               class="flex items-center justify-center gap-2 p-3 rounded-xl bg-[#f6a45d] text-white shadow-sm hover:bg-[#e8934d] transition-all">
                                <i data-lucide="package" class="w-4 h-4"></i>
                                <span class="text-xs font-bold uppercase">Items</span>
                            </a>

                            <a href="{{ route('admin.stores.edit', $store->id) }}"
                               class="flex items-center justify-center gap-2 p-3 rounded-xl bg-white border border-[#f6a45d]/40 text-orange-900 hover:bg-white/80 transition-all">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                <span class="text-xs font-bold uppercase">Edit</span>
                            </a>

                            {{--
                            <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Delete this store?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center w-full gap-2 p-3 bg-white border rounded-xl border-rose-200 text-rose-700 hover:bg-rose-50">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    <span class="text-xs font-bold uppercase">Delete</span>
                                </button>
                            </form>
                            --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
