<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemSize;

class ItemSizeSeeder extends Seeder
{
    public function run(): void
    {
       $sizes = [
            '3x3', '4x4', '5x5', '10x10',
            'Small', 'Medium', 'Large', 'Extra Large',
            'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10',
            '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32', '34', '36'
        ];


        foreach ($sizes as $sizeName) {
            ItemSize::firstOrCreate([
                'name' => $sizeName
            ]);
        }
    }
}
