<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the customers created by the user.
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'created_by');  // Inverse of 'belongsTo' in Customer
    }


    /**
     * Set the role attribute to lowercase before storing in the database.
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = strtolower($value);
    }

    /**
     * Format the role for display purposes (e.g., "Stock Keeper").
     */
    public function getRoleAttribute($value)
    {
        return ucwords(str_replace('_', ' ', strtolower($value)));
    }

        /**
     * Define the relationship to carts.
     * A user can create multiple carts.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
