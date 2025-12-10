<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example stores
        $stores = [
            [
                'name' => 'Main Store',
                'location' => 'Merkato',
                'manager' => 'Mili',
            ],
            [
                'name' => 'Second Store',
                'location' => 'CMC',
                'manager' => 'User 2323',
            ],
            [
                'name' => 'Online Store',
                'location' => 'Gullele',
                'manager' => 'User 4234',
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
