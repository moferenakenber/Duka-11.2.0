<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'created_by',  // Add user_id if you want to associate customers with authenticated users
    ];

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
