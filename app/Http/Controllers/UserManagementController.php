<?php

namespace App\Http\Controllers;

use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{
    public function index()
    {

        //$product = UserManagement::all();

        $users = User::all(); // Fetch all users
        return view('user_managements.index', compact('users'));
    }

    public function create()
    {
        return view('user_managements.create');
    }

    public function store(Request $request)
    {

        $user = new User();

        $validatedUser = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|regex:/^[0-9]{10}$/|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,seller,stock_keeper', // Ensures role is one of the specified values
            'password' => 'required|string|min:8|confirmed', // Validates password with confirmation field
        ]);

        // Capitalize the first and last name
        $first_name = ucwords(strtolower($validatedUser['first_name']));
        $last_name = ucwords(strtolower($validatedUser['last_name']));

        Log::info('User Data:', $validatedUser);  // Log the validated data

        $user = User::create([
            'first_name' => $first_name, // Used the capitalized first_name
            'last_name' => $last_name, // Used the capitalized last_name
            'phone_number' => $validatedUser['phone_number'],
            'email' => $validatedUser['email'],
            'role' => $validatedUser['role'],
        //    'password' => $validatedUser['password'],
            'password' => bcrypt($validatedUser['password']), // Encrypted password for later use
        ]);

        return redirect()->route('admin.user_managements.index')->with('success', 'user registered successfully!');
    }

    public function show(UserManagement $userManagement)
    {
        return view('user_managements.show', ['userManagement' => $userManagement]);
    }

    public function edit(UserManagement $userManagement)
    {
        return view('user_managements.edit', ['userManagement' => $userManagement]);
    }

    public function update(Request $request, UserManagement $userManagement)
    {
        $columns = Schema::getColumnListing('user_management');
        $rules = [];
        foreach ($columns as $column) {
            if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                $rules[$column] = 'sometimes|required';
            }
        }
        $data = $request->validate($rules);
        $userManagement->update($data);
        return $userManagement;
    }

    public function destroy(UserManagement $userManagement)
    {
        $userManagement->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
