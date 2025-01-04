{{-- @extends('seller.layouts.app')

@section('content')
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="/docs/images/products/apple-watch.png" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                </a>
                <div class="flex items-center mt-2.5 mb-5">
                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">$599</span>
                    <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                </div>
            </div>
        </div>



    @endsection --}}

    @extends('seller.layouts.app')

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


<ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
    <li class="pb-3 sm:pb-4">
       <div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="flex-shrink-0">
             <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Neil Sims
             </p>
             <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                email@flowbite.com
             </p>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
             $320
          </div>
       </div>
    </li>
    <li class="py-3 sm:py-4">
       <div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="flex-shrink-0">
             <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Neil image">
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Bonnie Green
             </p>
             <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                email@flowbite.com
             </p>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
             $3467
          </div>
       </div>
    </li>
    <li class="py-3 sm:py-4">
       <div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="flex-shrink-0">
             <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-2.jpg" alt="Neil image">
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Michael Gough
             </p>
             <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                email@flowbite.com
             </p>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
             $67
          </div>
       </div>
    </li>
    <li class="py-3 sm:py-4">
       <div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="flex-shrink-0">
             <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="Neil image">
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Thomas Lean
             </p>
             <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                email@flowbite.com
             </p>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
             $2367
          </div>
       </div>
    </li>
    <li class="pt-3 pb-0 sm:pt-4">
       <div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="flex-shrink-0">
             <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-4.jpg" alt="Neil image">
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Lana Byrd
             </p>
             <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                email@flowbite.com
             </p>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
             $367
          </div>
       </div>
    </li>
 </ul>

@endsection
