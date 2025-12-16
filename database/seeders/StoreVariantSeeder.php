<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\ItemVariant;
use App\Models\User;      // sellers
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreVariantSeeder extends Seeder
{
    public function run(): void
    {
        $stores = Store::all();
        $now = Carbon::now();

        foreach ($stores as $store) {

            // 1️⃣ Get items that belong to this store
            $itemIds = DB::table('item_store')
                ->where('store_id', $store->id)
                ->where('active', true)
                ->pluck('item_id');

            if ($itemIds->isEmpty()) {
                continue;
            }

            // 2️⃣ Get variants of those items
            $variants = ItemVariant::whereIn('item_id', $itemIds)->get();

            $storeVariantRows = [];
            $sellerPriceRows = [];
            $customerPriceRows = [];

            // Get sellers and customers for this store
            $sellers = User::where('store_id', $store->id)->where('role', 'seller')->get();
            $customers = Customer::where('store_id', $store->id)->get();

            foreach ($variants as $variant) {
                $priceFactor = rand(95, 105) / 100;
                $basePrice = round($variant->price * $priceFactor, 2);

                // Insert store_variant row and get ID immediately
                $storeVariantId = DB::table('store_variant')->insertGetId([
                    'store_id' => $store->id,
                    'item_variant_id' => $variant->id,
                    'price' => $basePrice,
                    'discount_price' => rand(0, 1) ? round($basePrice * (rand(90, 99) / 100), 2) : null,
                    'discount_ends_at' => rand(0, 1) ? $now->copy()->addDays(rand(1, 10)) : null,
                    'active' => rand(0, 100) < 90,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Seller prices
                foreach ($sellers as $seller) {
                    $factor = rand(90, 110) / 100;
                    $sellerPrice = round($basePrice * $factor, 2);

                    DB::table('store_variant_seller_prices')->insert([
                        'store_variant_id' => $storeVariantId,
                        'seller_id' => $seller->id,
                        'price' => $sellerPrice,
                        'discount_price' => rand(0, 1) ? round($sellerPrice * (rand(90, 99) / 100), 2) : null,
                        'discount_ends_at' => rand(0, 1) ? $now->copy()->addDays(rand(1, 10)) : null,
                        'active' => rand(0, 100) < 90,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }

                // Customer prices
                foreach ($customers as $customer) {
                    $factor = rand(85, 105) / 100;
                    $customerPrice = round($basePrice * $factor, 2);

                    DB::table('store_variant_customer_prices')->insert([
                        'store_variant_id' => $storeVariantId,
                        'customer_id' => $customer->id,
                        'price' => $customerPrice,
                        'discount_price' => rand(0, 1) ? round($customerPrice * (rand(90, 99) / 100), 2) : null,
                        'discount_ends_at' => rand(0, 1) ? $now->copy()->addDays(rand(1, 10)) : null,
                        'active' => rand(0, 100) < 90,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }


            if (!empty($storeVariantRows)) {
                DB::table('store_variant')->insert($storeVariantRows);

                // Retrieve the IDs of inserted store_variants to update seller/customer rows
                $insertedStoreVariants = DB::table('store_variant')
                    ->where('store_id', $store->id)
                    ->whereIn('item_variant_id', $variants->pluck('id'))
                    ->get()
                    ->keyBy('item_variant_id');

                $storeVariantId = $insertedStoreVariants[$variant->id]->id;

                // Assign to all seller rows for this variant
                foreach ($sellerPriceRows as &$row) {
                    if (!isset($row['store_variant_id'])) {
                        $row['store_variant_id'] = $storeVariantId;
                    }
                }

                // Assign to all customer rows for this variant
                foreach ($customerPriceRows as &$row) {
                    if (!isset($row['store_variant_id'])) {
                        $row['store_variant_id'] = $storeVariantId;
                    }
                }

                if (!empty($sellerPriceRows)) {
                    DB::table('store_variant_seller_prices')->insert($sellerPriceRows);
                }

                if (!empty($customerPriceRows)) {
                    DB::table('store_variant_customer_prices')->insert($customerPriceRows);
                }
            }
        }
    }
}
