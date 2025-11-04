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
    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    // Many-to-many categories
    public function categories()
    {
        return $this->belongsToMany(
            ItemCategory::class,
            'item_category_item',
            'item_id',
            'category_id'
        );
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
    public function packagingTypes()
    {
        return $this->belongsToMany(ItemPackagingType::class, 'item_packaging_type_item', 'item_id', 'item_packaging_type_id')->withTimestamps();
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
}
