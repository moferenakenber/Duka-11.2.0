<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    public function view(User $user, OrderItemPolicy $model)
    {
        return true;
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, OrderItemPolicy $model)
    {
        return true;
    }
    public function delete(User $user, OrderItemPolicy $model)
    {
        return true;
    }
}