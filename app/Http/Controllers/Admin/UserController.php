<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        //$users = User::with('customers')->get(); // Eager load customers
        // $users = User::with(['customers', 'creator'])->get();
             // Fetch all users and include the user who created them
             $users = User::with('creator')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|max:20',
            'role' => 'required|string|in:admin,seller,stock_keeper,user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Add 'created_by' field as the current authenticated user
        $validatedData['created_by'] = auth()->id(); // Set the current user as the creator

        $user = User::create($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $users = User::with('creator')->get();
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,seller,stock_keeper,user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
