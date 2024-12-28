<!-- Show View for user_management -->

@extends('admin.layouts.app')

@section('content')
    <h1>Show user_management Details</h1>
    <p><strong>Id:</strong> {{ $user_management->id }}</p><p><strong>User id:</strong> {{ $user_management->user_id }}</p><p><strong>Permissions:</strong> {{ $user_management->permissions }}</p><p><strong>Login history:</strong> {{ $user_management->login_history }}</p><p><strong>Status:</strong> {{ $user_management->status }}</p><p><strong>Payroll id:</strong> {{ $user_management->payroll_id }}</p><p><strong>Payment history id:</strong> {{ $user_management->payment_history_id }}</p><p><strong>Created at:</strong> {{ $user_management->created_at }}</p><p><strong>Updated at:</strong> {{ $user_management->updated_at }}</p>
    <a href="{{ route('user_management.edit', $user_management->id) }}">Edit</a>
    <form action="{{ route('user_management.destroy', $user_management->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
