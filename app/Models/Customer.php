<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'city',
        'created_by',
        'store_id',
        'tin_number',
    ];

    //     public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }


    /**
     * Get the user that created the customer.
     */
    // public function createdBy()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }


    /**
     * Get the creator (user) who created this customer.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Define the relationship to the user.
     * A customer is created by a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    /**
     * Define the relationship to carts.
     * A customer can have multiple carts associated with them.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
