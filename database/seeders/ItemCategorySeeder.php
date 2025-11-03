<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemCategory;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Pen', 'Pencil', 'Office Supplies', 'Art Materials', 'School Supplies', 'Writing Tools', 'Notebooks'];

        foreach ($categories as $name) {
            ItemCategory::create(['category_name' => $name]);
        }
    }
}
