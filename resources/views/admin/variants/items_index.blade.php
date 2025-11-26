<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Items & Variants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($items as $item)
                    <div
                         class="flex flex-col block max-w-sm p-6 border shadow-xs bg-neutral-primary-soft border-default rounded-base">
                        {{-- Item Image --}}
                        <a href="#">
                            <img class="object-cover w-full h-40 rounded-base"
                                 src="{{ $item->product_images ? asset(json_decode($item->product_images)[0]) : asset('images/default.jpg') }}"
                                 alt="{{ $item->product_name }}">
                        </a>

                        {{-- Product Name --}}
                        {{-- Product Name + Variant Count --}}
                        <div class="flex items-center justify-between mt-4 mb-2">
                            <a href="#">
                                <h5 class="text-2xl font-semibold tracking-tight text-heading">
                                    {{ $item->product_name }}
                                </h5>
                            </a>
                            <span class="flex-shrink-0 px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded-full">
                                Variants: {{ $item->variants->count() }}
                            </span>
                        </div>


                        {{-- Description --}}
                        <p class="mb-4 text-sm text-body">
                            {{ $item->product_description }}
                        </p>

                        {{-- Colors --}}
                        @if ($item->colors->count())
                            <div class="flex items-center mb-2 space-x-2">
                                @foreach ($item->colors as $color)
                                    <span class="w-6 h-6 border border-gray-300 rounded-full cursor-pointer"
                                          title="{{ $color->name }}"
                                          style="background-color: {{ $color->name }}"></span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Sizes --}}
                        @if ($item->sizes->count())
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach ($item->sizes as $size)
                                    <span class="px-2 py-1 text-xs text-gray-800 bg-gray-200 rounded-full">
                                        {{ $size->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        {{-- Packaging --}}
                        @if ($item->packagingTypes->count())
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach ($item->packagingTypes as $pack)
                                    <span
                                          class="px-2 py-1 text-sm font-medium rounded bg-brand-softer text-fg-brand-strong ring-brand-subtle ring-1 ring-inset">
                                        {{ $pack->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif




                        {{-- Spacer --}}
                        <div class="flex-1"></div>

                        {{-- View Variants Button --}}
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('admin.variants.index', $item->id) }}"
                               class="text-body bg-neutral-secondary-medium border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-neutral-tertiary shadow-xs rounded-base box-border inline-flex items-center border px-4 py-2.5 text-sm font-medium leading-5 focus:outline-none focus:ring-4">
                                View Variants
                                <svg class="-me-0.5 ms-1.5 h-4 w-4 rtl:rotate-180"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
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
