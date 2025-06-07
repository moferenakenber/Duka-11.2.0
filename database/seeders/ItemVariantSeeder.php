<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\ItemPackagingType;
use App\Models\ItemColor;
use App\Models\ItemSize;
use App\Models\User;

class ItemVariantSeeder extends Seeder
{
    public function run()
    {
        $owner = User::firstOrFail(); // Ensure user exists

        $items = Item::all();

        // Fetch and organize related models by name
        $colors = ItemColor::all()->keyBy('name');
        $sizes = ItemSize::all()->keyBy('name');
        $packagings = ItemPackagingType::all()->keyBy('name');

        $variationsPerItem = [
            // Index 0 (e.g. "Note It")
            [
                // Yellow 3x3 - Piece, Packet, Cartoon
                ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 500],
                ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
                ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 1],

                // Yellow 4x4
                ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
                ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
                ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

                // Yellow 5x5
                ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
                ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
                ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],


                // GREEN
                ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 946],
                ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
                ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 2],

                ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
                ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
                ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

                ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
                ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
                ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],

                // RED
                ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 866],
                ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
                ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],

                ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
                ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
                ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 6],

                ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
                ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
                ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 7],


                // Custom extra variants
                // ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 190, 'stock' => 140],
                // ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 130, 'stock' => 188],
            ],

            // You can add more for item index 1, 2, 3...
        ];

        foreach ($items as $index => $item) {
            $variations = $variationsPerItem[$index] ?? null;

            if ($variations) {
                foreach ($variations as $v) {
                    ItemVariant::create([
                        'item_id' => $item->id,
                        'item_color_id' => $colors[$v['color']]->id ?? null,
                        'item_size_id' => $sizes[$v['size']]->id ?? null,
                        'item_packaging_type_id' => $packagings[$v['packaging']]->id ?? null,
                        'price' => $v['price'],
                        'stock' => $v['stock'],
                        'owner_id' => $owner->id,
                    ]);
                }
            } else {
                // Default fallback
                ItemVariant::insert([
                    [
                        'item_id' => $item->id,
                        'item_color_id' => $colors['Red']->id,
                        'item_size_id' => $sizes['Small']->id,
                        'item_packaging_type_id' => $packagings['Packet']->id,
                        'price' => 100,
                        'stock' => 50,
                        'owner_id' => $owner->id,
                    ],
                    [
                        'item_id' => $item->id,
                        'item_color_id' => $colors['Blue']->id,
                        'item_size_id' => $sizes['Large']->id,
                        'item_packaging_type_id' => $packagings['Packet']->id,
                        'price' => 200,
                        'stock' => 30,
                        'owner_id' => $owner->id,
                    ]
                ]);
            }
        }
    }
}
