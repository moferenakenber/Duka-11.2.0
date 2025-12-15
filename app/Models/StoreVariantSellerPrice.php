<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreVariantSellerPrice extends Model
{
    protected $table = 'store_variant_seller_prices';

    protected $fillable = [
        'store_variant_id',
        'seller_id',
        'price',
        'discount_price',
        'discount_ends_at',
    ];

    protected $dates = ['discount_ends_at'];

    public function storeVariant(): BelongsTo
    {
        return $this->belongsTo(StoreVariant::class, 'store_variant_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
