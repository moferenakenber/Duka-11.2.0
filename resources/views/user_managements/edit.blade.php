<!-- Edit View for user_management -->

@extends('layouts.app')

@section('content')
    <h1>Edit user_management</h1>
    <form action="{{ route('user_management.update', $user_management->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for='user_id'>User id</label>
                <input type='text' name='user_id' id='user_id' value='{{ $user_management->user_id }}' required><br><br><label for='permissions'>Permissions</label>
                <input type='text' name='permissions' id='permissions' value='{{ $user_management->permissions }}' required><br><br><label for='login_history'>Login history</label>
                <input type='text' name='login_history' id='login_history' value='{{ $user_management->login_history }}' required><br><br><label for='status'>Status</label>
                <input type='text' name='status' id='status' value='{{ $user_management->status }}' required><br><br><label for='payroll_id'>Payroll id</label>
                <input type='text' name='payroll_id' id='payroll_id' value='{{ $user_management->payroll_id }}' required><br><br><label for='payment_history_id'>Payment history id</label>
                <input type='text' name='payment_history_id' id='payment_history_id' value='{{ $user_management->payment_history_id }}' required><br><br><label for='created_at'>Created at</label>
                <input type='text' name='created_at' id='created_at' value='{{ $user_management->created_at }}' required><br><br><label for='updated_at'>Updated at</label>
                <input type='text' name='updated_at' id='updated_at' value='{{ $user_management->updated_at }}' required><br><br>
        <button type="submit">Update</button>
    </form>
@endsection