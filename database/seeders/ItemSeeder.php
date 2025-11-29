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
                'name' => 'Noteit Sticky Note',

                'description' => 'NoteIt / Sticky Notes is a simple and convenient tool that helps you quickly capture your thoughts, reminders, and important information. With the ability to create, edit, and organize notes effortlessly, you can keep track of tasks, ideas, and deadlines in one place. Color-coded notes, search functionality, and optional reminders make it easy to prioritize and find what you need. Perfect for personal, school, or work use, NoteIt keeps your information accessible, organized, and always within reach.',

                'category_id' => 43,       // main category ID
                'subcategory_id' => 45,    // subcategory ID
                'color_ids' => [1, 2, 3, 4, 11],
                'size_ids' => [1, 2, 3],
                'packagings' => [
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 12],
                    ['id' => 3, 'quantity' => 18],
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

                'description' => 'Binding rings for punched papers, ideal for making notebooks or custom booklets. Durable and easy to use, these rings securely hold your documents together while allowing for easy page turning and addition or removal of pages as needed. Perfect for organizing notes, presentations, or any collection of loose-leaf papers.',

                'category_id' => 21,
                'subcategory_id' => 28,
                'color_ids' => [1, 2, 3, 4, 5],
                'size_ids' => [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34],
                'packagings' => [
                    ['id' => 2, 'quantity' => 50],
                    ['id' => 3, 'quantity' => 18],
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
            [
                'name' => 'Bic Pen',
                'description' => 'Classic Bic pens for smooth writing, reliable and long-lasting. Ideal for school, office, or personal use.',
                'category_id' => 11,       // Category ID
                'subcategory_id' => 12,    // Subcategory ID
                'color_ids' => [2, 5, 1],  // Available colors
                'size_ids' => [],           // No sizes
                'packagings' => [
                    ['id' => 1, 'quantity' => 1],   // Single pen
                    ['id' => 2, 'quantity' => 50],  // Packet of 50 pens
                    ['id' => 3, 'quantity' => 20],  // Box of 20 packets
                ],
                'variant_images' => [
                    '2-0-1' => [ // color_id 2, no size (0), packaging_id 1
                        asset("images/product_images/Bic_Blue_Single_1.jpg"),
                    ],
                    '5-0-2' => [ // color_id 5, no size (0), packaging_id 2
                        asset("images/product_images/Bic_Black_Packet_1.jpg"),
                    ],
                    '1-0-3' => [ // color_id 1, no size (0), packaging_id 3
                        asset("images/product_images/Bic_Red_Box_1.jpg"),
                    ],
                ],
            ],

        ];

        foreach ($items as $itemData) {
            $slugName = str_replace(' ', '_', $itemData['name']);

            // Main product images
            $images = [
                "images/product_images/{$slugName}_1.jpg",
                "images/product_images/{$slugName}_2.jpg",
            ];

            $assignCategoryId = $itemData['subcategory_id'] ?? $itemData['category_id'];

            $item = Item::create([
                'product_name' => $itemData['name'],
                'product_description' => $itemData['description'],
                'product_images' => json_encode($images),
                'status' => 'inactive',
                'sold_count' => 0,
                'category_id' => $assignCategoryId,
            ]);

            $item->colors()->sync($itemData['color_ids']);
            $item->sizes()->sync($itemData['size_ids']);

            // Packagings with quantity
            $pivotData = [];
            foreach ($itemData['packagings'] as $pkg) {
                $pivotData[$pkg['id']] = ['quantity' => $pkg['quantity']];
            }
            $item->packagingTypes()->sync($pivotData);

            // Sizes for variant generation
            $sizes = !empty($itemData['size_ids']) ? $itemData['size_ids'] : [null];

            foreach ($itemData['color_ids'] as $colorId) {
                foreach ($sizes as $sizeId) {
                    foreach ($itemData['packagings'] as $pkg) {
                        $key = "{$colorId}-" . ($sizeId ?? 0) . "-{$pkg['id']}";

                        // Try variant-specific image
                        $variantImages = $itemData['variant_images'][$key] ?? [];

                        // Fallback to a color-based image if no variant image
                        if (empty($variantImages)) {
                            $variantImages = [
                                "images/product_images/{$slugName}_Color_{$colorId}.jpg"
                            ];
                        }

                        // Fallback to default image if still empty
                        if (empty($variantImages)) {
                            $variantImages = ["images/product_images/default.jpg"];
                        }

                        ItemVariant::create([
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
