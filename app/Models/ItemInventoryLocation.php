<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemInventoryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    // Relation to stocks
    public function stocks()
    {
        return $this->hasMany(ItemStock::class);
    }
}
