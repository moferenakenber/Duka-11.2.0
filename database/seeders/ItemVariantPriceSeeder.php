<?php

namespace Database\Seeders;

use App\Models\ItemVariant;
use App\Models\User;
use App\Models\ItemVariantPrice;
use Illuminate\Database\Seeder;

class ItemVariantPriceSeeder extends Seeder
{
    public function run(): void
    {
        $variants = ItemVariant::take(5)->get(); // limit to 5 for sample
        $users = User::take(3)->get(); // sample users

        foreach ($variants as $variant) {
            // Base price (default)
            ItemVariantPrice::create([
                'item_variant_id' => $variant->id,
                'price' => rand(100, 1000) / 10, // e.g., 10.0 to 100.0
            ]);

            // Role-based price
            foreach (['seller', 'visitor', 'admin'] as $role) {
                ItemVariantPrice::create([
                    'item_variant_id' => $variant->id,
                    'applies_to_role' => $role,
                    'price' => rand(100, 1000) / 10,
                ]);
            }

            // User-specific price
            foreach ($users as $user) {
                ItemVariantPrice::create([
                    'item_variant_id' => $variant->id,
                    'user_id' => $user->id,
                    'price' => rand(100, 1000) / 10,
                ]);
            }
        }
    }
}
