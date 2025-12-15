<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        'images',
        'status',
        'packaging_total_pieces',
        'sku',
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
        'images' => 'array', // so JSON becomes array automatically
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
    public function itemPackagingType(): BelongsTo
    {
        return $this->belongsTo(ItemPackagingType::class, 'item_packaging_type_id');
    }


    public function itemColor()
    {
        return $this->belongsTo(ItemColor::class, 'item_color_id');
    }

    public function itemSize()
    {
        return $this->belongsTo(ItemSize::class, 'item_size_id');
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

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_variant')
            ->withPivot('price', 'discount_price', 'active', 'discount_ends_at')
            ->withTimestamps();
    }


    // Customer-specific prices
    // public function customerPrices(): HasMany
    // {
    //     return $this->hasMany(CustomerPrice::class, 'item_variant_id');
    //     // 'item_variant_id' is the foreign key in the customer_prices table pointing to this variant
    // }

    // // Seller-specific prices
    // public function sellerPrices(): HasMany
    // {
    //     return $this->hasMany(SellerPrice::class, 'item_variant_id');
    //     // 'item_variant_id' is the foreign key in the seller_prices table pointing to this variant
    //}



    // In ItemVariant.php

    // Store-specific customer prices
    public function storeCustomerPrices()
    {
        return $this->hasMany(StoreVariantCustomerPrice::class, 'store_variant_id');
    }

    // Store-specific seller prices
    public function storeSellerPrices()
    {
        return $this->hasMany(StoreVariantSellerPrice::class, 'store_variant_id');
    }



    protected static function booted()
    {
        static::saving(function ($variant) {
            // ---------- Price / Discount Logic ----------
            if ($variant->isDirty('price') && $variant->discount_percentage !== null) {
                $variant->discount_price = $variant->price * (1 - $variant->discount_percentage / 100);
            }

            if ($variant->isDirty('discount_price') && $variant->discount_price !== null) {
                $variant->discount_percentage = (($variant->price - $variant->discount_price) / $variant->price) * 100;
            }

            if ($variant->discount_percentage === null) {
                $variant->discount_price = $variant->price;
            }
        });

        static::created(function ($variant) {
            if (!$variant->sku) {
                $itemSku = $variant->item?->sku ?? 'ITEM';
                $colorCode = $variant->item_color?->code ?? 'X';
                $sizeCode = $variant->item_size?->code ?? 'X';
                $packCode = $variant->item_packaging_type?->code ?? '1';

                $variant->sku = "{$itemSku}-{$colorCode}-{$sizeCode}-{$packCode}-{$variant->id}";
                $variant->saveQuietly(); // safe, id exists, guaranteed unique
            }
        });


    }



    public function calculateTotalPieces(): int
    {
        if (!$this->item_packaging_type_id)
            return 1;

        $item = $this->item;
        $packs = $item->packagingTypes->sortBy('pivot_id')->values();
        $total = 1;
        $found = false;

        foreach ($packs as $pack) {
            $qty = $pack->pivot->quantity ?? 1;
            $total *= $qty;

            if ($pack->id == $this->item_packaging_type_id) {
                $found = true;
                break;
            }
        }

        return $found ? $total : 1;
    }

    // app/Models/ItemVariant.php

    // In ItemVariant.php
    public function storeVariants()
    {
        return $this->hasMany(StoreVariant::class, 'item_variant_id');
    }


    public function item_stock()
    {
        return $this->hasOne(ItemStock::class, 'variant_id'); // or hasMany if multiple stocks
    }

    public function stockAtLocation($storeId)
    {
        return $this->stocks()->where('item_inventory_location_id', $storeId)->first()?->quantity ?? 0;
    }




}
