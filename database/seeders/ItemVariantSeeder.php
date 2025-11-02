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
        $owner = User::first(); // Make sure at least one user exists
        $items = Item::all();


        $colors = ItemColor::all()->keyBy('name');
        $sizes = ItemSize::all()->keyBy('name');
        $packagings = ItemPackagingType::all()->keyBy('name');

          // Default discount for seeding
        $defaultDiscount = 10;

        // Ensure these exist, or manually create them beforehand
        $colorRed = ItemColor::where('name', 'Red')->first();
        $color3subjectRed = ItemColor::where('name', '3_subject_red')->first();
        $color3subjectBlue = ItemColor::where('name', '3_subject_blue')->first();

        $color4subjectBlack = ItemColor::where('name', '4_subject_black')->first();
        $color4subjectRed = ItemColor::where('name', '4_subject_red')->first();
        $color4subjectGreen = ItemColor::where('name', '4_subject_green')->first();


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

            // 'noteit',
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
            ],
        ];

                // Helper function to create a variant
        $createVariant = function($item, $v) use ($owner, $colors, $sizes, $packagings, $defaultDiscount) {
            $price = $v['price'];
            $discountPrice = $price * (1 - $defaultDiscount / 100);

            return ItemVariant::create([
                'item_id' => $item->id,
                'item_color_id' => $colors[$v['color']]->id ?? null,
                'item_size_id' => $sizes[$v['size']]->id ?? null,
                'item_packaging_type_id' => $packagings[$v['packaging']]->id ?? null,
                'price' => $price,
                'stock' => $v['stock'],
                'owner_id' => $owner->id,
                'discount_percentage' => $defaultDiscount,
                'discount_price' => $discountPrice,
            ]);
        };

        foreach ($items as $index => $item) {
            $variations = $variationsPerItem[$index] ?? null;

            if ($variations) {
                foreach ($variations as $v) {
                    $createVariant($item, $v);
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
