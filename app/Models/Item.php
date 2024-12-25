<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'catoption', 'pacoption', 'price',
        'status', 'stock', 'image', 'piecesinapacket', 'packetsinacartoon'
    ];
    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }

    public function carts()
{
    return $this->belongsToMany(Cart::class, 'cart_items')
        ->withPivot('quantity', 'price')
        ->withTimestamps();
}

}
