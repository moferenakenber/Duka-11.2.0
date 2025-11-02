<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'name', 'description', 'catoption', 'pacoption', 'price',
        // 'status', 'stock', 'image', 'piecesinapacket', 'packetsinacartoon'
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
        'images' => 'array', // This helps Laravel automatically cast JSON to array
    ];
    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }
    public function category()
    {
        return $this->belongsTo(ItemCategory::class); // Update this to match your table name
    }

    // Many-to-Many Relationship with ItemCategory
    public function categories()
    {
        return $this->belongsToMany(ItemCategory::class, 'item_category_item', 'item_id', 'category_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class); // One-to-many relationship with images
    }
    public function colors()
    {
        return $this->hasMany(ItemColor::class); // One-to-many relationship with colors
    }

    public function variants()
    {
        return $this->hasMany(ItemVariant::class);
    }





}
