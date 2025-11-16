<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Items & Variants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($items as $item)
                    <div
                        class="shadow-xs bg-neutral-primary-soft border-default rounded-base block flex max-w-sm flex-col border p-6">
                        {{-- Item Image --}}
                        <a href="#">
                            <img class="rounded-base h-40 w-full object-cover"
                                src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                                alt="{{ $item->product_name }}">
                        </a>

                        {{-- Product Name --}}
                        {{-- Product Name + Variant Count --}}
                        <div class="mb-2 mt-4 flex items-center justify-between">
                            <a href="#">
                                <h5 class="text-heading text-2xl font-semibold tracking-tight">
                                    {{ $item->product_name }}
                                </h5>
                            </a>
                            <span class="flex-shrink-0 rounded-full bg-blue-500 px-3 py-1 text-sm font-bold text-white">
                                Variants: {{ $item->variants->count() }}
                            </span>
                        </div>


                        {{-- Description --}}
                        <p class="text-body mb-4 text-sm">
                            {{ $item->product_description }}
                        </p>

                        {{-- Colors --}}
                        @if ($item->colors->count())
                            <div class="mb-2 flex items-center space-x-2">
                                @foreach ($item->colors as $color)
                                    <span class="h-6 w-6 cursor-pointer rounded-full border border-gray-300"
                                        title="{{ $color->name }}" style="background-color: {{ $color->name }}"></span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Sizes --}}
                        @if ($item->sizes->count())
                            <div class="mb-2 flex flex-wrap gap-1">
                                @foreach ($item->sizes as $size)
                                    <span class="rounded-full bg-gray-200 px-2 py-1 text-xs text-gray-800">
                                        {{ $size->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        {{-- Packaging --}}
                        @if ($item->packagingTypes->count())
                            <div class="mb-2 flex flex-wrap gap-1">
                                @foreach ($item->packagingTypes as $pack)
                                    <span
                                        class="bg-brand-softer text-fg-brand-strong ring-brand-subtle rounded px-2 py-1 text-sm font-medium ring-1 ring-inset">
                                        {{ $pack->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif




                        {{-- Spacer --}}
                        <div class="flex-1"></div>

                        {{-- View Variants Button --}}
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('admin.variants.index', $item->id) }}"
                                class="text-body bg-neutral-secondary-medium border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-neutral-tertiary shadow-xs rounded-base box-border inline-flex items-center border px-4 py-2.5 text-sm font-medium leading-5 focus:outline-none focus:ring-4">
                                View Variants
                                <svg class="-me-0.5 ms-1.5 h-4 w-4 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
