@extends('seller.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="flex-1 w-full mx-auto overflow-y-auto max-w-7xl">

            {{-- Subcategory Header Section --}}
            <div class="w-full px-4 py-3 rounded-b-xl" style="background-color: #f6a45d">
                <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto">
                    <a href="{{ route('seller.categories.index') }}"
                        class="text-white btn btn-circle hover:bg-white/10" title="Back to Main Categories">
                        <x-lucide-arrow-left class="w-7 h-7" />
                    </a>

                    <h1 class="absolute text-xl font-semibold text-white transform -translate-x-1/2 left-1/2">
                        {{ $category->category_name }}
                    </h1>

                    <div class="w-10 h-10 ml-auto"></div>
                </div>
            </div>

            {{-- --- --}}

            {{-- Main Content: Subcategory List --}}
            <div class="flex flex-col items-center justify-center h-full pb-16">
                @if ($subcategories->isNotEmpty())
                    <ul
                        class="flex-1 w-full max-w-2xl mx-auto overflow-y-auto bg-white divide-y rounded-lg shadow-lg">

                        {{-- Loop through the subcategories (children) --}}
                        @foreach ($subcategories as $subcategory)
                            <li class="py-3 sm:py-4 hover:bg-gray-100 focus:outline-none active:bg-gray-100">

                                {{-- Assuming 'seller.items.index' can filter by category_id --}}
                                <a href="{{ route('seller.items.index', ['category_id' => $subcategory->id]) }}"
                                    class="flex items-center pl-4 space-x-4 rtl:space-x-reverse">

                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-orange-100 rounded-full">
                                        <x-lucide-tag class="w-6 h-6 text-orange-600" />
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-semibold text-gray-900 truncate">
                                            {{ $subcategory->category_name }}
                                        </p>
                                    </div>

                                    <div class="pr-4 text-sm text-gray-500">
                                        {{-- OPTIONAL: Display the count of items in this subcategory --}}
                                        ({{ $subcategory->items_count ?? '0' }} items)
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{-- Message if no subcategories exist (e.g., if the main category has items directly) --}}
                    <div class="w-full max-w-2xl px-4 mt-8 text-center text-gray-500">
                        <p class="text-lg">No specific sub-categories found under **{{ $category->category_name }}**.</p>
                        <p class="mt-2 text-sm">You can click here to view all items under this category:</p>
                        <a href="{{ route('seller.items.index', ['category_id' => $category->id]) }}"
                            class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            View All {{ $category->category_name }} Items
                        </a>
                    </div>
                @endif

                {{-- --- --}}

                <div class="flex items-center justify-center pt-2">
                    <p class="relative px-4 py-2 font-semibold">
                        <span class="absolute top-0 left-0 w-full h-px bg-white dark:bg-white"></span>
                        <span class="mx-6">Total **{{ $subcategories->count() }}** Subcategories</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
