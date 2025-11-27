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

    // One-to-many: category → items
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id')
                    ->where('status', 'active'); // only active items
    }


}
