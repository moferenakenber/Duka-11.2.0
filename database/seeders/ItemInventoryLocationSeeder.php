<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemInventoryLocation;

class ItemInventoryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default warehouse if it doesn't exist
        ItemInventoryLocation::firstOrCreate(
            ['name' => 'Shop'],
            ['address' => 'Merkato']
        );

        // You can add more locations if needed
        ItemInventoryLocation::firstOrCreate(
            ['name' => 'Shop Warehouse'],
            ['address' => 'Merkato']
        );

        // You can add more locations if needed
        ItemInventoryLocation::firstOrCreate(
            ['name' => 'Wesen Warehouse A'],
            ['address' => 'Wesen']
        );

        ItemInventoryLocation::firstOrCreate(
            ['name' => 'Wesen Warehouse B'],
            ['address' => 'Wesen']
        );
    }
}
