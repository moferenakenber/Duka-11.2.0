<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemVariant;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Noteit',
                'description' => 'A sample notebook',
                'category_id' => 1,       // main category ID
                'subcategory_id' => 2,    // subcategory ID
                'color_ids' => [1, 2],
                'size_ids' => [1, 2],
                'packagings' => [
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 10],
                ],
                'variant_images' => [
                    // key = colorId-sizeId-packagingId
                    '1-1-1' => [
                        asset("images/product_images/Noteit_red_small_piece_1.jpg"),
                        asset("images/product_images/Noteit_red_small_piece_2.jpg"),
                    ],
                    '1-2-1' => [
                        asset("images/product_images/Noteit_red_medium_piece_1.jpg"),
                    ],
                    '2-1-1' => [
                        asset("images/product_images/Noteit_blue_small_piece_1.jpg"),
                    ],
                    '2-2-2' => [
                        asset("images/product_images/Noteit_blue_medium_box_1.jpg"),
                    ],
                ],
            ],
            [
                'name' => 'Ring',
                'description' => 'A decorative ring',
                'category_id' => 5,
                'subcategory_id' => 8,
                'color_ids' => [3, 4],
                'size_ids' => [2, 3],
                'packagings' => [
                    ['id' => 2, 'quantity' => 1],
                ],
                'variant_images' => [
                    '3-2-2' => [
                        asset("images/product_images/Ring_gold_medium_box_1.jpg"),
                    ],
                    '4-3-2' => [
                        asset("images/product_images/Ring_silver_large_box_1.jpg"),
                    ],
                ],
            ],
        ];

        foreach ($items as $itemData) {
            // Set product images
            $images = [
                asset("images/product_images/{$itemData['name']}_1.jpg"),
                asset("images/product_images/{$itemData['name']}_2.jpg"),
            ];

            // Determine category (use subcategory if exists)
            $assignCategoryId = $itemData['subcategory_id'] ?? $itemData['category_id'];

            // Create the item
            $item = Item::create([
                'product_name' => $itemData['name'],
                'product_description' => $itemData['description'],
                'product_images' => json_encode($images),
                'status' => 'inactive',
                'sold_count' => 0,
                'category_id' => $assignCategoryId,
            ]);

            // Sync colors & sizes
            $item->colors()->sync($itemData['color_ids']);
            $item->sizes()->sync($itemData['size_ids']);

            // Sync packagings with quantity
            $pivotData = [];
            foreach ($itemData['packagings'] as $pkg) {
                $pivotData[$pkg['id']] = ['quantity' => $pkg['quantity']];
            }
            $item->packagingTypes()->sync($pivotData);

            // Generate all possible variants
            foreach ($itemData['color_ids'] as $colorId) {
                foreach ($itemData['size_ids'] as $sizeId) {
                    foreach ($itemData['packagings'] as $pkg) {
                        // Build variant key
                        $key = "{$colorId}-{$sizeId}-{$pkg['id']}";

                        // Use variant images if defined, else empty array
                        $variantImages = $itemData['variant_images'][$key] ?? [];

                        \App\Models\ItemVariant::create([
                            'item_id' => $item->id,
                            'item_color_id' => $colorId,
                            'item_size_id' => $sizeId,
                            'item_packaging_type_id' => $pkg['id'],
                            'price' => 0,
                            'discount_price' => null,
                            'barcode' => null,
                            'images' => json_encode($variantImages),
                            'is_active' => false,
                            'status' => 'inactive',
                        ]);
                    }
                }
            }
        }
    }
}
