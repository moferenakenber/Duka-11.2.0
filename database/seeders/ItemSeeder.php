<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\ItemStock;

class ItemSeeder extends Seeder
{
    public function run(): void
    {

        $items = [
            [
                'name' => 'Noteit Sticky Note',
                'description' => 'NoteIt / Sticky Notes is a simple and convenient tool...',
                'category_id' => 43,
                'subcategory_id' => 45,
                'color_ids' => [1, 2, 3, 4, 11],
                'size_ids' => [1, 2, 3],
                'packagings' => [
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 12],
                    ['id' => 3, 'quantity' => 18],
                ],

                //// >>> NEW — Active packaging per item
                'active_packaging' => [1, 2],

                //// >>> NEW — Price rules per item
                'price_rules' => [
                    'base_price' => 10,      // starting price
                    'size_increase' => 10,   // +10% per size step
                    'packaging_discount' => [
                        1 => 0,
                        2 => 5,
                        3 => 12,
                    ],
                ],

                'variant_images' => [
                    '1-1-1' => ["images/product_images/Noteit_red_small_piece_1.jpg", "images/product_images/Noteit_red_small_piece_2.jpg"],
                    '1-2-1' => ["images/product_images/Noteit_red_medium_piece_1.jpg"],
                    '2-1-1' => ["images/product_images/Noteit_blue_small_piece_1.jpg"],
                    '2-2-2' => ["images/product_images/Noteit_blue_medium_box_1.jpg"],
                ],
            ],

            [
                'name' => 'Ring',
                'description' => 'Binding rings for punched papers...',
                'category_id' => 21,
                'subcategory_id' => 28,
                'color_ids' => [1, 2, 3, 4, 5],
                'size_ids' => [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34],
                'packagings' => [
                    ['id' => 2, 'quantity' => 50],
                    ['id' => 3, 'quantity' => 18],
                ],

                //// >>> NEW
                'active_packaging' => [2], // only packaging 2 is allowed for Ring

                //// >>> NEW — Ring price logic
                'price_rules' => [
                    'base_price' => 15,         // smallest size, any color
                    'size_increase' => 10,      // +10% for each next size
                    'packaging_discount' => [
                        2 => 0,
                        3 => 10,
                    ],
                ],

                'variant_images' => [
                    '3-2-2' => ["images/product_images/Ring_gold_medium_box_1.jpg"],
                    '4-3-2' => ["images/product_images/Ring_silver_large_box_1.jpg"]
                ],
            ],

            [
                'name' => 'Bic Pen',
                'description' => 'Classic Bic pens...',
                'category_id' => 11,
                'subcategory_id' => 12,
                'color_ids' => [2, 5, 1],
                'size_ids' => [], // no sizes
                'packagings' => [
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 50],
                    ['id' => 3, 'quantity' => 20],
                ],

                'active_packaging' => [1, 2],

                //// Price rules
                'price_rules' => [
                    'base_price' => 17,             // base price per piece
                    'size_increase' => 0,           // no size effect
                    'packaging_discount' => [
                        1 => 0,
                        2 => 8,
                        3 => 10,
                    ],
                    //// Color discount as percentage
                    'color_discount' => [
                        1 => 0,   // Red = no discount
                        2 => 12,   // Blue = 5% discount
                        5 => 6,   // Black = 10% discount
                    ],
                ],

                'variant_images' => [
                    'Bic Pen-Blue-Null-1' => [ // ItemName-Color-Size-Packaging
                        "images/product_images/Bic_Blue_Single_1.jpg",
                        "images/product_images/Bic_Blue_Single_2.jpg",
                    ],
                    'Bic Pen-Black-Null-2' => [
                        "images/product_images/Bic_Black_Packet_1.jpg",
                    ],
                    'Bic Pen-Red-Null-3' => [
                        "images/product_images/Bic_Red_Box_1.jpg",
                    ],
                ],
            ],

        ];

        foreach ($items as $itemData) {

            $slugName = str_replace(' ', '_', $itemData['name']);
            $images = [
                "images/product_images/{$slugName}_1.jpg",
                "images/product_images/{$slugName}_2.jpg",
            ];

            //// >>> UPDATED — item active if any active packaging exists
            $shouldBeActive = count($itemData['active_packaging']) > 0;

            $assignCategoryId = $itemData['subcategory_id'] ?? $itemData['category_id'];

            $item = Item::create([
                'product_name' => $itemData['name'],
                'product_description' => $itemData['description'],
                'product_images' => json_encode($images),
                'status' => $shouldBeActive ? 'active' : 'inactive',
                'sold_count' => 0,
                'category_id' => $assignCategoryId,
            ]);

            $item->colors()->sync($itemData['color_ids']);
            $item->sizes()->sync($itemData['size_ids']);

            //// existing logic untouched
            $pivotData = [];
            foreach ($itemData['packagings'] as $pkg) {
                $pivotData[$pkg['id']] = ['quantity' => $pkg['quantity']];
            }
            $item->packagingTypes()->sync($pivotData);

            $sizes = !empty($itemData['size_ids']) ? $itemData['size_ids'] : [null];

            $quantityMultiplier = 1; // start multiplier

            foreach ($itemData['color_ids'] as $colorId) {
                foreach ($sizes as $sizeId) {

                    $cumulativeQuantity = 1; // start at 1 for nested multiplication

                    foreach ($itemData['packagings'] as $index => $pkg) {
                        // calculate cumulative quantity
                        if ($index == 0) {
                            $cumulativeQuantity = $pkg['quantity'];
                        } elseif ($index == 1) {
                            $cumulativeQuantity = $pkg['quantity']; // 50
                        } elseif ($index == 2) {
                            $cumulativeQuantity = $itemData['packagings'][1]['quantity'] * $pkg['quantity']; // 50*20=1000
                        }

                        $variantShouldBeActive = in_array($pkg['id'], $itemData['active_packaging']);

                        $rules = $itemData['price_rules'];

                        $base = $rules['base_price'];
                        $sizeSteps = $sizeId ? array_search($sizeId, $itemData['size_ids']) : 0;
                        $sizeIncrease = $sizeSteps * $rules['size_increase'];
                        $packDiscount = $rules['packaging_discount'][$pkg['id']] ?? 0;
                        $colorDiscount = $rules['color_discount'][$colorId] ?? 0;

                        $finalPrice = ($base * $cumulativeQuantity)
                            * (1 + $sizeIncrease / 100)
                            * (1 - $packDiscount / 100)
                            * (1 - $colorDiscount / 100);

                        $colorName = \App\Models\ItemColor::find($colorId)?->name ?? 'Color_' . $colorId;
                        $sizeName = $sizeId ? \App\Models\ItemSize::find($sizeId)?->name : 'Null';
                        $packName = \App\Models\ItemPackagingType::find($pkg['id'])?->name ?? $pkg['id'];

                        $key = "{$itemData['name']}-{$colorName}-{$sizeName}-{$packName}";

                        $variantImages = [];
                        $slugItem = \Illuminate\Support\Str::slug($itemData['name']);
                        $slugColor = \Illuminate\Support\Str::slug($colorName);
                        $slugSize = \Illuminate\Support\Str::slug($sizeName);
                        $slugPack = \Illuminate\Support\Str::slug($packName);

                        $variantFolder = "images/product_images/{$slugItem}/{$slugColor}/{$slugSize}/{$slugPack}/";

                        // 1️⃣ Create folder if it doesn't exist
                        $path = public_path($variantFolder);
                        if (!is_dir($path)) {
                            mkdir($path, 0755, true); // recursive creation
                        }

                        // 2️⃣ Generate image paths
                        $variantImages = [];
                        for ($i = 1; $i <= 3; $i++) {
                            $variantImages[] = $variantFolder . "image_{$i}.jpg";
                        }






                        //$variantImages = $itemData['variant_images'][$key] ?? ["images/product_images/{$slugName}_Color_{$colorId}.jpg"];

                        if (empty($variantImages))
                            $variantImages = ["images/product_images/default.jpg"];

                        $variant = ItemVariant::create([
                            'item_id' => $item->id,
                            'item_color_id' => $colorId,
                            'item_size_id' => $sizeId,
                            'item_packaging_type_id' => $pkg['id'],
                            'price' => $finalPrice,
                            'discount_price' => null,
                            'barcode' => null,
                            'images' => $variantImages,
                            'is_active' => $variantShouldBeActive,
                            'status' => $variantShouldBeActive ? 'active' : 'inactive',
                        ]);

                        // // ----------------------
                        // // 1️⃣ Store Variant (base price)
                        // $storeVariant = \App\Models\StoreVariant::updateOrCreate(
                        //     [
                        //         'store_id' => 1,
                        //         'item_variant_id' => $variant->id
                        //     ],
                        //     [
                        //         'price' => $finalPrice,
                        //         'discount_price' => null,
                        //         'discount_ends_at' => null,
                        //         'active' => $variantShouldBeActive,
                        //     ]
                        // );

                        // // 2️⃣ Seed Seller Prices
                        // $sellers = \App\Models\User::where('role', 'seller')->get();
                        // foreach ($sellers as $seller) {
                        //     $storeVariant->sellerPrices()->updateOrCreate(
                        //         [
                        //             'store_variant_id' => $storeVariant->id,
                        //             'seller_id' => $seller->id
                        //         ],
                        //         [
                        //             'price' => $finalPrice * 0.98,
                        //             'discount_price' => null,
                        //             'discount_ends_at' => null,
                        //             'active' => true,
                        //         ]
                        //     );
                        // }

                        // // 3️⃣ Seed Customer Prices
                        // $customers = \App\Models\Customer::all();
                        // foreach ($customers as $customer) {
                        //     $storeVariant->customerPrices()->updateOrCreate(
                        //         [
                        //             'store_variant_id' => $storeVariant->id,
                        //             'customer_id' => $customer->id
                        //         ],
                        //         [
                        //             'price' => $finalPrice * 0.95,
                        //             'discount_price' => null,
                        //             'discount_ends_at' => null,
                        //             'active' => true,
                        //         ]
                        //     );
                        // }

                        // ----------------------
                        // Seed stock for this variant
                        // ItemStock::create([
                        //     '_variant_id' => $variant->id,
                        //     'quantity' => rand(0, 20), // random stock for testing
                        //     'item_inventory_location_id' => 1,           // assign to a store if needed
                        // ]);
                    }
                }
            }


        }
    }
}
