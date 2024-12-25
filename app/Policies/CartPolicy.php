<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cart;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

        /**
     * Determine if the given user can view the cart.
     */
    public function view(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }

    /**
     * Determine if the given user can update the cart.
     */
    public function update(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }

    /**
     * Determine if the given user can delete the cart.
     */
    public function delete(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }
}
