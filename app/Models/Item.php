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
    ];
    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }
    public function category()
    {
        return $this->belongsTo(ItemCategory::class); // Update this to match your table name
    }


    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

}
