<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\ItemVariant;
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

            $rows = [];

            foreach ($variants as $variant) {

                $priceFactor = rand(95, 105) / 100;
                $price = round($variant->price * $priceFactor, 2);

                $rows[] = [
                    'store_id' => $store->id,
                    'item_variant_id' => $variant->id,
                    'price' => $price,
                    'active' => rand(0, 100) < 90,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($rows)) {
                DB::table('store_variant')->insert($rows);
            }
        }
    }
}
