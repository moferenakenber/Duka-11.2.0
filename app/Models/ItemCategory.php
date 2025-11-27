<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'parent_id', // <-- allow mass assignment
    ];

    // Parent category
    public function parent()
    {
        return $this->belongsTo(ItemCategory::class, 'parent_id');
    }

    // Subcategories
    public function children()
    {
        return $this->hasMany(ItemCategory::class, 'parent_id');
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
