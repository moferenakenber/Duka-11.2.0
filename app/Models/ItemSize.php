<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // If you need to hide any columns, put them here.
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // If you need to cast any columns to a specific type, put them here.
    ];

    // Relationships (if any)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function itemVariant ()
    {
        return $this->hasMany(ItemVariant::class);
    }

    public function variants()
    {
        return $this->hasMany(ItemVariant::class);
    }

}
