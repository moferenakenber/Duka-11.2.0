<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemStoreSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $stores = Store::all();
        $items = Item::all();

        foreach ($stores as $store) {
            foreach ($items as $item) {
                DB::table('item_store')->updateOrInsert(
                    [
                        'store_id' => $store->id,
                        'item_id' => $item->id,
                    ],
                    [
                        'active' => true,        // all items active
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}
