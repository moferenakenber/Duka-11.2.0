<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    protected $table = 'cart_items'; // Explicitly define the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity',
        'price',
    ];

    /**
     * Add a relationship to the Cart model.
     * A cart item belongs to a cart.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Add a relationship to the Item model.
     * A cart item is associated with an item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Calculate the total price for this cart item (quantity * price).
     *
     * @return float
     */
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->price;
    }
}
