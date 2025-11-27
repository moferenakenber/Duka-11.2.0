@extends('seller.layouts.app')

@section('content')
    <div class="min-h-screen overflow-x-hidden bg-gray-100">

        {{-- 1. Category Header Section --}}
        <div class="w-full px-4 py-6 rounded-b-xl" style="background-color: #f6a45d">
            <div class="relative flex items-center justify-center w-full max-w-2xl mx-auto">
                <h1 class="text-2xl font-semibold text-white">Categories</h1>
            </div>
        </div>

        {{-- Main Content: Split Screen Layout --}}
        <div class="flex w-full pt-4 pb-16 mx-auto max-w-7xl">

            {{-- 2. Left Sidebar: Categories without icons --}}
            <div class="flex-shrink-0 w-40 md:w-56 border-r border-gray-200 bg-white shadow-lg rounded-l-lg overflow-y-auto min-h-[60vh]">
                <nav class="p-2 space-y-1">
                    @forelse ($mainCategories as $category)
                        @php
                            $isActive = $selectedCategory && $selectedCategory->id === $category->id;
                        @endphp
                        <a href="{{ route('seller.categories.index', ['category_id' => $category->id]) }}"
                           class="block py-2 px-2 text-sm font-medium rounded-lg transition duration-150 ease-in-out
                                  @if ($isActive)
                                      bg-orange-500 text-white shadow-md
                                  @else
                                      text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                  @endif
                                  focus:outline-none focus:ring-2 focus:ring-orange-500/50
                                  whitespace-normal">
                            {{ $category->category_name }}
                        </a>
                    @empty
                        <p class="px-2 text-xs text-gray-500">No categories.</p>
                    @endforelse
                </nav>
            </div>

            {{-- 3. Right Content Area: Subcategories Grid --}}
            <div class="flex-1 min-w-0 p-6 overflow-y-auto bg-white rounded-r-lg shadow-lg md:p-8">

                <div class="pb-4 mb-6 border-b border-gray-200">
                    @if ($selectedCategory)
                        <h2 class="flex items-center text-lg font-semibold text-gray-900">
                            <x-lucide-folder-open class="w-5 h-5 mr-2 text-orange-500" />
                            {{ $selectedCategory->category_name }}
                        </h2>
                    @else
                        <h1 class="text-2xl font-bold text-gray-900">Select a Category</h1>
                        <p class="mt-1 text-base text-gray-500">Choose a category from the left sidebar.</p>
                    @endif
                </div>

                @if ($selectedCategory)
                    @if ($subcategories->isNotEmpty())
                        {{-- Subcategories Grid: Icon on top, 2 per row on small devices --}}
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                            @foreach ($subcategories as $subcategory)
                                <div class="col-span-1 transition duration-300 border border-gray-200 rounded-lg bg-gray-50 hover:shadow-md">
                                    <a href="{{ route('seller.categories.show', $subcategory->id) }}"
                                       class="block p-4 text-center focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                        {{-- Icon on top --}}
                                        <x-lucide-chevron-right-square class="w-8 h-8 mx-auto mb-2 text-orange-500" />
                                        {{-- Name below, wrap naturally --}}
                                        <h3 class="text-base font-semibold text-gray-900 whitespace-normal">
                                            {{ $subcategory->category_name }}
                                        </h3>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                            <x-lucide-box class="w-10 h-10 mx-auto text-gray-400" />
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No Categories Found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                This category currently has no subcategories to display.
                            </p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
