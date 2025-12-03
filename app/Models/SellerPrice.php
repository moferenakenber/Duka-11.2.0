<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPrice extends Model
{
    use HasFactory;

    protected $table = 'item_variant_seller_prices';

    protected $fillable = [
        'item_variant_id',
        'seller_id',
        'price',
        'discount_price',
        'discount_ends_at',
    ];

    public function variant()
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id'); // assuming sellers are users with role 'seller'
    }
}
