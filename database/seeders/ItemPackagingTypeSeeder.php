<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemPackagingType;

class ItemPackagingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $packagingTypes = [
            'piece',
            'packet',
            'carton',
            'box',
            'bundle',
            'bag',
        ];

        foreach ($packagingTypes as $type) {
            ItemPackagingType::create([
                'name' => $type,
            ]);
        }
    }
}
