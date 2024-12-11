<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user, ProductPolicy $model)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, ProductPolicy $model)
    {
        return true;
    }
    public function delete(User $user, ProductPolicy $model)
    {
        return true;
    }
}