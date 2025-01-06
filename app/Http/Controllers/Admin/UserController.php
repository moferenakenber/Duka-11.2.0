<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



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

        // Log the raw role value and the old value being used for comparison
        Log::info('Raw Role Value:', ['role' => $user->role]);
        Log::info('Old Role Value in Form:', ['old_role' => old('role', $user->role)]);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Log the incoming request data
        Log::info('Updating user data', ['request' => $request->all()]);

        // Validate non-password fields first
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,  // Unique email number
            'role' => 'required|string|in:admin,seller,stock_keeper,user',
        ]);

        // Check if any of the non-password data has changed before updating
        $changes = false;
        $userAttributes = ['first_name', 'last_name', 'phone_number', 'email', 'role'];

        foreach ($userAttributes as $attribute) {
            // Use the form input or default to the existing user data
            $newValue = $request->input($attribute, $user->$attribute);

            if (strtolower($user->$attribute) !== strtolower($newValue)) {
                $changes = true;
                Log::info("Detected change in field {$attribute}", ['old' => $user->$attribute, 'new' => $newValue]);
            }
        }

        // If the password is provided, validate it
        if ($request->filled('password')) {
            $validatedData['password'] = $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ])['password']; // Add validated password to the update array
            $changes = true;  // Password change is considered as a change
        }

        // If changes were made, save the user
        if ($changes) {
            Log::info('Changes were made');
            // Update the user if changes exist
            $user->update($validatedData);
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } else {
            Log::info('No changes detected, no update performed');
            return redirect()->route('admin.users.index')->with('info', 'No changes were made.');
        }
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
