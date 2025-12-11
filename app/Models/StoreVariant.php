<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreVariant extends Model
{
    protected $table = 'store_variant';
    protected $fillable = [
        'store_id',
        'item_variant_id',
        'stock',
        'price',
        'discount_price',
        'discount_ends_at',
    ];

    public function variant()
    {
        return $this->belongsTo(\App\Models\ItemVariant::class, 'item_variant_id');
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }
}
