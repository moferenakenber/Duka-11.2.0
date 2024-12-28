@extends('stock_keeper.layouts.app')

@section('content')
    <div class="grid grid-cols-2 gap-6 p-4 pb-20">
        @foreach($items as $item)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="p-8 rounded-t-lg"
                         src="{{ $item->images ? json_decode($item->images)[0] : '/default-image.png' }}"
                         alt="{{ $item->name }}" />
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item->name }}</h5>
                    </a>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{ $item->description }}
                    </p>
                    <div class="mt-4">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($item->price, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
