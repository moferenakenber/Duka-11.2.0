<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemColor;

class ItemColorSeeder extends Seeder
{
    public function run()
    {
        $itemsWithColors = [
            [
                'name' => '2 side color',
                'colors' => [
                    ['name' => 'Red', 'suffix' => 'red'],
                    ['name' => 'Blue', 'suffix' => 'blue'],
                ],
            ],
            [
                'name' => '2025 -1',
                'colors' => [
                    ['name' => 'Red', 'suffix' => 'red'],
                    ['name' => 'Blue', 'suffix' => 'blue'],
                ],
            ],
            [
                'name' => '2025 ብልጭልጭ',
                'colors' => [
                    ['name' => 'Black', 'suffix' => 'black'],
                ],
            ],
            [
                'name' => '25k - 1 ፓሪስ',
                'colors' => [
                    ['name' => 'Red', 'suffix' => 'red'],
                    ['name' => 'Blue', 'suffix' => 'blue'],
                ],
            ],
            [
                'name' => '25k- 5 ጨርቅ ማስታወሻ',
                'colors' => [
                    ['name' => 'Black', 'suffix' => 'black'],
                ],
            ],
            [
                'name' => 'Noteit',
                'colors' => [
                    ['name' => 'Red', 'suffix' => 'red'],
                    ['name' => 'Blue', 'suffix' => 'blue'],
                    ['name' => 'Green', 'suffix' => 'green'],
                    ['name' => 'Yellow', 'suffix' => 'yellow'],
                ],
            ]
        ];

        foreach ($itemsWithColors as $itemData) {
            $itemName = $itemData['name'];

            // Lookup by product_name column
            $item = Item::where('product_name', $itemName)->first();

            if (!$item) {
                echo "❌ Item '$itemName' not found — skipping.\n";
                continue;
            }

            // Clean slug: only English letters and numbers, replace others with _, trim underscores
            $slug = strtolower($itemName);
            $slug = preg_replace('/[^A-Za-z0-9]+/', '_', $slug);
            $slug = trim($slug, '_');

            foreach ($itemData['colors'] as $color) {
                ItemColor::create([
                    'name' => $color['name'],
                    'image_path' => "images/product_images/{$slug}_{$color['suffix']}.jpg",
                    'disabled' => false,
                    'item_id' => $item->id,
                ]);
                echo "✅ Seeded color {$color['name']} for item '{$itemName}'\n";
            }
        }
    }
}
