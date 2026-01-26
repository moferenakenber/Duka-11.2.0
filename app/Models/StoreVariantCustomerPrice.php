<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreVariantCustomerPrice extends Model
{
    protected $table = 'store_variants_customer_prices';

    protected $fillable = [
        'store_variant_id',
        'customer_id',
        'price',
        'discount_price',
        'discount_ends_at',
    ];

    protected $dates = ['discount_ends_at'];

    public function storeVariant(): BelongsTo
    {
        return $this->belongsTo(StoreVariant::class, 'store_variant_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
