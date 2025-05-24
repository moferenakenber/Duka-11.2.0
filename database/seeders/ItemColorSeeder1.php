<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Item;
use \App\Models\ItemColor;
use Illuminate\Support\Str;

class ItemColorSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $colors = [
        //     ['name' => 'BONE', 'disabled' => false],
        //     ['name' => 'WHITE', 'disabled' => false],
        //     ['name' => 'BLACK', 'disabled' => false],
        //     ['name' => 'PURPLE', 'disabled' => false],
        //     ['name' => 'BUTTER CORN', 'disabled' => true],
        //     ['name' => 'QUARTZ', 'disabled' => false],
        // ];

        $itemColorMap1 = [
            'Dispencer big' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
                ['name' => 'Black', 'disabled' => false],
            ],
            'Dispencer small' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Water color' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Oil color' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '9*7' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Hard cover' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Office pin' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Stapler gold' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Elastic band' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Triangular ruler 30 cm 288' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Triangular ruler 30 cm 144' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'T square 60cm' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Ruler 30 cm normal' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Crayon normal' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Bic Pen Blue ቢክ እስኪብርቶ ሰማያዊ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Bic Pen Black ቢክ እስኪብርቶ ጥቁር' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '3 subject' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '4 subject' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '5 subject' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '3*3 noteit' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '3*4 noteit' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            '3*5 noteit' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Set Square ቢጫ ሴትስኬር ማርከር ያለዉ እና የሌለዉ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Flexible 20cm' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Crayon ምሳቃ ከለር በእቃ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A4 laola' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A3 road map' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A3 laola' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A5 subject new' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A4 gold on' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A5 post' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'B5-2 ባለማግኔት ጌጥ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A6 ብልጭልጭ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Acleric' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Magazin Rack ማጋዚን ራክ የሚገጠም' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Price Tag ዋጋ መለጠፊያ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Laminating 76* 106' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Cilp file' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Diyer small' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Fluid normal' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Laminating 65*95' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Stapler ርካሹ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Fastener' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'White Board Marker' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'ክሊፕቦርድ ርካሹ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'የውብዳር ከለር' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'ምሳቃ ከለር piko' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Remover' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'ከተር ትንሹ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'ቆርቆሮ ኮምፓስ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Agenda አጀንዳ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'A4 post' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'WHITE', 'disabled' => false],
            ],
            'Ruler 50 cm ማስመሪያ 50 cm' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'ፓንቸር ትንሹ 520' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'ፓንቸር ትንቁ 520' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Transparency Color ትራንስፓረንሲ ከለር' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Gold', 'disabled' => false],
            ],

            'Transparency White ትራንስፓረንሲ ነጭ' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'Atlas Film አትላስ ፌልም' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],
            'B5-5 ቀጭን ሳንቲም' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            '2025 -1' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            '2025 ብልጭልጭ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'Diamond pen ዳይመንድ እስኪብርቶ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'B5 ባለ ሳንቲም ኖርማል' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'B5-3 ባለማግኔት ብረት' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'B5-1 ባለማግኔት ጫፉ ነጭ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'A5-5 ባለ ማብኔት ነጭ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],
            'A6 ባለ ገመድ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],



            'ጥቁር ኮምፓስ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],

            'Set Square Yellow ሲትስኬር ቢጫ' => [
                ['name' => 'Yellow', 'disabled' => false],
                ['name' => 'Red', 'disabled' => false],
            ],

            'Set Square 35 cm ሴትእስኩዊር 35 cm' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'NoteBook 32k color' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'A5 - 10 ባለቀለበት' => [
                ['name' => 'Yellow', 'disabled' => false],
                ['name' => 'White', 'disabled' => false],
            ],

            'A5 - 12 ባለ ፓኬት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Red', 'disabled' => false],
            ],

            '25k- 5 ጨርቅ ማስታወሻ' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'A5 - 9 ባለ ማግኔት ጌጥ' => [
                ['name' => 'Pink', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            '25k - 1 ፓሪስ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'A6- 2 ባለ ገመድ' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Black', 'disabled' => false],
            ],

            'A6- 1 ባለቁልፍ' => [
                ['name' => 'Brown', 'disabled' => false],
                ['name' => 'Black', 'disabled' => false],
            ],

            'A5- 8 ባለ ሳንቲም ባለእስክርቢቶ' => [
                ['name' => 'Yellow', 'disabled' => false],
                ['name' => 'Red', 'disabled' => false],
            ],

            'A6- 1 ባለ ገመድ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'A5 - ሳንቲም' => [
                ['name' => 'Blue', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'B5 - ሳንቲም' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'White', 'disabled' => false],
            ],

            'A6- ቁልፍ የድሮ' => [
                ['name' => 'Brown', 'disabled' => false],
                ['name' => 'Black', 'disabled' => false],
            ],

            'Box file Color' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Box file Black' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Gray', 'disabled' => false],
            ],

            'A6- 2 ባለ ገመድ ብልጭልጭ ያለዉ' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'A6- 3 ባለገመድ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Ruler 30 cm ማስመሪያ 30 cm ጠንካራዉ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'A5 ብልጭልጭ 25k - 9' => [
                ['name' => 'Yellow', 'disabled' => false],
                ['name' => 'Pink', 'disabled' => false],
            ],

            'Marshale compass' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],

            'Fixer 0.7 ፊክሰር 7 ቁጥር' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Fixer 0.5 ፊክሰር 5 ቁጥር' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Silver', 'disabled' => false],
            ],

            'እርኬል ማስመሪያ' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'ጥቁር የስዕል እርሳስ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Gray', 'disabled' => false],
            ],

            'Lead 0.7 ሊድ 0.7 ቁጥር' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Lead 0.5 ሊድ 0.5 ቁጥር' => [
                ['name' => 'Gray', 'disabled' => false],
                ['name' => 'Red', 'disabled' => false],
            ],

            'Paint Brush የስዕል ብሩሽ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Pencil Color 2 sided' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Yuanyuan Marker' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Laminating A3' => [
                ['name' => 'Blue', 'disabled' => false],
                ['name' => 'White', 'disabled' => false],
            ],

            'Rotring Eraser ሮተሪንግ ላጲስ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'Coloring Book' => [
                ['name' => 'Pink', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Document Case' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Black', 'disabled' => false],
            ],

            'Eraser Shaped ላጲስ ባለቅርፅ' => [
                ['name' => 'Blue', 'disabled' => false],
                ['name' => 'Green', 'disabled' => false],
            ],

            'Coloring book ባለ-ብሪሽ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'B5 - 1 ሳንቲም' => [
                ['name' => 'White', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            'B5- ባለ ሳንቲም እስክርቢቶ ማስገቢያ ያለዉ' => [
                ['name' => 'Black', 'disabled' => false],
                ['name' => 'White', 'disabled' => false],
            ],

            'Sharpener መቅረጫ' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'ጥጥ ማስታወሻ' => [
                ['name' => 'Blue', 'disabled' => false],
                ['name' => 'Red', 'disabled' => false],
            ],

            'Bj ባለ 300 ብር' => [
                ['name' => 'Red', 'disabled' => false],
                ['name' => 'Blue', 'disabled' => false],
            ],

            '6 columns' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'የስጦታ ማስታወሻ የተሰራ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Ring 6 ሪንግ 6' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 8 ሪንግ 8' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 10 ሪንግ 10' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 12 ሪንግ 12' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 14 ሪንግ 14' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 16 ሪንግ 16' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 18 ሪንግ 18' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ring 20 ሪንግ 20' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Diary Small ዲያሪ ትንሹ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Diary Code ዲያሪ ኮድ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Diary ዲያሪ ፍሩት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Diary ዲያሪ የተለያየ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Display book 40' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Display book 60' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Display book 80' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Display book 100' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Color Bag ክሊር ባግ ርካሹ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],


            'NoteBook 32k ጥቁር' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Folder with rough texture ሸካራ ፎልደር' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'A5 -2 ባለ እስክርቢቶ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Pencil Bag ፔንስል ባግ ማይካ ባለ መቅተጫ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Pencil Bag ሸራ ፔንስል ባግ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Pencil Bag ፔንስል ባግ ሻራ ጠንካራዉ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],

            'Pencil እርሳስ የስዕል ቁጥሩ የተለያየ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Pencil Vneeds እርሳስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Pencil Nann እርሳስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Pencil እርሳስ ባለ እቃ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Pencil Color እርሳስ ከለር አጭሩ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'ሽት ትፖቴክተር' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Business Card ቢዝነስ ካርድ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            '335-' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'A5-11-1 ጠንካራ ከቨር ያለዉ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Puncher Small ፓንቸር ትንሹ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            '435-' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Water Color ዉሃ ከለር ዉዱ ፍጭጭ የሚለዉ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Scissors መካከለኝ መቀስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Scissor Small ትንሹ መቀስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Scissor Kids የህፃናት መቀስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Scissor Big መቀስ ትልቁ ባለክዳን' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Folder 7 Pockets ባለ 7 ኪስ ፎልደር' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook B5-2 with pen ማስታወሻ B5-2 ባለ እስክርቢቶ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A6 Ribbon ማስታወሻ A6 ገመድ የድሮ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5-11 ማስታወሻ A5- 11 ሄሎ subject' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5-7 Magnet Metal ማስታወሻ A5-7 ብረት ማግኔት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5-6 Magnet Metal ማስታወሻ A5- 6 ጫፉ ነጭ ብረት ማግኔት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook B5-4 Magnet Metal ማስታወሻ B5-4 ማግኔት ብረት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A6 ማስታወሻ A6 ባለ 1 ለእስክርቢቶ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5 ማስታወሻ A5 ባለ new ማግኔት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5 ማስታወሻ A5 ባለ new ገመድ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook B5 Old ማስታወሻ የድሮ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Notebook A5 ማስታወሻ ባለ ዉሃ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5 Magnet New ማስታወሻ A5 ማግኔት new' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5 Paris ማስታወሻ A5 ፓሪስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook 25k Leather Expensive ማስታወሻ 25k ሌዘር ዉዱ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5 Metal Magnet ማስታወሻ A5 ብረት ማግኔት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A6 Magnet New ማስታወሻ A6 ማግኔት new' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook 60k ማስታወሻ 60k' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook 32k normal ማስታወሻ 32k normal' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook 18k Black ማስታወሻ 18k ጥቁር' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A6 100 ማስታወሻ A6 100' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A5-1 ማስታወሻ A5-1 ባለ ማግኔት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook A4 ማስታወሻ A4 መዝገብ 200' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'NoteBook ማስታወሻ እንጨት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Sharpner with a Brush ባለ ቡሩሽ መቅረጫ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'ሰፈነግ (የብር መቁጠሪያ)' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Magazine Rack መጋዘን ራክ የተበተነ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Paper tray 2 ማይካ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Paper tray 3 ማይካ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Paper tray 3 ብረት 2001' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Globe ግሎብ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Marker 1 side' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Marker 2 side' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Compass 3009 ማይካ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Color Bad 2 pockets ክሊር ባግ ባለ 2 ኪስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Folder 12 pockets ፎልበር 12 ኪስ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Cutter Small ከተር ትልቁ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Compass ፕላስቲክ 5007' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Compass 8010' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Compass color b' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Compass 8005 ማይካ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Plaster Cutter የእጅ ፕላስተር መቁረጫ ውዱ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'A4 posta' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'ዉሃ ከለር ውዱትልቁ ፕንስል ባግ ሸራ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Eyeye pan' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'A5 ገመድ new' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Dispencer Medium ዲስፔስር መካከለኛ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            '2 side colore ዉዱ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            '3*4' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Popit' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'ምሳቃ color ተንጠልጣይ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Clipboard Cheap ርካሹ ክሊፕ ቦርድ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Pan box hello' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'A4 binding file ዉዱ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Piko ምሳቃ color' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Ticket ትኬት' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Drawing Book Short የስዕል ደብተር አጭሩ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Drawing Book Long የስዕል ደብተር ረጅሙ' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
            'Hand Writing' => [
                ['name' => 'Green', 'disabled' => false],
                ['name' => 'Yellow', 'disabled' => false],
            ],
        ];












        $itemColorMap = [
            "2 side color ውዱ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "2025 -1" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "2025 ብልጭልጭ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "25k - 1 ፓሪስ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "25k- 5 ጨርቅ ማስታወሻ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "3 subject" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
                ["name" => "BLACK", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "3*3 noteit" => [
                ["name" => "YELLOW", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "3*4" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "3*4 noteit" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "3*5 noteit" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "335-" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "4 subject" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "435-" => [
                ["name" => "BLACK", "disabled" => false],
            ],

            "5 subject" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "6 columns" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "9*7" => [
                ["name" => "BLUE", "disabled" => false],
            ],

            "A3 laola" => [
                ["name" => "BLUE", "disabled" => false],
            ],

            "A3 road map" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A4 binding file ዉዱ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A4 gold on" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A4 laola" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A4 post" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A4 posta" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5 - 10 ባለቀለበት" => [
                ["name" => "White", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5 - 12 ባለ ፓኬት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "A5 - 9 ባለ ማግኔት ጌጥ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Pink", "disabled" => false],
            ],

            "A5 - ሳንቲም" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5 -2 ባለ እስክርቢቶ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5 post" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A5 subject new" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A5 ብልጭልጭ 25k - 9" => [
                ["name" => "Pink", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5 ገመድ new" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5- 8 ባለ ሳንቲም ባለእስክርቢቶ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5-11-1 ጠንካራ ከቨር ያለዉ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A5-5 ባለ ማብኔት ነጭ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "A6 ባለ ገመድ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "A6 ብልጭልጭ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "A6- 1 ባለ ገመድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "A6- 1 ባለቁልፍ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Brown", "disabled" => false],
            ],

            "A6- 2 ባለ ገመድ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "A6- 2 ባለ ገመድ ብልጭልጭ ያለዉ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "A6- 3 ባለገመድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "A6- ቁልፍ የድሮ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Brown", "disabled" => false],
            ],

            "Acleric" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Agenda አጀንዳ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Atlas Film አትላስ ፌልም" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Green", "disabled" => false],
            ],

            "B5 - 1 ሳንቲም" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "B5 - ሳንቲም" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "B5 ባለ ሳንቲም ኖርማል" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "B5- ባለ ሳንቲም እስክርቢቶ ማስገቢያ ያለዉ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "B5-1 ባለማግኔት ጫፉ ነጭ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "B5-2 ባለማግኔት ጌጥ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "B5-3 ባለማግኔት ብረት" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "B5-5 ቀጭን ሳንቲም" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "Bic Pen Black ቢክ እስኪብርቶ ጥቁር" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Bic Pen Blue ቢክ እስኪብርቶ ሰማያዊ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Bj ባለ 300 ብር" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Box file Black" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Gray", "disabled" => false],
            ],

            "Box file Color" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Business Card ቢዝነስ ካርድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Cilp file" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Clipboard Cheap ርካሹ ክሊፕ ቦርድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Color Bad 2 pockets ክሊር ባግ ባለ 2 ኪስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Color Bag ክሊር ባግ ርካሹ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Coloring Book" => [
                ["name" => "Pink", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Coloring book ባለ-ብሪሽ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Compass 3009 ማይካ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Compass 8005 ማይካ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Compass 8010" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Compass color b" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Compass ፕላስቲክ 5007" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Crayon normal" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Crayon ምሳቃ ከለር በእቃ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Cutter Small ከተር ትልቁ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Diamond pen ዳይመንድ እስኪብርቶ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "Diary Code ዲያሪ ኮድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Diary Small ዲያሪ ትንሹ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Diary ዲያሪ የተለያየ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Diary ዲያሪ ፍሩት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Dispencer Medium ዲስፔስር መካከለኛ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Dispencer big" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Dispencer small" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Display book 100" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Display book 40" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Display book 60" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Display book 80" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Diyer small" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Document Case" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Green", "disabled" => false],
            ],

            "Drawing Book Long የስዕል ደብተር ረጅሙ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Drawing Book Short የስዕል ደብተር አጭሩ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Elastic band" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Eraser Shaped ላጲስ ባለቅርፅ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Green", "disabled" => false],
            ],

            "Eyeye pan" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Fastener" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Fixer 0.5 ፊክሰር 5 ቁጥር" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "Fixer 0.7 ፊክሰር 7 ቁጥር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Flexible 20cm" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Fluid normal" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Folder 12 pockets ፎልበር 12 ኪስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Folder 7 Pockets ባለ 7 ኪስ ፎልደር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Folder with rough texture ሸካራ ፎልደር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Globe ግሎብ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Hand Writing" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Hard cover" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Laminating 65*95" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Laminating 76* 106" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Laminating A3" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "Lead 0.5 ሊድ 0.5 ቁጥር" => [
                ["name" => "Gray", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Lead 0.7 ሊድ 0.7 ቁጥር" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Magazin Rack ማጋዚን ራክ የሚገጠም" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Magazine Rack መጋዘን ራክ የተበተነ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Marker 1 side" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Marker 2 side" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Marshale compass" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "NoteBook 18k Black ማስታወሻ 18k ጥቁር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook 25k Leather Expensive ማስታወሻ 25k ሌዘር ዉዱ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook 32k color" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "NoteBook 32k normal ማስታወሻ 32k normal" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook 32k ጥቁር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook 60k ማስታወሻ 60k" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A4 ማስታወሻ A4 መዝገብ 200" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5 Magnet New ማስታወሻ A5 ማግኔት new" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5 Metal Magnet ማስታወሻ A5 ብረት ማግኔት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5 Paris ማስታወሻ A5 ፓሪስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5 ማስታወሻ A5 ባለ new ማግኔት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5 ማስታወሻ A5 ባለ new ገመድ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5-1 ማስታወሻ A5-1 ባለ ማግኔት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5-11 ማስታወሻ A5- 11 ሄሎ subject" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5-6 Magnet Metal ማስታወሻ A5- 6 ጫፉ ነጭ ብረት ማግኔት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A5-7 Magnet Metal ማስታወሻ A5-7 ብረት ማግኔት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A6 100 ማስታወሻ A6 100" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A6 Magnet New ማስታወሻ A6 ማግኔት new" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A6 Ribbon ማስታወሻ A6 ገመድ የድሮ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook A6 ማስታወሻ A6 ባለ 1 ለእስክርቢቶ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook B5 Old ማስታወሻ የድሮ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook B5-2 with pen ማስታወሻ B5-2 ባለ እስክርቢቶ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook B5-4 Magnet Metal ማስታወሻ B5-4 ማግኔት ብረት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "NoteBook ማስታወሻ እንጨት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Notebook A5 ማስታወሻ ባለ ዉሃ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Office pin" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Oil color" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Paint Brush የስዕል ብሩሽ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pan box hello" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Paper tray 2 ማይካ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Paper tray 3 ማይካ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Paper tray 3 ብረት 2001" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Bag ሸራ ፔንስል ባግ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Bag ፔንስል ባግ ማይካ ባለ መቅተጫ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Bag ፔንስል ባግ ሻራ ጠንካራዉ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Color 2 sided" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Pencil Color እርሳስ ከለር አጭሩ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Nann እርሳስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil Vneeds እርሳስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil እርሳስ ባለ እቃ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Pencil እርሳስ የስዕል ቁጥሩ የተለያየ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Piko ምሳቃ color" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Plaster Cutter የእጅ ፕላስተር መቁረጫ ውዱ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Popit" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Price Tag ዋጋ መለጠፊያ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Puncher Small ፓንቸር ትንሹ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Remover" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Ring 10 ሪንግ 10" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 12 ሪንግ 12" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 14 ሪንግ 14" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 16 ሪንግ 16" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 18 ሪንግ 18" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 20 ሪንግ 20" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 6 ሪንግ 6" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Ring 8 ሪንግ 8" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Rotring Eraser ሮተሪንግ ላጲስ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Ruler 30 cm normal" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Ruler 30 cm ማስመሪያ 30 cm ጠንካራዉ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Ruler 50 cm ማስመሪያ 50 cm" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "Scissor Big መቀስ ትልቁ ባለክዳን" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Scissor Kids የህፃናት መቀስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Scissor Small ትንሹ መቀስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Scissors መካከለኝ መቀስ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Set Square 35 cm ሴትእስኩዊር 35 cm" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Green", "disabled" => false],
            ],

            "Set Square Yellow ሲትስኬር ቢጫ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Set Square ቢጫ ሴትስኬር ማርከር ያለዉ እና የሌለዉ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Sharpener መቅረጫ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Sharpner with a Brush ባለ ቡሩሽ መቅረጫ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Stapler gold" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Stapler ርካሹ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "T square 60cm" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Ticket ትኬት" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Transparency Color ትራንስፓረንሲ ከለር" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Gold", "disabled" => false],
            ],

            "Transparency White ትራንስፓረንሲ ነጭ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "White", "disabled" => false],
            ],

            "Triangular ruler 30 cm 144" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Triangular ruler 30 cm 288" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Water Color ዉሃ ከለር ዉዱ ፍጭጭ የሚለዉ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "Water color" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "White Board Marker" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "Yuanyuan Marker" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ምሳቃ color ተንጠልጣይ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ምሳቃ ከለር piko" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "ሰፈነግ (የብር መቁጠሪያ)" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ሽት ትፖቴክተር" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ቆርቆሮ ኮምፓስ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "እርኬል ማስመሪያ" => [
                ["name" => "White", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ከተር ትንሹ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "ክሊፕቦርድ ርካሹ" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "ዉሃ ከለር ውዱትልቁ ፕንስል ባግ ሸራ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "የስጦታ ማስታወሻ የተሰራ" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "የውብዳር ከለር" => [
                ["name" => "Red", "disabled" => false],
                ["name" => "WHITE", "disabled" => false],
            ],

            "ጥቁር ኮምፓስ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Silver", "disabled" => false],
            ],

            "ጥቁር የስዕል እርሳስ" => [
                ["name" => "Black", "disabled" => false],
                ["name" => "Gray", "disabled" => false],
            ],

            "ጥጥ ማስታወሻ" => [
                ["name" => "Blue", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],

            "ፓንቸር ትንሹ 520" => [
                ["name" => "White", "disabled" => false],
                ["name" => "Yellow", "disabled" => false],
            ],

            "ፓንቸር ትንቁ 520" => [
                ["name" => "Green", "disabled" => false],
                ["name" => "Red", "disabled" => false],
            ],
        ];











        $items = Item::all();

        //

        foreach ($items as $item) {
            // $productSlug = Str::slug($item->product_name); // Make a URL-friendly slug
            $productSlug = str_replace(' ', '_', $item->product_name); // Match your filename convention


            $colorImage1Path = 'images/product_images/' . $productSlug . '_color_1.jpg';
            $colorImage2Path = 'images/product_images/' . $productSlug . '_color_2.jpg';
            $colorImage3Path = 'images/product_images/' . $productSlug . '_color_3.jpg';

            $colorImages = [
                $colorImage1Path,
                $colorImage2Path,
                $colorImage3Path,
            ];

            // Add default images if needed
            while (count($colorImages) < count($itemColorMap)) {
                $colorImages[] = $colorImages[0]; // or some default path
            }

            if (!isset($itemColorMap[$item->product_name])) {
                continue; // skip if no color mapping defined
            }

            $colors = $itemColorMap[$item->product_name];

            foreach ($colors as $index => $color) {
                $imageIndex = $index;
                ItemColor::create([
                    'item_id' => $item->id,
                    'name' => $color['name'],
                    // 'image_path' => //$colorImages[$imageIndex], // relative path here!
                    //                 asset($color['image_path']),
                    'image_path' => $colorImages[$imageIndex], // ← this is correct
                    'disabled' => $color['disabled'],
                ]);
            }
        }
    }

}
