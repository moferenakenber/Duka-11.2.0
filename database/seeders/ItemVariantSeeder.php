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
        $sizeSmall = ItemSize::where('name', 'Small')->first();
        $sizeLarge = ItemSize::where('name', 'Large')->first();
        $boxPackaging = ItemPackagingType::where('name', 'Box')->first();
        $bagPackaging = ItemPackagingType::where('name', 'Bag')->first();

        // Custom variations per item index (0-based)
        $variationsPerItem = [
            [
                ['color' => $colorRed->id, 'size' => $sizeSmall->id, 'packaging' => $bagPackaging->id, 'price' => 950, 'stock' => 15],
                ['color' => $colorBlue->id, 'size' => $sizeLarge->id, 'packaging' => $boxPackaging->id, 'price' => 1450, 'stock' => 8],
            ],
            [
                ['color' => $colorBlack->id, 'size' => $sizeSmall->id, 'packaging' => $boxPackaging->id, 'price' => 1050, 'stock' => 12],
                ['color' => $colorRed->id, 'size' => $sizeLarge->id, 'packaging' => $bagPackaging->id, 'price' => 1100, 'stock' => 6],
            ],
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
                    'item_packaging_type_id' => $boxPackaging->id,
                    'price' => 100,
                    'stock' => 50,
                    'owner_id' => $owner->id,
                ]);

                ItemVariant::create([
                    'item_id' => $item->id,
                    'item_color_id' => $colorBlue->id,
                    'item_size_id' => $sizeLarge->id,
                    'item_packaging_type_id' => $bagPackaging->id,
                    'price' => 200,
                    'stock' => 30,
                    'owner_id' => $owner->id,
                ]);

                ItemVariant::create([
                    'item_id' => $item->id,
                    'item_color_id' => $colorBlack->id,
                    'item_size_id' => $sizeLarge->id,
                    'item_packaging_type_id' => $boxPackaging->id,
                    'price' => 300,
                    'stock' => 20,
                    'owner_id' => $owner->id,
                ]);
            }
        }

    }
}
