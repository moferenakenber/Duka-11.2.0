<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\ItemInventoryLocation;

class ItemInventoryLocationSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there is at least one store
        $store = Store::first() ?? Store::create(['name' => 'Main Store', 'status' => 'active']);

        // Create default inventory locations without location column
        ItemInventoryLocation::firstOrCreate([
            'name' => 'Shop',
            'store_id' => $store->id,
        ]);

        ItemInventoryLocation::firstOrCreate([
            'name' => 'Shop Warehouse',
            'store_id' => $store->id,
        ]);

        ItemInventoryLocation::firstOrCreate([
            'name' => 'Wesen Warehouse A',
            'store_id' => $store->id,
        ]);

        ItemInventoryLocation::firstOrCreate([
            'name' => 'Wesen Warehouse B',
            'store_id' => $store->id,
        ]);
    }
}
