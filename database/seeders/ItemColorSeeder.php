<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemColor;

class ItemColorSeeder extends Seeder
{
    public function run()
    {
        $colors = ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Purple', 'Orange', 'Pink', 'Brown', 'Mixed'];
        foreach ($colors as $colorName) {
            ItemColor::firstOrCreate(['name' => $colorName]);
        }

    }
}
