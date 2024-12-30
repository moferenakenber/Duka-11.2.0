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
        'user_id',       // The owner of the cart (could be a customer or seller)
        'seller_id',     // The seller assigned to the cart (assigned by admin)
        'customer_id',   // The customer associated with the cart (if relevant)
        'status',        // Could track the cart's current state (e.g., pending, processing)
    ];

    /**
     * Define the relationship to the user who owns the cart (for carts created by users).
     * A cart belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // This represents the user who created the cart
    }

    /**
     * Define the relationship to the seller who will process the cart.
     * A cart may be assigned to a seller by an admin.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Define the relationship to the customer associated with the cart.
     * A cart may be assigned to a customer for tracking.
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

    /**
     * Scope to get carts created by a user.
     */
    public function scopeCreatedByUser($query)
    {
        return $query->where('user_id', '!=', null);
    }

    /**
     * Scope to get carts assigned to a seller.
     */
    public function scopeAssignedToSeller($query)
    {
        return $query->where('seller_id', '!=', null);
    }

    /**
     * Scope to get carts assigned to a customer.
     */
    public function scopeAssignedToCustomer($query)
    {
        return $query->where('customer_id', '!=', null);
    }

    /**
     * Assign the cart to a seller by an admin.
     *
     * @param User $seller
     * @return void
     */
    public function assignToSeller(User $seller)
    {
        $this->update(['seller_id' => $seller->id]);
    }

    /**
     * Assign the cart to a customer.
     *
     * @param Customer $customer
     * @return void
     */
    public function assignToCustomer(Customer $customer)
    {
        $this->update(['customer_id' => $customer->id]);
    }
}














// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Cart extends Model
// {

//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array
//      */
//     protected $fillable = [
//         'user_id',       // The owner of the cart
//         'customer_id',   // The customer associated with the cart
//         // Add other attributes like 'status' or 'notes' if needed
//     ];


//     /**
//      * Define the relationship to the user who owns the cart.
//      * A cart belongs to a user (seller).
//      */
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     /**
//      * Define the relationship to the customer associated with the cart.
//      * A cart may be assigned to a customer.
//      */
//     public function customer()
//     {
//         return $this->belongsTo(Customer::class);
//     }

//     /**
//      * Define the relationship to items in the cart.
//      * A cart can have many items.
//      */
//     public function items()
//     {
//         return $this->belongsToMany(Item::class, 'cart_items')
//             ->using(CartItem::class) // Use the custom CartItem model
//             ->withPivot('quantity', 'price') // Include pivot attributes
//             ->withTimestamps();
//     }


//     /**
//      * Accessor to get the name of the cart.
//      * If no customer is associated, fallback to a default name.
//      *
//      * @return string
//      */
//     public function getNameAttribute()
//     {
//         if ($this->customer) {
//             return $this->customer->name . "'s Cart";
//         }

//         return 'Cart ' . $this->id;
//     }
// }
