<!-- Create View for user_management -->

@extends('layouts.app')

@section('content')
    <h1>Create user_management</h1>
    <form action="{{ route('user_management.store') }}" method="POST">
        @csrf
        <label for='user_id'>User id</label>
                <input type='text' name='user_id' id='user_id' required><br><br><label for='permissions'>Permissions</label>
                <input type='text' name='permissions' id='permissions' required><br><br><label for='login_history'>Login history</label>
                <input type='text' name='login_history' id='login_history' required><br><br><label for='status'>Status</label>
                <input type='text' name='status' id='status' required><br><br><label for='payroll_id'>Payroll id</label>
                <input type='text' name='payroll_id' id='payroll_id' required><br><br><label for='payment_history_id'>Payment history id</label>
                <input type='text' name='payment_history_id' id='payment_history_id' required><br><br><label for='created_at'>Created at</label>
                <input type='text' name='created_at' id='created_at' required><br><br><label for='updated_at'>Updated at</label>
                <input type='text' name='updated_at' id='updated_at' required><br><br>
        <button type="submit">Create</button>
    </form>
@endsection