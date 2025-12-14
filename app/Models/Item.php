<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'packaging_details',
        'variation',
        'price',
        'product_images',
        'status',
        'category_id',
        'sold_count',
    ];

    protected $casts = [
        'product_images' => 'array', // Cast JSON column to array
    ];



    // Item belongs to a main category
    // public function category()
    // {
    //     return $this->belongsTo(ItemCategory::class);
    // }

    // // Many-to-many categories
    // public function categories()
    // {
    //     return $this->belongsToMany(
    //         ItemCategory::class,
    //         'item_category_item',
    //         'item_id',
    //         'category_id'
    //     );
    // }

    // Item.php
    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    // Many-to-many with colors
    public function colors()
    {
        return $this->belongsToMany(ItemColor::class, 'item_color_item', 'item_id', 'item_color_id')->withTimestamps();
    }

    // Many-to-many with sizes
    public function sizes()
    {
        return $this->belongsToMany(ItemSize::class, 'item_item_size', 'item_id', 'item_size_id')->withTimestamps();
    }

    // Many-to-many with packaging types
    // public function packagingTypes()
    // {
    //     return $this->belongsToMany(ItemPackagingType::class, 'item_packaging_type_item', 'item_id', 'item_packaging_type_id')->withTimestamps();
    // }
    public function packagingTypes()
    {
        return $this->belongsToMany(
            ItemPackagingType::class,
            'item_packaging_type_item',
            'item_id',
            'item_packaging_type_id'
        )
            ->withPivot('quantity')   // add this line
            ->withTimestamps();
    }




    // Variants
    public function variants()
    {
        return $this->hasMany(ItemVariant::class);
    }

    // Carts
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Images
    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function getPackagingDisplay(): array
    {
        // Sort packages by pivot_id to maintain hierarchy
        $packs = $this->packagingTypes->sortBy('pivot_id')->values();

        $result = [];
        $totals = [];

        foreach ($packs as $index => $pack) {
            $qty = $pack->pivot->quantity ?? 1;

            if ($index === 0) {
                // Base level (Piece or smallest pack)
                $totals[$pack->name] = $qty;
                $result[] = "{$pack->name}: {$qty} pcs";
            } else {
                // Total pieces = current quantity * previous total
                $prevPack = $packs[$index - 1];
                $totals[$pack->name] = $qty * $totals[$prevPack->name];

                // Build display text showing parent quantities
                $ancestorText = [];
                for ($i = $index - 1; $i >= 0; $i--) {
                    $childQty = $packs[$i + 1]->pivot->quantity ?? 1;
                    $ancestorText[] = "{$childQty} {$packs[$i]->name}";
                }
                $ancestorText = array_reverse($ancestorText);

                $display = "{$pack->name}: " . implode(', ', $ancestorText) . " ({$totals[$pack->name]} pcs)";
                $result[] = $display;
            }
        }

        return $result;
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class)
            ->withPivot('active')
            ->withTimestamps();
    }



    protected static function booted()
    {
        static::creating(function ($item) {
            if (!$item->sku) {
                // Use first 3 letters of product name + random 3 digits
                $namePart = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $item->product_name), 0, 3));
                $randomPart = mt_rand(100, 999);
                $item->sku = $namePart . $randomPart;
            }
        });
    }


}


