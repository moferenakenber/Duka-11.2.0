<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ItemVariant;

class ItemImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = \App\Models\ItemVariant::with('item')->get();

        foreach ($variants as $variant) {
            $productName = $variant->item?->product_name ?? 'Unknown_Product';
            $sanitizedProductName = str_replace(' ', '_', $productName);

            $imagePaths = [
                'images/product_images/' . $sanitizedProductName . '_1.jpg',
                'images/product_images/' . $sanitizedProductName . '_2.jpg',
                'images/product_images/' . $sanitizedProductName . '_color_1.jpg',
                'images/product_images/' . $sanitizedProductName . '_color_2.jpg',
            ];

            foreach ($imagePaths as $path) {
                DB::table('item_images')->insert([
                    'item_variant_id' => $variant->id,
                    'image_path' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
