@extends('stock_keeper.layouts.app')
@section('content')
  <div class="pt-8 pb-16 flex flex-col h-full justify-center items-center">
    <div class="flex-1 overflow-y-auto mx-auto w-full max-w-7xl">
      <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 pb-20">
        <!-- Card 1 -->
        <div class="card glass w-full max-w-sm">
          <figure>
            <img
              src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
              alt="car!"
              class="rounded-lg"
            />
          </figure>
          <div class="card-body">
            <h2 class="card-title text-xl font-semibold">Life hack</h2>
            <p class="text-gray-600">How to park your car at your garage?</p>
            <div class="badge bg-blue-500 text-white">Parking</div>
            <div class="badge bg-green-500 text-white">Car Care</div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="card glass w-full max-w-sm">
          <figure>
            <img
              src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
              alt="car!"
              class="rounded-lg"
            />
          </figure>
          <div class="card-body">
            <h2 class="card-title text-xl font-semibold">Another Life Hack</h2>
            <p class="text-gray-600">How to organize your closet?</p>
            <div class="badge bg-red-500 text-white">Organization</div>
            <div class="badge bg-yellow-500 text-white">Home Tips</div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="card glass w-full max-w-sm">
          <figure>
            <img
              src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
              alt="car!"
              class="rounded-lg"
            />
          </figure>
          <div class="card-body">
            <h2 class="card-title text-xl font-semibold">Life Hack 3</h2>
            <p class="text-gray-600">How to clean your car interior?</p>
            <div class="badge bg-purple-500 text-white">Interior Care</div>
            <div class="badge bg-orange-500 text-white">Cleaning</div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="card glass w-full max-w-sm">
          <figure>
            <img
              src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
              alt="car!"
              class="rounded-lg"
            />
          </figure>
          <div class="card-body">
            <h2 class="card-title text-xl font-semibold">Life Hack 4</h2>
            <p class="text-gray-600">How to park your car in tight spots?</p>
            <div class="badge bg-teal-500 text-white">Parking Tips</div>
            <div class="badge bg-indigo-500 text-white">Car Efficiency</div>
          </div>
        </div>

        <!-- Add more cards as needed -->
      </div>
    </div>
  </div>
@endsection
