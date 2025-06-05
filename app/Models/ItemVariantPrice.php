<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVariantPrice extends Model
{
    use HasFactory;

    protected $table = 'item_variant_prices';

    protected $fillable = [
        'item_variant_id',
        'user_id',        // or 'customer_id'
        'applies_to_role', // Changed from role_id
        'price',
        'currency',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function itemVariant(): BelongsTo
    {
        return $this->belongsTo(ItemVariant::class);
    }

    public function user(): BelongsTo // or customer()
    {
        return $this->belongsTo(User::class, 'user_id');
        // return $this->belongsTo(Customer::class, 'customer_id');
    }

    // No more role() relationship needed here as applies_to_role is just a string.
}
