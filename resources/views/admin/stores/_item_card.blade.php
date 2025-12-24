<div class="w-full mb-6 overflow-hidden transition-all duration-300 border-2 shadow-md bg-gradient-to-br from-white via-[#f6a45d]/10 to-[#f6a45d]/20 border-[#f6a45d]/40 hover:shadow-xl card rounded-3xl ring-1 ring-black/5">
    <div class="p-5 card-body sm:p-6">
        <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">

            {{-- Left: Image & Text --}}
            <div class="flex flex-1 gap-4">
                <div class="avatar">
                    <div class="w-20 h-20 overflow-hidden bg-white shadow-inner sm:w-24 sm:h-24 rounded-2xl ring-2 ring-[#f6a45d]/50">
                        <img src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                             alt="{{ $item->product_name }}"
                             class="object-cover w-full h-full" />
                    </div>
                </div>

                <div class="flex flex-col justify-center">
                    <span class="block text-[10px] font-black uppercase tracking-widest text-orange-900/60">Product Name</span>
                    <h2 class="text-lg font-black leading-tight text-orange-950 sm:text-2xl">
                        {{ $item->product_name }}
                    </h2>

                    @if(isset($item->pivot))
                        <div class="mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white border {{ $item->pivot->active ? 'border-emerald-500 text-emerald-700' : 'border-rose-500 text-rose-700' }} shadow-sm">
                                <span class="w-2 h-2 mr-2 rounded-full {{ $item->pivot->active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                {{ $item->pivot->active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Variant Badge --}}
            <div class="flex items-center self-start order-first sm:order-last sm:self-center">
                <div class="flex items-center gap-2 px-5 py-2.5 border-2 rounded-2xl bg-[#f6a45d] text-white shadow-lg shadow-[#f6a45d]/30">
                    <i data-lucide="layers" class="w-5 h-5 text-white"></i>
                    <span class="text-sm font-black tracking-tighter uppercase">Variants: {{ $variants->count() }}</span>
                </div>
            </div>

        </div>
    </div>
</div>
