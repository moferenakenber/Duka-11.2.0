<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemVariant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the store ID you want to seed data for
        // Make sure this store exists in your database
        $storeId = 1;

        // Get all variant IDs
        $variantIds = ItemVariant::pluck('id');

        $storeVariants = [];
        $currentDate = Carbon::now();

        foreach ($variantIds as $variantId) {
            // Randomly determine if the variant is active for this store
            $isActive = rand(0, 100) < 95; // 95% chance active

            // Randomly determine if the variant has a discount
            $hasDiscount = rand(0, 100) < 30; // 30% chance discount

            // Base price of the variant
            $originalPrice = ItemVariant::find($variantId)->price;

            // Slightly adjust price for the store
            $priceFactor = rand(95, 105) / 100; // 95% - 105% of base
            $storePrice = round($originalPrice * $priceFactor, 2);

            $discountPrice = null;
            $discountEndsAt = null;

            if ($hasDiscount) {
                $discountFactor = rand(70, 90) / 100; // 70% - 90% of store price
                $discountPrice = round($storePrice * $discountFactor, 2);

                $discountDays = rand(1, 30); // Discount lasts 1-30 days
                $discountEndsAt = $currentDate->copy()->addDays($discountDays);
            }

            $storeVariants[] = [
                'store_id' => $storeId,
                'item_variant_id' => $variantId,
                'price' => $storePrice,
                'discount_price' => $discountPrice,
                'discount_ends_at' => $discountEndsAt,
                'active' => $isActive,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ];
        }

        // Bulk insert for performance
        DB::table('store_variant')->insert($storeVariants);
    }
}
