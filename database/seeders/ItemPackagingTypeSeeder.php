<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemPackagingType;

class ItemPackagingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $packagingTypes = [
            'Piece',
            'Packet',
            'Cartoon',
            'Box',
            'Bundle',
            'Bag',

        ];

        foreach ($packagingTypes as $type) {
            ItemPackagingType::create([
                'name' => $type,
            ]);
        }
    }
}
