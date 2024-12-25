<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',       // The owner of the cart
        'customer_id',   // The customer associated with the cart
        // Add other attributes like 'status' or 'notes' if needed
    ];

    /**
     * Define the relationship to the user who owns the cart.
     * A cart belongs to a user (seller).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship to the customer associated with the cart.
     * A cart may be assigned to a customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Define the relationship to items in the cart.
     * A cart can have many items.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'cart_items')
            ->using(CartItem::class) // Use the custom CartItem model
            ->withPivot('quantity', 'price') // Include pivot attributes
            ->withTimestamps();
    }


    /**
     * Accessor to get the name of the cart.
     * If no customer is associated, fallback to a default name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        if ($this->customer) {
            return $this->customer->name . "'s Cart";
        }

        return 'Cart ' . $this->id;
    }
}
