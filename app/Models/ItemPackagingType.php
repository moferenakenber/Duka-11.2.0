<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPackagingType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'quantity',
        'image_path',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    // Relationships (if any)

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'item_packaging_type_item',
            'item_packaging_type_id',
            'item_id'
        )
            ->withPivot('quantity') // include quantity
            ->withTimestamps();
    }



    public function variants()
    {
        return $this->hasMany(ItemVariant::class);
    }
}
