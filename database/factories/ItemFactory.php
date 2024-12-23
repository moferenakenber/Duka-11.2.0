<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Pen', 'Pencil', 'Eraser', 'Sharpener', 'Ruler', 'Notebook', 'Marker', 'Highlighter',
            'Sticky Notes', 'Stapler', 'Staples', 'Paper Clips', 'Binder Clips', 'Glue Stick',
            'Correction Tape', 'Scissors', 'Calculator', 'Hole Punch', 'Folder', 'Envelope',
            'Index Cards', 'Whiteboard Marker', 'Permanent Marker', 'Ballpoint Pen',
            'Gel Pen', 'Fountain Pen', 'Colored Pencils', 'Crayons', 'Sketchbook',
            'Drawing Pad', 'Compass', 'Protractor', 'Set Square', 'Binder', 'Clipboard',
            'Paper Cutter', 'Rubber Bands', 'Push Pins', 'Thumb Tacks', 'Masking Tape',
            'Duct Tape', 'Washi Tape', 'Packing Tape', 'Label Maker', 'Labels', 'Postcards',
            'Greeting Cards', 'Sticky Flags', 'Toner Cartridge', 'Printer Paper', 'Photo Paper',
            'Graph Paper', 'Construction Paper', 'Tracing Paper', 'Carbon Paper', 'Chalk',
            'Chalkboard Eraser', 'Paintbrushes', 'Palette', 'Oil Pastels', 'Watercolors',
            'Acrylic Paint', 'Sketch Pens', 'Brush Pens', 'Stencil', 'Templates', 'Diary',
            'Planner', 'Organizer', 'Desk Calendar', 'Wall Calendar', 'Memo Pad',
            'Clipboard File', 'Display File', 'Expanding File', 'Arch File', 'Box File',
            'Lever Arch File', 'Ring Binder', 'Plastic Folder', 'Document Wallet',
            'Presentation Folder', 'Report Cover', 'Plastic Sleeves', 'Card Holder',
            'Business Card Holder', 'ID Card Holder', 'Lanyard', 'Badge Clips',
            'Name Tags', 'Conference Folder', 'Flip Chart', 'Easel Stand', 'Notepad',
            'Legal Pad', 'Journal', 'Bullet Journal', 'Scrapbook', 'Craft Paper',
            'Origami Paper', 'Calligraphy Pen', 'Ink Bottle', 'Refill Ink', 'Cartridge Pen',
            'Mechanical Pencil', 'Lead Refills', 'Erasable Pen', 'Whiteboard', 'Notice Board',
            'Corkboard', 'Magnetic Board', 'Desk Organizer', 'Pen Holder', 'Paper Tray',
            'File Rack', 'Magazine Holder', 'Storage Box', 'Drawer Organizer', 'Letter Opener',
            'Paperweight', 'Bookends', 'Staple Remover', 'Tape Dispenser', 'Adhesive Notes',
            'Glue Gun', 'Glue Sticks', 'Permanent Glue', 'Double-sided Tape', 'Foam Tape',
            'Velcro Strips', 'Cable Ties', 'Binder Rings', 'Ziplock Bags', 'Bubble Wrap',
            'Packing Foam', 'Rubber Cement', 'Seal Wax', 'Wax Sticks', 'Stamp Pad',
            'Ink Pad', 'Date Stamp', 'Number Stamp', 'Embosser', 'Paper Shredder',
            'Laminating Machine', 'Laminating Sheets', 'Binding Machine', 'Binding Covers',
            'Spiral Binding Coils', 'Thermal Binding Covers', 'Clipboards', 'Exam Pads',
            'Exercise Books', 'Chart Papers', 'Canvas Boards', 'Art Easel', 'Portfolio Case',
            'Art Knife', 'Cutting Mat', 'Ruler Set', 'Geometry Box', 'Mathematical Instruments',
            'T-Square', 'Drafting Paper', 'Blueprint Paper', 'Tracing Wheel',
            'Stencil Cutter', 'Modeling Clay', 'Craft Knife', 'Craft Glue', 'Gift Wrapping Paper',
            'Greeting Cards', 'Gift Bags', 'Decorative Ribbons', 'Twist Ties', 'Paper Roses',
            'Paper Tassels', 'Confetti', 'Party Hats', 'Birthday Candles', 'Party Poppers',
            'Table Covers', 'Paper Cups', 'Paper Plates', 'Napkins', 'Plastic Cutlery',
            'Disposable Cups', 'Disposable Plates', 'Plastic Straws', 'Recyclable Bags',
            'Cardboard Boxes', 'Storage Bags'
        ];

        return [
            //'name' => $this->faker->word(),
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->sentence(),
            'catoption' => json_encode($this->faker->words(3)), // Example categories
            'pacoption' => json_encode($this->faker->words(3)), // Example packaging options
            'price' => $this->faker->randomFloat(2, 10, 500), // Price between 10 and 500
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'stock' => $this->faker->numberBetween(0, 1000), // Random integer between 0 and 1000
            'images' => json_encode([
                '#' // Path to the image on the VPS
            ]),
            'piecesinapacket' => $this->faker->numberBetween(1, 36), // Random integer between 1 and 36
            'packetsinacartoon' => $this->faker->numberBetween(1, 12), // Random integer between 1 and 12
        ];
    }
}
