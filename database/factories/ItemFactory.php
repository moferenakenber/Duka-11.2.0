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
    protected static $index = 0;
    public function definition(): array
    {
        $names = [
            'Pen',
            'Pencil',
            'Eraser',
            'Sharpener',
            'Ruler',
            'Notebook',
            'Marker',
            'Highlighter',
            'Sticky Notes',
            'Stapler',
            'Staples',
            'Paper Clips',
            'Binder Clips',
            'Glue Stick',
            'Correction Tape',
            'Scissors',
            'Calculator',
            'Hole Punch',
            'Folder',
            'Envelope',
            'Index Cards',
            'Whiteboard Marker',
            'Permanent Marker',
            'Ballpoint Pen',
            'Gel Pen',
            'Fountain Pen',
            'Colored Pencils',
            'Crayons',
            'Sketchbook',
            'Drawing Pad',
            'Compass',
            'Protractor',
            'Set Square',
            'Binder',
            'Clipboard',
            'Paper Cutter',
            'Rubber Bands',
            'Push Pins',
            'Thumb Tacks',
            'Masking Tape',
            'Duct Tape',
            'Washi Tape',
            'Packing Tape',
            'Label Maker',
            'Labels',
            'Postcards',
            'Greeting Cards',
            'Sticky Flags',
            'Toner Cartridge',
            'Printer Paper',
            'Photo Paper',
            'Graph Paper',
            'Construction Paper',
            'Tracing Paper',
            'Carbon Paper',
            'Chalk',
            'Chalkboard Eraser',
            'Paintbrushes',
            'Palette',
            'Oil Pastels',
            'Watercolors',
            'Acrylic Paint',
            'Sketch Pens',
            'Brush Pens',
            'Stencil',
            'Templates',
            'Diary',
            'Planner',
            'Organizer',
            'Desk Calendar',
            'Wall Calendar',
            'Memo Pad',
            'Clipboard File',
            'Display File',
            'Expanding File',
            'Arch File',
            'Box File',
            'Lever Arch File',
            'Ring Binder',
            'Plastic Folder',
            'Document Wallet',
            'Presentation Folder',
            'Report Cover',
            'Plastic Sleeves',
            'Card Holder',
            'Business Card Holder',
            'ID Card Holder',
            'Lanyard',
            'Badge Clips',
            'Name Tags',
            'Conference Folder',
            'Flip Chart',
            'Easel Stand',
            'Notepad',
            'Legal Pad',
            'Journal',
            'Bullet Journal',
            'Scrapbook',
            'Craft Paper',
            'Origami Paper',
            'Calligraphy Pen',
            'Ink Bottle',
            'Refill Ink',
            'Cartridge Pen',
            'Mechanical Pencil',
            'Lead Refills',
            'Erasable Pen',
            'Whiteboard',
            'Notice Board',
            'Corkboard',
            'Magnetic Board',
            'Desk Organizer',
            'Pen Holder',
            'Paper Tray',
            'File Rack',
            'Magazine Holder',
            'Storage Box',
            'Drawer Organizer',
            'Letter Opener',
            'Paperweight',
            'Bookends',
            'Staple Remover',
            'Tape Dispenser',
            'Adhesive Notes',
            'Glue Gun',
            'Glue Sticks',
            'Permanent Glue',
            'Double-sided Tape',
            'Foam Tape',
            'Velcro Strips',
            'Cable Ties',
            'Binder Rings',
            'Ziplock Bags',
            'Bubble Wrap',
            'Packing Foam',
            'Rubber Cement',
            'Seal Wax',
            'Wax Sticks',
            'Stamp Pad',
            'Ink Pad',
            'Date Stamp',
            'Number Stamp',
            'Embosser',
            'Paper Shredder',
            'Laminating Machine',
            'Laminating Sheets',
            'Binding Machine',
            'Binding Covers',
            'Spiral Binding Coils',
            'Thermal Binding Covers',
            'Clipboards',
            'Exam Pads',
            'Exercise Books',
            'Chart Papers',
            'Canvas Boards',
            'Art Easel',
            'Portfolio Case',
            'Art Knife',
            'Cutting Mat',
            'Ruler Set',
            'Geometry Box',
            'Mathematical Instruments',
            'T-Square',
            'Drafting Paper',
            'Blueprint Paper',
            'Tracing Wheel',
            'Stencil Cutter',
            'Modeling Clay',
            'Craft Knife',
            'Craft Glue',
            'Gift Wrapping Paper',
            'Greeting Cards',
            'Gift Bags',
            'Decorative Ribbons',
            'Twist Ties',
            'Paper Roses',
            'Paper Tassels',
            'Confetti',
            'Party Hats',
            'Birthday Candles',
            'Party Poppers',
            'Table Covers',
            'Paper Cups',
            'Paper Plates',
            'Napkins',
            'Plastic Cutlery',
            'Disposable Cups',
            'Disposable Plates',
            'Plastic Straws',
            'Recyclable Bags',
            'Cardboard Boxes',
            'Storage Bags'
        ];

        $itemNames = [
            'Dispencer big',
            'Dispencer small',
            'Water color',
            'Oil color',
            '9*7',
            'Hard cover',
            'Office pin',
            'Stapler gold',
            'Elastic band',

            'Triangular ruler 30 cm 288',
            'Triangular ruler 30 cm 144',
            'T square 60cm',
            'Set Square ቢጫ ሴትስኬር ማርከር ያለዉ እና የሌለዉ',
            'Ruler 30 cm normal',

            'Flexible 20cm',
            'Crayon normal',
            'Crayon ምሳቃ ከለር በእቃ',
            'Bic Pen Blue ቢክ እስኪብርቶ ሰማያዊ',
            'Bic Pen Black ቢክ እስኪብርቶ ጥቁር',
            'A4 laola',
            'A3 road map',
            'A3 laola',
            'A5 subjact new',

            '3 subjact',
            '4 subject',
            '5 subject',

            'A4 gold on',
            'A5 post',
            'B5-2 ባለማግኔት ጌጥ',
            'A6 ብልጭልጭ',
            'Acleric',

            'Magazin Rack ማጋዚን ራክ የሚገጠም',

            'Price Tag ዋጋ መለጠፊያ',
            'Laminating 76* 106',
            'Cilp file',
            'Diyer small',
            'Fluid normal',
            'Laminating 65*95',

            '3*4 noteit',
            '3*5 noteit',
            '3*3 noteit',
            'Stapler ርካሹ',

            'Fastener',
            'White Board Marker',
            'ክሊፕቦርድ ርካሹ',
            'የውብዳር ከለር',
            'ምሳቃ ከለር piko',
            'Remover',
            'Marker 2 side',
            'ከተር ትንሹ',
            'ቆርቆሮ ኮምፓስ',
            'Agenda አጀንዳ',
            'A4 post',
            'Ruler 50 cm ማስመሪያ 50 cm',
            'ፓንቸር ትንሹ 520',
            'ፓንቸር ትንቁ 520',
            'Transparency Color ትራንስፓረንሲ ከለር',
            'Transparency White ትራንስፓረንሲ ነጭ',
            'Atlas Film አትላስ ፌልም',

            'B5-5 ቀጭን ሳንቲም',
            '2025 -1',
            '2025 ብልጭልጭ.',
            'Diamond pen ዳይመንድ እስኪብርቶ',
            'B5 ባለ ሳንቲም ኖርማል',
            'B5-3 ባለማግኔት ብረት',
            'B5-1 ባለማግኔት ጫፉ ነጭ',
            'A5-5 ባለ ማብኔት ነጭ',
            'A6 ባለ ገመድ',
            'ጥቁር ኮምፓስ',

            'Set Square Yellow ሲትስኬር ቢጫ',
            'Set Square 35 cm ሴትእስኩዊር 35 cm',
            'NoteBook 32k color',
            'A5 - 10 ባለቀለበት',
            'A5 - 12 ባለ ፓኬት',
            '25k- 5 ጨርቅ ማስታወሻ',
            'A5 - 9 ባለ ማግኔት ጌጥ',
            '25k - 1 ፓሪስ',
            'A6- 2 ባለ ገመድ',
            'A6- 1 ባለቁልፍ',
            'A5- 8 ባለሳንቲም ባለእስክርቢቶ',
            'A6- 1 ባለ ገመድ',
            'A5 - ሳንቲም',
            'B5 - ሳንቲም',
            'A6- ቁልፍ የድሮ',
            'Box file Color',
            'Box file Black',
            'Ticket ትኬት',
            'A6- 2 ባለ ገመድ ብልጭልጭ ያለዉ',
            'A6- 3 ባለገመድ',
            'Ruler 30 cm ማስመሪያ 30 cm ጠንካራዉ',
            'A5 ብልጭልጭ 25k - 9',

            'Marshale compass',

            'Fixer 0.7 ፊክሰር 7 ቁጥር',
            'Fixer 0.5 ፊክሰር 5 ቁጥር',
            'እርኬል ማስመሪያ',
            'ጥቁር የስዕል እርሳስ',
            'Lead 0.7 ሊድ 0.7 ቁጥር',
            'Lead 0.5 ሊድ 0.5 ቁጥር',
            'Paint Brush የስዕል ብሩሽ',
            'Pencil Color 2 sided',
            'Yuanyuan Marker',
            'Laminating a3',
            'Rotring Eraser ሮተሪንግ ላጲስ',
            'Coloring Book',
            'Document Case',
            'Erasor Shaped ላጲስ ባለቅርፅ',
            'Coloring book ባለ-ብሪሽ',
            'B5 - 1 ሳንቲም',
            'B5- ባለ ሳንቲም እስክርቢቶ ማስገቢያ ያለዉ',

            'Sharpner መቅረጫ',
            'Poprt',
            'ጥጥ ማስታወሻ',
            'Bj ባለ 300 ብር',
            '6 columns',
            'የስጦታ ማስታወሻ የተሰራ',

            'Ring 6 ሪንግ 6',
            'Ring 8 ሪንግ 8',
            'Ring 10 ረንግ 10',
            'Ring 12 ሪንግ 12',
            'Ring 14 ሪንግ 14',
            'Ring 16 ሪንግ 16',
            'Ring 18 ሪንግ 18',
            'Ring 20 ሪንግ 20',

            'Diary Small ዲያሪ ትንሹ',
            'Diary Code ዲያሪ ኮድ',
            'Diary ዲያሪ ፍሩት',
            'Diary ዲያሪ የተለያየ',

            'Display book 40',
            'Display book 60',
            'Display book 80',
            'Display book 100',

            'Color Bag ክሊር ባግ ርካሹ',
            'NoteBook 32k ጥቁር',
            'Folder with rough texture ሸካራ ፎልደር',
            'A5 -2 ባለ እስክርቢቶ',

            'Pencil Bag ፔንስል ባግ ማይካ ባለ መቅተጫ',
            'Pencil Bag ሸራ ፔንስል ባግ',
            'Pencil Bag ፔንስል ባግ ሻራ ጠንካራዉ',

            'Pencil እርሳስ የስዕል ቁጥሩ የተለያየ',
            'Pencil Vneeds እርሳስ',
            'Pencil Nann እርሳስ',
            'Pencil እርሳስ ባለ እቃ',
            'Pencil Color እርሳስ ከለር አጭሩ',

            'ሽት ትፖቴክተር',
            'Business Card ቢዝነስ ካርድ',
            '335-',
            'A5-11-1 ጠንካራ ከቨር ያለዉ',
            'Puncher Small ፓንቸር ትንሹ',

            '435-',
            'Water Color ዉሃ ከለር ዉዱ ፍጭጭ የሚለዉ',

            'Scissors መካከለኝ መቀስ',
            'Scissor Small ትንሹ መቀስ',
            'Scissor Kids የህፃናት መቀስ',
            'Scissor Big መቀስ ትልቁ ባለክዳን',

            'Folder 7 Pockets ባለ 7 ኪስ ፎልደር',

            'NoteBook B5-2 with pen ማስታወሻ B5-2 ባለ እስክርቢቶ',
            'NoteBook A6 Ribbon ማስታወሻ A6 ገመድ የድሮ',
            'NoteBook A5-11 ማስታወሻ A5- 11 ሄሎ subjact',
            'NoteBook A5-7 Magnet Metal ማስታወሻ A5-7 ብረት ማግኔት',
            'NoteBook A5-6 Magnet Metal ማስታወሻ A5- 6 ጫፉ ነጭ ብረት ማግኔት',
            'NoteBook B5-4 Magnet Metal ማስታወሻ B5-4 ማግኔት ብረት',
            'NoteBook A6 ማስታወሻ A6 ባለ 1 ለእስክርቢቶ',
            'NoteBook A5 ማስታወሻ A5 ባለ new ማግኔት',
            'NoteBook A5 ማስታወሻ A5 ባለ new ገመድ',
            'NoteBook B5 Old ማስታወሻ የድሮ',
            'Notebook A5 ማስታወሻ ባለ ዉሃ',
            'NoteBook A5 Magnet New ማስታወሻ A5 ማግኔት new',
            'NoteBook A5 Paris ማስታወሻ A5 ፓሪስ',
            'NoteBook 25k Leather Expensive ማስታወሻ 25k ሌዘር ዉዱ',
            'NoteBook A5 Metal Magnet ማስታወሻ A5 ብረት ማግኔት',
            'NoteBook A6 Magnet New ማስታወሻ A6 ማግኔት new',
            'NoteBook 60k ማስታወሻ 60k',
            'NoteBook 32k normal ማስታወሻ 32k normal',
            'NoteBook 18k Black ማስታወሻ 18k ጥቁር',
            'NoteBook A6 100 ማስታወሻ A6 100',
            'NoteBook A5-1 ማስታወሻ A5-1 ባለ ማግኔት',
            'NoteBook A4 ማስታወሻ A4 መዝገብ 200',
            'NoteBook ማስታወሻ እንጨት',

            'Sharpner with a Brush ባለ ቡሩሽ መቅረጫ',
            'ሰፈነግ ( የብር መቁጠሪያ)',
            'Magazine Rack መጋዘን ራክ የተበተነ',

            'Paper tray 2 ማይካ',
            'Paper tray 3 ማይካ',
            'Paper tray 3 ብረት 2001',


            'Globe ግሎብ',
            'Marker 1 side',
            'Marker 2 side',
            'Compass 3009 ማይካ',

            'Color Bad 2 pockets ክሊር ባግ ባለ 2 ኪስ',

            'Folder 12 pockets ፎልበር 12 ኪስ',

            'Cutter Small ከተር ትልቁ',
            'Compass ፕላስቲክ 5007',
            'Compass 8010',
            'Compass color b',
            'Compass 8005 ማይካ',
            'Plaster Cutter የእጅ ፕላስተር መቁረጫ ውዱ',
            'A4 posta',

            'ዉሃ ከለር ውዱትልቁ ፕንስል ባግ ሸራ',

            'Eyeye pan',
            'A5 ገመድ new',
            'Dispencer Medium ዲስፔስር መካከለኛ',
            '2 side colore ዉዱ',
            '3*4',

            'Popit',
            'ምሳቃ color ተንጠልጣይ',
            'Clipboard Cheap ርካሹ ክሊፕ ቦርድ',

            'Pan box hello',
            'A4 binding file ዉዱ',
            'Piko ምሳቃ color',

            'Ticket ትኬት',
            'Drawing Book Short የስዕል ደብተር አጭሩ',
            'Drawing Book Long የስዕል ደብተር ረጅሙ',
            'Hand Writing'

        ];

        // Ensure we don't exceed the array bounds
        $productName = $itemNames[self::$index % count($itemNames)];


        $itemCategories = [
            'Stationery',
            'Art Supplies',
            'Office Supplies',
            'Craft Supplies',
            'Gift Wrapping',
            'Party Supplies',
            'School Supplies',
            'Educational Supplies',
            'Packaging Supplies'
        ];



        return [
            // //'name' => $this->faker->word(),
            // 'name' => $this->faker->randomElement($names),
            // 'description' => $this->faker->sentence(),
            // 'catoption' => json_encode($this->faker->words(3)), // Example categories
            // 'pacoption' => json_encode($this->faker->words(3)), // Example packaging options
            // 'price' => $this->faker->randomFloat(2, 10, 500), // Price between 10 and 500
            // 'status' => $this->faker->randomElement(['available', 'unavailable']),
            // 'stock' => $this->faker->numberBetween(0, 1000), // Random integer between 0 and 1000
            // 'images' => json_encode([
            //     '#' // Path to the image on the VPS
            // ]),
            // 'piecesinapacket' => $this->faker->numberBetween(1, 36), // Random integer between 1 and 36
            // 'packetsinacartoon' => $this->faker->numberBetween(1, 12), // Random integer between 1 and 12

            'product_name' => $productName,
            'product_description' => $this->faker->sentence(),
            'packaging_details' => $this->faker->sentence(),
            'variation' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 10, 500), // Price between 10 and 500
            'status' => $this->faker->randomElement(['draft', 'active', 'inactive', 'unavailable']),
            'incomplete' => $this->faker->boolean(),
            //'category_id' => rand(1, 10), // Assuming categories exist
            // 'item_category_id' => rand(1, 10),
            'product_images' => json_encode([
                'https://via.placeholder.com/150',
                'https://via.placeholder.com/200'
            ]), // Example image URLs
            // 'selectedCategories' => json_encode(array_rand(range(1, 10), 3)),
            // 'newCategoryNames' => json_encode([$this->faker->word(), $this->faker->word()]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}



// $table->string('product_name')->nullable();
// $table->text('product_description')->nullable();
// $table->text('packaging_details')->nullable();
// $table->string('variation')->nullable();
// $table->decimal('price', 10, 2)->nullable();
// $table->enum('status', ['draft', 'active', 'inactive', 'unavailable'])->default('draft');
// $table->boolean('incomplete')->default(true);
// $table->unsignedBigInteger('category_id')->nullable();
// $table->unsignedBigInteger('item_category_id')->nullable();
// $table->json('product_images')->nullable();
// $table->json('selectedCategories')->nullable();
// $table->json('newCategoryNames')->nullable();
// $table->timestamps();

// // Foreign Key Constraints
// $table->foreign('category_id')->references('id')->on('item_categories')->onDelete('cascade');
// $table->foreign('item_category_id')->references('id')->on('item_categories')->onDelete('cascade');
