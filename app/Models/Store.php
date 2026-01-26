<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\itemVariant;
class Store extends Model
{
    protected $fillable = [
        'name',
        'location',
        'status',
    ];

    // Items in this store
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('active')
            ->withTimestamps();
    }

    // Inventory locations
    public function inventoryLocations()
    {
        return $this->hasMany(ItemInventoryLocation::class, 'store_id');
    }

    // Variants for this store with pivot info
// Store.php
    public function variants()
    {
        return $this->hasMany(StoreVariant::class);
    }


    public function sellers()
    {
        return $this->hasMany(User::class)->where('role', 'seller');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
