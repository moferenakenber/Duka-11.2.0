<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemCategoryItemSeeder extends Seeder
{
    public function run(): void
    {
        // Create default categories
        $categoryNames = ['Stationery', 'Office Supplies', 'Art Materials', 'School Supplies', 'Writing Tools', 'Notebooks'];

        foreach ($categoryNames as $name) {
            ItemCategory::firstOrCreate(['category_name' => $name]);
        }

        // Get all items and categories
        $items = Item::all();
        $categories = ItemCategory::all();

        if ($items->isEmpty() || $categories->isEmpty()) {
            $this->command->info('No items or item categories found to seed pivot table.');
            return;
        }

        // Link each item to 1–2 random categories
        foreach ($items as $item) {
            $item->categories()->sync(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            );
        }

        $this->command->info('Items linked to categories successfully.');
    }
}
