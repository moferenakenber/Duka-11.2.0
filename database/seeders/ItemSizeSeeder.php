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
            ['name' => 'Noteit3x3', 'image_path' => 'images/sizes/3x3.png'],
            ['name' => 'Noteit4x4', 'image_path' => 'images/sizes/4x4.png'],
            ['name' => 'Noteit5x5', 'image_path' => 'images/sizes/5x5.png'],
            ['name' => '10X10', 'image_path' => 'images/sizes/10x10.png'],
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
