<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreVariant extends Model
{
    protected $table = 'store_variant';

    protected $fillable = [
        'store_id',
        'item_variant_id',
        'price',
        'discount_price',
        'active',
        'discount_ends_at'
    ];

    // If a store variant has seller-specific prices
    public function sellerPrices()
    {
        return $this->hasMany(StoreVariantSellerPrice::class); // adjust class name
    }

    public function customerPrices()
    {
        return $this->hasMany(StoreVariantCustomerPrice::class); // adjust class name
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function variant()
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant_id');
    }
}
