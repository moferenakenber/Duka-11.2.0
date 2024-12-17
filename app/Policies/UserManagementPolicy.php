<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserManagement;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserManagementPolicy
{
    use HandlesAuthorization;

    public function view(User $user, UserManagementPolicy $model)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, UserManagementPolicy $model)
    {
        return true;
    }
    public function delete(User $user, UserManagementPolicy $model)
    {
        return true;
    }
}