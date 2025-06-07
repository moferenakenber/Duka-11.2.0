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
        // $item = Item::firstOrFail()
        $items = Item::all();

        $sizes = [
            ['name' => '3x3', 'image_path' => 'images/sizes/3x3.png'],
            ['name' => '4x4', 'image_path' => 'images/sizes/4x4.png'],
            ['name' => '5x5', 'image_path' => 'images/sizes/5x5.png'],
            ['name' => '10X10', 'image_path' => 'images/sizes/10x10.png'],
            ['name' => 'Small', 'image_path' => 'images/sizes/small.png'],
            ['name' => 'Medium', 'image_path' => 'images/sizes/medium.png'],
            ['name' => 'Large', 'image_path' => 'images/sizes/large.png'],
            ['name' => 'Extra Large', 'image_path' => 'images/sizes/extralarge.png'],
            ['name' => 'A1', 'image_path' => 'images/sizes/a1.png'],
            ['name' => 'A2', 'image_path' => 'images/sizes/a2.png'],
            ['name' => 'A3', 'image_path' => 'images/sizes/a3.png'],
            ['name' => 'A4', 'image_path' => 'images/sizes/a4.png'],
            ['name' => 'A5', 'image_path' => 'images/sizes/a5.png'],
            ['name' => 'A6', 'image_path' => 'images/sizes/a6.png'],
            ['name' => 'A7', 'image_path' => 'images/sizes/a7.png'],
            ['name' => 'A8', 'image_path' => 'images/sizes/a8.png'],
            ['name' => 'A9', 'image_path' => 'images/sizes/a9.png'],
            ['name' => 'A10', 'image_path' => 'images/sizes/a10.png'],
        ];
        foreach ($items as $item) {
            foreach ($sizes as $size) {
                ItemSize::create([
                    'name' => $size['name'],
                    'image' => $size['image_path'],
                    'price' => 0.00, // Default price, can be adjusted later
                    'disabled' => false,

                    'itemid' => $item->id,
                ]);
            }
        }
    }
}
