<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_variant_id',
        'item_inventory_location_id',
        'quantity',
    ];

    // Optional: relationships
    public function variant()
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant_id');
    }

    public function inventoryLocation()
    {
        return $this->belongsTo(ItemInventoryLocation::class, 'item_inventory_location_id');
    }
}
