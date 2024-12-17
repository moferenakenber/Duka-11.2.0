<?php

namespace App\Http\Controllers;

use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserManagementController extends Controller
{
    public function index()
    {
        $product = UserManagement::all();
        return view('user_managements.index', compact('product'));
    }

    public function create()
    {
        return view('user_managements.create');
    }

    public function store(Request $request)
    {
        $columns = Schema::getColumnListing('user_management');
        $rules = [];
        foreach ($columns as $column) {
            if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                $rules[$column] = 'required';
            }
        }
        $data = $request->validate($rules);
        return UserManagement::create($data);
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
