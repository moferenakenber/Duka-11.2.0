<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    // Many-to-Many Relationship with Item
    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'item_category_item',
            'category_id',
            'item_id'
        );
    }

}
