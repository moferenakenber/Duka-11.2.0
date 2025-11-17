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
        // $owner = User::first(); // Make sure at least one user exists
        // $items = Item::all();


        // $colors = ItemColor::all()->keyBy('name');
        // $sizes = ItemSize::all()->keyBy('name');
        // $packagings = ItemPackagingType::all()->keyBy('name');

        // // Default discount for seeding
        // $defaultDiscount = 10;

        // // Ensure these exist, or manually create them beforehand
        // $colorRed = ItemColor::where('name', 'Red')->first();
        // $color3subjectRed = ItemColor::where('name', '3_subject_red')->first();
        // $color3subjectBlue = ItemColor::where('name', '3_subject_blue')->first();

        // $color4subjectBlack = ItemColor::where('name', '4_subject_black')->first();
        // $color4subjectRed = ItemColor::where('name', '4_subject_red')->first();
        // $color4subjectGreen = ItemColor::where('name', '4_subject_green')->first();


        // $colorBlue = ItemColor::where('name', 'Blue')->first();
        // $colorBlack = ItemColor::where('name', 'Black')->first();
        // $colorYellow = ItemColor::where('name', 'Yellow')->first();
        // $colorGreen = ItemColor::where('name', 'Green')->first();
        // $colorWhite = ItemColor::where('name', 'White')->first();
        // $colorPurple = ItemColor::where('name', 'Purple')->first();
        // $colorPink = ItemColor::where('name', 'Pink')->first();
        // $colorOrange = ItemColor::where('name', 'Orange')->first();
        // $colorGray = ItemColor::where('name', 'Gray')->first();
        // $colorBrown = ItemColor::where('name', 'Brown')->first();
        // $colorGold = ItemColor::where('name', 'Gold')->first();
        // $colorSilver = ItemColor::where('name', 'Silver')->first();


        // $sizeSmall = ItemSize::where('name', 'Small')->first();
        // $sizeMedium = ItemSize::where('name', 'Medium')->first();
        // $sizeLarge = ItemSize::where('name', 'Large')->first();

        // $noteitSize = ItemSize::where('name', 'Noteit3x3')->first();
        // $noteitSize2 = ItemSize::where('name', 'Noteit4x4')->first();
        // $noteitSize3 = ItemSize::where('name', 'Noteit5x5')->first();

        // $piecePackaging = ItemPackagingType::where('name', 'Piece')->first();
        // $packetPackaging = ItemPackagingType::where('name', 'Packet')->first();
        // $cartoonPackaging = ItemPackagingType::where('name', 'Cartoon')->first();

        // // Custom variations per item index (0-based)
        // $variationsPerItem = [

        //     // 'noteit',
        //     [
        //         // Yellow 3x3 - Piece, Packet, Cartoon
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 1],

        //         // Yellow 4x4
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

        //         // Yellow 5x5
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],


        //         // GREEN
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 946],
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 2],

        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],

        //         // RED
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 866],
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],

        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 6],

        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 7],
        //     ],

        //     [
        //         // Yellow 6 - Packet, Cartoon
        //         ['color' => 'Yellow', 'size' => '6', 'packaging' => 'Packet', 'price' => 240, 'stock' => 55],
        //         ['color' => 'Yellow', 'size' => '6', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 5],
        //         // Yellow 8
        //         ['color' => 'Yellow', 'size' => '8', 'packaging' => 'Packet', 'price' => 240, 'stock' => 54],
        //         ['color' => 'Yellow', 'size' => '8', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 3],
        //         // Yellow 10
        //         ['color' => 'Yellow', 'size' => '10', 'packaging' => 'Packet', 'price' => 240, 'stock' => 58],
        //         ['color' => 'Yellow', 'size' => '10', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 3],
        //         // Yellow 12
        //         ['color' => 'Yellow', 'size' => '12', 'packaging' => 'Packet', 'price' => 240, 'stock' => 59],
        //         ['color' => 'Yellow', 'size' => '12', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 7],
        //         // Yellow 14
        //         ['color' => 'Yellow', 'size' => '14', 'packaging' => 'Packet', 'price' => 240, 'stock' => 56],
        //         ['color' => 'Yellow', 'size' => '14', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 7],
        //         // Yellow 16
        //         ['color' => 'Yellow', 'size' => '16', 'packaging' => 'Packet', 'price' => 240, 'stock' => 45],
        //         ['color' => 'Yellow', 'size' => '16', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 8],
        //         // Yellow 18
        //         ['color' => 'Yellow', 'size' => '18', 'packaging' => 'Packet', 'price' => 240, 'stock' => 46],
        //         ['color' => 'Yellow', 'size' => '18', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 20
        //         ['color' => 'Yellow', 'size' => '20', 'packaging' => 'Packet', 'price' => 240, 'stock' => 75],
        //         ['color' => 'Yellow', 'size' => '20', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 22
        //         ['color' => 'Yellow', 'size' => '22', 'packaging' => 'Packet', 'price' => 240, 'stock' => 70],
        //         ['color' => 'Yellow', 'size' => '22', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 65],
        //         // Yellow 24
        //         ['color' => 'Yellow', 'size' => '24', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '24', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 1],
        //         // Yellow 26
        //         ['color' => 'Yellow', 'size' => '26', 'packaging' => 'Packet', 'price' => 240, 'stock' => 60],
        //         ['color' => 'Yellow', 'size' => '26', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 34],
        //         // Yellow 28
        //         ['color' => 'Yellow', 'size' => '28', 'packaging' => 'Packet', 'price' => 240, 'stock' => 23],
        //         ['color' => 'Yellow', 'size' => '28', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 30
        //         ['color' => 'Yellow', 'size' => '30', 'packaging' => 'Packet', 'price' => 240, 'stock' => 23],
        //         ['color' => 'Yellow', 'size' => '30', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 5],
        //         // Yellow 32
        //         ['color' => 'Yellow', 'size' => '32', 'packaging' => 'Packet', 'price' => 240, 'stock' => 32],
        //         ['color' => 'Yellow', 'size' => '32', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 12],

        //         // Blue 6 - Packet, Cartoon
        //         ['color' => 'Blue', 'size' => '6', 'packaging' => 'Packet', 'price' => 240, 'stock' => 55],
        //         ['color' => 'Blue', 'size' => '6', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 5],
        //         // Yellow 8
        //         ['color' => 'Blue', 'size' => '8', 'packaging' => 'Packet', 'price' => 240, 'stock' => 54],
        //         ['color' => 'Blue', 'size' => '8', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 3],
        //         // Yellow 10
        //         ['color' => 'Blue', 'size' => '10', 'packaging' => 'Packet', 'price' => 240, 'stock' => 58],
        //         ['color' => 'Blue', 'size' => '10', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 3],
        //         // Yellow 12
        //         ['color' => 'Blue', 'size' => '12', 'packaging' => 'Packet', 'price' => 240, 'stock' => 59],
        //         ['color' => 'Blue', 'size' => '12', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 7],
        //         // Yellow 14
        //         ['color' => 'Blue', 'size' => '14', 'packaging' => 'Packet', 'price' => 240, 'stock' => 56],
        //         ['color' => 'Blue', 'size' => '14', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 7],
        //         // Yellow 16
        //         ['color' => 'Blue', 'size' => '16', 'packaging' => 'Packet', 'price' => 240, 'stock' => 45],
        //         ['color' => 'Blue', 'size' => '16', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 8],
        //         // Yellow 18
        //         ['color' => 'Blue', 'size' => '18', 'packaging' => 'Packet', 'price' => 240, 'stock' => 46],
        //         ['color' => 'Blue', 'size' => '18', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 20
        //         ['color' => 'Blue', 'size' => '20', 'packaging' => 'Packet', 'price' => 240, 'stock' => 75],
        //         ['color' => 'Blue', 'size' => '20', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 22
        //         ['color' => 'Blue', 'size' => '22', 'packaging' => 'Packet', 'price' => 240, 'stock' => 70],
        //         ['color' => 'Blue', 'size' => '22', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 65],
        //         // Yellow 24
        //         ['color' => 'Blue', 'size' => '24', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Blue', 'size' => '24', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 1],
        //         // Yellow 26
        //         ['color' => 'Blue', 'size' => '26', 'packaging' => 'Packet', 'price' => 240, 'stock' => 60],
        //         ['color' => 'Blue', 'size' => '26', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 34],
        //         // Yellow 28
        //         ['color' => 'Blue', 'size' => '28', 'packaging' => 'Packet', 'price' => 240, 'stock' => 23],
        //         ['color' => 'Blue', 'size' => '28', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],
        //         // Yellow 30
        //         ['color' => 'Blue', 'size' => '30', 'packaging' => 'Packet', 'price' => 240, 'stock' => 23],
        //         ['color' => 'Blue', 'size' => '30', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 5],
        //         // Yellow 32
        //         ['color' => 'Blue', 'size' => '32', 'packaging' => 'Packet', 'price' => 240, 'stock' => 32],
        //         ['color' => 'Blue', 'size' => '32', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 12],

        //     ],
        //     [
        //         // Yellow 3x3 - Piece, Packet, Cartoon
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 1],

        //         // Yellow 4x4
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

        //         // Yellow 5x5
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Yellow', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],


        //         // GREEN
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 946],
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 2],

        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 1],

        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Green', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 1],

        //         // RED
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Piece', 'price' => 25, 'stock' => 866],
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Packet', 'price' => 240, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '3x3', 'packaging' => 'Cartoon', 'price' => 12000, 'stock' => 4],

        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Piece', 'price' => 35, 'stock' => 500],
        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Packet', 'price' => 340, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '4x4', 'packaging' => 'Cartoon', 'price' => 17000, 'stock' => 6],

        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Piece', 'price' => 45, 'stock' => 500],
        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Packet', 'price' => 440, 'stock' => 50],
        //         ['color' => 'Red', 'size' => '5x5', 'packaging' => 'Cartoon', 'price' => 22000, 'stock' => 7],
        //     ],


        // ];

        // // Helper function to create a variant
        // $createVariant = function ($item, $v) use ($owner, $colors, $sizes, $packagings) {
        //     $colorObj = $colors[$v['color']] ?? null;

        //     return ItemVariant::create([
        //         'item_id' => $item->id,
        //         'item_color_id' => $colorObj->id ?? null,
        //         'item_size_id' => $sizes[$v['size']]->id ?? null,
        //         'item_packaging_type_id' => $packagings[$v['packaging']]->id ?? null,
        //         'price' => $v['price'],
        //         'discount_price' => $v['price'],
        //         'owner_id' => $owner->id,
        //         'status' => 'active',
        //         // Only set image for new variants being seeded
        //         'images' => isset($v['images']) ? $v['images'] : null,
        //     ]);
        // };



        // foreach ($items as $index => $item) {
        //     $variations = $variationsPerItem[$index] ?? null;

        //     if ($variations) {
        //         foreach ($variations as $v) {
        //             // Create the variant
        //             $variant = $createVariant($item, $v);

        //             // Create the stock for this variant
        //             \App\Models\ItemStock::create([
        //                 'item_variant_id' => $variant->id,
        //                 'item_inventory_location_id' => 1, // default warehouse
        //                 'quantity' => $v['stock'] ?? 0,
        //             ]);
        //         }
        //     } else {
        //         // Fallback variants
        //         $variant = $createVariant($item, [
        //             'color' => 'Red',
        //             'size' => 'Small',
        //             'packaging' => 'Packet',
        //             'price' => 100,
        //             'stock' => 50,
        //         ]);

        //         \App\Models\ItemStock::create([
        //             'item_variant_id' => $variant->id,
        //             'item_inventory_location_id' => 1,
        //             'quantity' => 50,
        //         ]);

        //         $variant = $createVariant($item, [
        //             'color' => 'Blue',
        //             'size' => 'Large',
        //             'packaging' => 'Packet',
        //             'price' => 200,
        //             'stock' => 30,
        //         ]);

        //         \App\Models\ItemStock::create([
        //             'item_variant_id' => $variant->id,
        //             'item_inventory_location_id' => 1,
        //             'quantity' => 30,
        //         ]);
        //     }
        // }


    }
}
