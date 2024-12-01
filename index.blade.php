<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Tasks') <!-- Optional: Set the page title -->

@section('content')

<div x-data="{ count: 0 }" class="p-4">
    <p class="mb-4">Count: <span x-text="count"></span></p>
    <button @click="count++" class="px-4 py-2 bg-blue-500 text-white rounded">
        Increment
    </button>
</div>


@endsection
=======
@extends("layouts.app")
>>>>>>> 8e94311 (View folders, changed there folder name from 'dashboardcontroller' to 'dashboard' and so on...)
