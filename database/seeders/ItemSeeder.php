<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Item;
use \App\Models\ItemCategory;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 items using the factory
        //ItemCategory::factory(10)->create(); // Create categories first

        Item::factory()->count(150)->create();
    }
}
