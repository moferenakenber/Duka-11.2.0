<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'location',
        'status',
    ];


    public function itemVariants()
    {
        return $this->belongsToMany(ItemVariant::class, 'store_variant')
            ->withPivot('stock', 'price', 'discount_price', 'discount_ends_at')
            ->withTimestamps();
    }

}
