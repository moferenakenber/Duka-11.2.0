<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemVariant;
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
    public function variants()
    {
        return $this->belongsToMany(ItemVariant::class, 'store_variant')
            ->withPivot('price', 'discount_price', 'discount_ends_at')
            ->withTimestamps();
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
