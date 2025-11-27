<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemCategory;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main categories
        $categories = [
            'Notebooks' => [
                'Subject', 'NoteBook 18k', 'NoteBook 25k', 'Agenda',
                'NoteBook 32k', 'NoteBook 60k', 'NoteBook A4', 'NoteBook A5', 'Locally Made'
            ],
            'Writing Tools' => [
                'Bic Pen', 'Diamond pen', 'Pencil', 'Pencil Colored',
                'Erasor', 'Sharpner', 'Marker', 'Highlighter', 'Fluid (Whiteout)'
            ],
            'Files & Folders' => [
                'Box File', 'Folder', 'Cilp file', 'Clipboard', 'Document Case',
                'Display book', 'Binding'
            ],
            'Desk Accessories' => [
                'Stapler', 'Puncher', 'Fastener', 'Elastic band',
                'Paper tray', 'Tape Dispenser', 'Globe', 'Glue'
            ],
            'Measuring Tools' => [
                'Ruler', 'Set Square', 'T square', 'Protractor'
            ],
            'Office Supplies' => [
                'Envelope', 'Sticky Notes', 'Calculator', 'Paper Clips', 'Staples','Scissors'
            ],
            'Art Materials' => [
                'Watercolor', 'Oil Color', 'Paint Brush', 'Canvas', 'Sketch Book'
            ],
            'School Supplies' => [
                'Pen and Pencil', 'Subject', 'Geometry Set', 'Compass', 'Drawing Book'
            ],
            'Kids' => [
                'Crayons', 'Drawing Book', 'Glue Stick', 'Scissors',
                'Pencil Colored', 'Erasor', 'Sharpner'
            ]
        ];

        foreach ($categories as $categoryName => $subcategories) {
            // Create main category
            $main = ItemCategory::create(['category_name' => $categoryName]);

            // Create subcategories
            foreach ($subcategories as $subName) {
                ItemCategory::create([
                    'category_name' => $subName,
                    'parent_id' => $main->id
                ]);
            }
        }
    }
}
