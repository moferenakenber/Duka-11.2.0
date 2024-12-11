<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, OrderPolicy $model)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, OrderPolicy $model)
    {
        return true;
    }
    public function delete(User $user, OrderPolicy $model)
    {
        return true;
    }
}