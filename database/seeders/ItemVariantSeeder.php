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
    public function run(): void
    {
        // // Get some required data
        // $item = Item::first(); // or use a factory to create one
        // $color = ItemColor::first() ?? ItemColor::factory()->create();
        // $size = ItemSize::first() ?? ItemSize::factory()->create();
        // $packaging = ItemPackagingType::first() ?? ItemPackagingType::factory()->create();
        // $owner = User::first(); // Make sure a user exists!

        // // Then get collections for random picking
        // $colors = ItemColor::all();
        // $sizes = ItemSize::all();
        // $packagings = ItemPackagingType::all();

        // // Create a few items
        // $items = Item::all();



        // // Seed a few variants
        // foreach ($items as $item) {

        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colors->random()->id, // ✅ must match the column name in the migration
        //         'item_size_id' => $size->id,
        //         'item_packaging_type_id' => $packaging->id,
        //         'price' => 16,
        //         'stock' => 100,
        //         'owner_id' => $owner->id,
        //     ]);

        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $color->id,
        //         'item_size_id' => $size->id,
        //         'item_packaging_type_id' => $packaging->id,
        //         'price' => 17,
        //         'stock' => 10,
        //         'owner_id' => $owner->id,
        //     ]);

        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colors->random()->id,
        //         'item_size_id' => $size->id,
        //         'item_packaging_type_id' => $packaging->id,
        //         'price' => 18,
        //         'stock' => 20,
        //         'owner_id' => $owner->id,
        //     ]);
        // }
////////////////////////////////////////////////////////////////////////
        // $owner = User::first(); // Make sure at least one user exists
        // $items = Item::all();

        // // Ensure these exist, or manually create them beforehand
        // $colorRed = ItemColor::where('name', 'Red')->first();
        // $colorBlue = ItemColor::where('name', 'Blue')->first();
        // $colorBlack = ItemColor::where('name', 'Black')->first();
        // $sizeSmall = ItemSize::where('name', 'Small')->first();
        // $sizeLarge = ItemSize::where('name', 'Large')->first();
        // $boxPackaging = ItemPackagingType::where('name', 'Box')->first();
        // $bagPackaging = ItemPackagingType::where('name', 'Bag')->first();

        // foreach ($items as $item) {
        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colorRed->id,
        //         'item_size_id' => $sizeSmall->id,
        //         'item_packaging_type_id' => $boxPackaging->id,
        //         'price' => 1000,
        //         'stock' => 50,
        //         'owner_id' => $owner->id,
        //     ]);

        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colorBlue->id,
        //         'item_size_id' => $sizeLarge->id,
        //         'item_packaging_type_id' => $bagPackaging->id,
        //         'price' => 1200,
        //         'stock' => 30,
        //         'owner_id' => $owner->id,
        //     ]);

        //     ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colorBlack->id,
        //         'item_size_id' => $sizeLarge->id,
        //         'item_packaging_type_id' => $boxPackaging->id,
        //         'price' => 1100,
        //         'stock' => 20,
        //         'owner_id' => $owner->id,
        //     ]);
        // }
        ///////////////////////////////////////////////////////////////////////////

        $owner = User::first(); // Make sure at least one user exists
        $items = Item::all();

        // Ensure these exist, or manually create them beforehand
        $colorRed = ItemColor::where('name', 'Red')->first();
        $colorBlue = ItemColor::where('name', 'Blue')->first();
        $colorBlack = ItemColor::where('name', 'Black')->first();
        $colorYellow = ItemColor::where('name', 'Yellow')->first();
        $colorGreen = ItemColor::where('name', 'Green')->first();
        $colorWhite = ItemColor::where('name', 'White')->first();
        $colorPurple = ItemColor::where('name', 'Purple')->first();
        $colorPink = ItemColor::where('name', 'Pink')->first();
        $colorOrange = ItemColor::where('name', 'Orange')->first();
        $colorGray = ItemColor::where('name', 'Gray')->first();
        $colorBrown = ItemColor::where('name', 'Brown')->first();
        $colorGold = ItemColor::where('name', 'Gold')->first();
        $colorSilver = ItemColor::where('name', 'Silver')->first();


        $sizeSmall = ItemSize::where('name', 'Small')->first();
        $sizeMedium = ItemSize::where('name', 'Medium')->first();
        $sizeLarge = ItemSize::where('name', 'Large')->first();

        $noteitSize = ItemSize::where('name', 'Noteit3x3')->first();
        $noteitSize2 = ItemSize::where('name', 'Noteit4x4')->first();
        $noteitSize3 = ItemSize::where('name', 'Noteit5x5')->first();

        $piecePackaging = ItemPackagingType::where('name', 'Piece')->first();
        $packetPackaging = ItemPackagingType::where('name', 'Packet')->first();
        $cartoonPackaging = ItemPackagingType::where('name', 'Cartoon')->first();

        // Custom variations per item index (0-based)
        $variationsPerItem = [
            // '2 side color',
            [
                [
                 'color' => $colorRed->id,
                 'size' => $sizeSmall->id,
                 'packaging' => $cartoonPackaging->id,
                 'price' => 950, 'stock' => 15
                ],

                [
                 'color' => $colorBlue->id,
                 'size' => $sizeLarge->id,
                 'packaging' => $piecePackaging->id,
                 'price' => 1450, 'stock' => 8
                ],
            ],
            // 'noteit',
            [
                [
                'color' => $colorRed->id,
                'size' => $noteitSize->id,
                'packaging' => $cartoonPackaging->id,
                'price' => 130,
                'stock' => 188
                ],

                [
                'color' => $colorYellow->id,
                'size' => $noteitSize2->id,
                'packaging' => $piecePackaging->id,
                'price' => 160,
                'stock' => 520
                ],

                [
                'color' => $colorGreen->id,
                'size' => $noteitSize3->id,
                'packaging' => $packetPackaging->id,
                'price' => 190,
                'stock' => 140
                ],

            ],
            // [
            //     ['color' => $colorBlue->id, 'size' => $sizeSmall->id, 'packaging' => $piecePackaging->id, 'price' => 1200, 'stock' => 10],
            //     ['color' => $colorBlack->id, 'size' => $sizeLarge->id, 'packaging' => $cartoonPackaging->id, 'price' => 1300, 'stock' => 5],
            // ],
            // [
            //     ['color' => $colorRed->id, 'size' => $sizeLarge->id, 'packaging' => $piecePackaging->id, 'price' => 1150, 'stock' => 20],
            //     ['color' => $colorBlue->id, 'size' => $sizeSmall->id, 'packaging' => $cartoonPackaging->id, 'price' => 1250, 'stock' => 18],
            // ],
            // [
            //     ['color' => $colorBlack->id, 'size' => $sizeLarge->id, 'packaging' => $piecePackaging->id, 'price' => 1350, 'stock' => 25],
            //     ['color' => $colorRed->id, 'size' => $sizeSmall->id, 'packaging' => $cartoonPackaging->id, 'price' => 1400, 'stock' => 30],
            // ],
            // [
            //     ['color' => $colorBlue->id, 'size' => $sizeLarge->id, 'packaging' => $piecePackaging->id, 'price' => 1500, 'stock' => 22],
            //     ['color' => $colorBlack->id, 'size' => $sizeSmall->id, 'packaging' => $cartoonPackaging->id, 'price' => 1550, 'stock' => 28],
            // ],
            // Add more if needed for more items
        ];

        foreach ($items as $index => $item) {
            if (isset($variationsPerItem[$index])) {
                foreach ($variationsPerItem[$index] as $v) {
                    ItemVariant::create([
                        'item_id' => $item->id,
                        'item_color_id' => $v['color'],
                        'item_size_id' => $v['size'],
                        'item_packaging_type_id' => $v['packaging'],
                        'price' => $v['price'],
                        'stock' => $v['stock'],
                        'owner_id' => $owner->id,
                    ]);
                }
            } else {
                // Default fallback variants
                ItemVariant::create([
                    'item_id' => $item->id,
                    'item_color_id' => $colorRed->id,
                    'item_size_id' => $sizeSmall->id,
                    'item_packaging_type_id' => $packetPackaging->id,
                    'price' => 100,
                    'stock' => 50,
                    'owner_id' => $owner->id,
                ]);

                ItemVariant::create([
                    'item_id' => $item->id,
                    'item_color_id' => $colorBlue->id,
                    'item_size_id' => $sizeLarge->id,
                    'item_packaging_type_id' => $packetPackaging->id,
                    'price' => 200,
                    'stock' => 30,
                    'owner_id' => $owner->id,
                ]);

                // ItemVariant::create([
                //     'item_id' => $item->id,
                //     'item_color_id' => $colorBlack->id,
                //     'item_size_id' => $sizeLarge->id,
                //     'item_packaging_type_id' => $packetPackaging->id,
                //     'price' => 300,
                //     'stock' => 20,
                //     'owner_id' => $owner->id,
                // ]);
            }
        }

    }
}
