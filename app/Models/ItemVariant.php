<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVariant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_variants'; // Explicitly set the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_color_id',
        'item_size_id',
        'item_packaging_type_id',
        'is_active',
        'price',
        'stock',
        'owner_id',
        'discount_price',
        'barcode',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    /**
     * Get the item that owns the variant.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the color associated with the variant.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(ItemColor::class, 'item_color_id');
    }

    /**
     * Get the size associated with the variant.
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(ItemSize::class, 'item_size_id');
    }

    /**
     * Get the packaging type associated with the variant.
     */
    public function packagingType(): BelongsTo
    {
        return $this->belongsTo(ItemPackagingType::class, 'item_packaging_type_id');
    }

    public function itemColor()
    {
        return $this->belongsTo(ItemColor::class);
    }

    public function itemSize()
    {
        return $this->belongsTo(ItemSize::class, 'item_size_id');
    }

    public function itemPackagingType()
    {
        return $this->belongsTo(ItemPackagingType::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function stocks()
    {
        return $this->hasMany(ItemStock::class, 'item_variant_id');
    }

    public function totalStock()
    {
        return $this->stocks()->sum('quantity');
    }



    // Variant.php
    protected static function booted()
    {
        static::saving(function ($variant) {
            // If price changed, recalc discount price if a percentage exists
            if ($variant->isDirty('price') && $variant->discount_percentage !== null) {
                $variant->discount_price = $variant->price * (1 - $variant->discount_percentage / 100);
            }

            // If discount_price changed manually, recalc percentage
            if ($variant->isDirty('discount_price') && $variant->discount_price !== null) {
                $variant->discount_percentage = (($variant->price - $variant->discount_price) / $variant->price) * 100;
            }

            // Optional: if no discount_percentage, set discount_price = price
            if ($variant->discount_percentage === null) {
                $variant->discount_price = $variant->price;
            }
        });
    }


}
