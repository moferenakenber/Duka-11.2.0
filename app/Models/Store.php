<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'location',
        'status',
    ];


    // In Store.php
    public function itemVariants(Store $store, $itemId)
    {
        $variants = \App\Models\ItemVariant::where('item_id', $itemId)
            ->whereHas('stocks.inventoryLocation', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->with(['item', 'itemColor', 'itemSize', 'itemPackagingType', 'stocks.inventoryLocation'])
            ->get();

        $item = \App\Models\Item::findOrFail($itemId);

        return view('admin.stores.item_variants', compact('store', 'item', 'variants'));
    }




    // App\Models\Store.php
    public function inventoryLocations()
    {
        return $this->hasMany(ItemInventoryLocation::class, 'store_id');
    }


}
