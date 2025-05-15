<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemVariant;
use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemSize;
use App\Models\ItemPackagingType;

class ItemVariantSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some existing items, colors, sizes, and packaging types.
        $items = Item::all();
        $colors = ItemColor::all();
        $sizes = ItemSize::all();
        $packagingTypes = ItemPackagingType::all();

        if ($items->isEmpty()) {
            $this->command->warn('No items found. Please seed the Items table first.');
            return;
        }

        if ($colors->isEmpty()) {
            $this->command->warn('No colors found. Please seed the ItemColors table first.');
        }

        if ($sizes->isEmpty()) {
            $this->command->warn('No sizes found. Please seed the ItemSizes table first.');
        }

        if ($packagingTypes->isEmpty()) {
            $this->command->warn('No packaging types found. Please seed the ItemPackagingTypes table first.');
        }

        foreach ($items as $item) {
            // Create some variations for each item.
            ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => $colors->random()->id ?? null,
                'item_size_id' => $sizes->random()->id ?? null,
                'item_packaging_type_id' => $packagingTypes->random()->id ?? null,
                'is_active' => true,
            ]);

            ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => $colors->random()->id ?? null,
                'item_size_id' => null,
                'item_packaging_type_id' => null,
                'is_active' => true,
            ]);

            ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => null,
                'item_size_id' => $sizes->random()->id ?? null,
                'item_packaging_type_id' => $packagingTypes->random()->id ?? null,
                'is_active' => true,
            ]);

            ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => $colors->random()->id ?? null,
                'item_size_id' => $sizes->random()->id ?? null,
                'item_packaging_type_id' => null,
                'is_active' => false,
            ]);

            ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => null,
                'item_size_id' => null,
                'item_packaging_type_id' => null,
                'is_active' => true,
            ]);
        }
    }
}
