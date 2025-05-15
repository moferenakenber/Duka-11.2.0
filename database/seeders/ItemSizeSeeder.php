<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemSize;

class ItemSizeSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one item exists
        $item = Item::firstOrFail();

        $sizes = [
            ['name' => 'Small',  'image_path' => 'images/sizes/s.png'],
            ['name' => 'Medium',  'image_path' => 'images/sizes/m.png'],
            ['name' => 'Large',  'image_path' => 'images/sizes/l.png'],
            ['name' => 'A1', 'image_path' => 'images/sizes/a1.png'],
            ['name' => 'A2', 'image_path' => 'images/sizes/a2.png'],
        ];

        foreach ($sizes as $size) {
            ItemSize::create([
                'name' => $size['name'],
                'image_path' => $size['image_path'],
                'disabled' => false,
                'item_id' => $item->id,
                'itemid' => $item->id,
            ]);
        }
    }
}
