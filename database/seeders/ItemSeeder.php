<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Item;
use \App\Models\ItemCategory;
use \App\Models\ItemColor;
use \App\Models\ItemVariant;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 items using the factory
        //ItemCategory::factory(10)->create(); // Create categories first

        //Item::factory()->count(150)->create();

        $productNames = [
            '2 side color ውዱ',
            '2025 -1',
            '2025 ብልጭልጭ',
            '25k - 1 ፓሪስ',
            '25k- 5 ጨርቅ ማስታወሻ',
            '3 subject',
            '3*3 noteit',
            '3*4 noteit',
            '3*4',
            '3*5 noteit',
            '335-',
            '4 subject',
            '435-',
            '5 subject',
            '6 columns',
            '9*7',
            'A3 laola',
            'A3 road map',
            'A4 binding file ዉዱ',
            'A4 gold on',
            'A4 laola',
            'A4 post',
            'A4 posta',
            'A5 - 10 ባለቀለበት',
            'A5 - 12 ባለ ፓኬት',
            'A5 - 9 ባለ ማግኔት ጌጥ',
            'A5 - ሳንቲም',
            'A5 -2 ባለ እስክርቢቶ',
            'A5 post',
            'A5 subject new',
            'A5 ብልጭልጭ 25k - 9',
            'A5 ገመድ new',
            'A5- 8 ባለሳንቲም ባለእስክርቢቶ',
            'A5-11-1 ጠንካራ ከቨር ያለዉ',
            'A5-5 ባለ ማብኔት ነጭ',
            'A6 ባለ ገመድ',
            'A6 ብልጭልጭ',
            'A6- 1 ባለ ገመድ',
            'A6- 1 ባለቁልፍ',
            'A6- 2 ባለ ገመድ ብልጭልጭ ያለዉ',
            'A6- 2 ባለ ገመድ',
            'A6- 3 ባለገመድ',
            'A6- ቁልፍ የድሮ',
            'Acleric',
            'Agenda አጀንዳ',
            'Atlas Film አትላስ ፌልም',
            'B5 - 1 ሳንቲም',
            'B5 - ሳንቲም',
            'B5 ባለ ሳንቲም ኖርማል',
            'B5- ባለ ሳንቲም እስክርቢቶ ማስገቢያ ያለዉ',
            'B5-1 ባለማግኔት ጫፉ ነጭ',
            'B5-2 ባለማግኔት ጌጥ',
            'B5-3 ባለማግኔት ብረት',
            'B5-5 ቀጭን ሳንቲም',
            'Bic Pen Black ቢክ እስኪብርቶ ጥቁር',
            'Bic Pen Blue ቢክ እስኪብርቶ ሰማያዊ',
            'Bj ባለ 300 ብር',
            'Box file Black',
            'Box file Color',
            'Business Card ቢዝነስ ካርድ',
            'Cilp file',
            'Clipboard Cheap ርካሹ ክሊፕ ቦርድ',
            'Color Bad 2 pockets ክሊር ባግ ባለ 2 ኪስ',
            'Color Bag ክሊር ባግ ርካሹ',
            'Coloring book ባለ-ብሪሽ',
            'Coloring Book',
            'Compass 3009 ማይካ',
            'Compass 8005 ማይካ',
            'Compass 8010',
            'Compass color b',
            'Compass ፕላስቲክ 5007',
            'Crayon normal',
            'Crayon ምሳቃ ከለር በእቃ',
            'Cutter Small ከተር ትልቁ',
            'Diamond pen ዳይመንድ እስኪብርቶ',
            'Diary Code ዲያሪ ኮድ',
            'Diary Small ዲያሪ ትንሹ',
            'Diary ዲያሪ የተለያየ',
            'Diary ዲያሪ ፍሩት',
            'Dispencer big',
            'Dispencer Medium ዲስፔስር መካከለኛ',
            'Dispencer small',
            'Display book 100',
            'Display book 40',
            'Display book 60',
            'Display book 80',
            'Diyer small',
            'Document Case',
            'Drawing Book Long የስዕል ደብተር ረጅሙ',
            'Drawing Book Short የስዕል ደብተር አጭሩ',
            'Elastic band',
            'Erasor Shaped ላጲስ ባለቅርፅ',
            'Eyeye pan',
            'Fastener',
            'Fixer 0.5 ፊክሰር 5 ቁጥር',
            'Fixer 0.7 ፊክሰር 7 ቁጥር',
            'Flexible 20cm',
            'Fluid normal',
            'Folder 12 pockets ፎልበር 12 ኪስ',
            'Folder 7 Pockets ባለ 7 ኪስ ፎልደር',
            'Folder with rough texture ሸካራ ፎልደር',
            'Globe ግሎብ',
            'Hand Writing',
            'Hard cover',
            'Laminating 65*95',
            'Laminating 76* 106',
            'Laminating a3',
            'Lead 0.5 ሊድ 0.5 ቁጥር',
            'Lead 0.7 ሊድ 0.7 ቁጥር',
            'Magazin Rack ማጋዚን ራክ የሚገጠም',
            'Magazine Rack መጋዘን ራክ የተበተነ',
            'Marker 1 side',
            'Marker 2 side',
            'Marker 2 side',
            'Marshale compass',
            'NoteBook 18k Black ማስታወሻ 18k ጥቁር',
            'NoteBook 25k Leather Expensive ማስታወሻ 25k ሌዘር ዉዱ',
            'NoteBook 32k color',
            'NoteBook 32k normal ማስታወሻ 32k normal',
            'NoteBook 32k ጥቁር',
            'NoteBook 60k ማስታወሻ 60k',
            'NoteBook A4 ማስታወሻ A4 መዝገብ 200',
            'NoteBook A5 Magnet New ማስታወሻ A5 ማግኔት new',
            'NoteBook A5 Metal Magnet ማስታወሻ A5 ብረት ማግኔት',
            'NoteBook A5 Paris ማስታወሻ A5 ፓሪስ',
            'NoteBook A5 ማስታወሻ A5 ባለ new ማግኔት',
            'NoteBook A5 ማስታወሻ A5 ባለ new ገመድ',
            'Notebook A5 ማስታወሻ ባለ ዉሃ',
            'NoteBook A5-1 ማስታወሻ A5-1 ባለ ማግኔት',
            'NoteBook A5-11 ማስታወሻ A5- 11 ሄሎ subject',
            'NoteBook A5-6 Magnet Metal ማስታወሻ A5- 6 ጫፉ ነጭ ብረት ማግኔት',
            'NoteBook A5-7 Magnet Metal ማስታወሻ A5-7 ብረት ማግኔት',
            'NoteBook A6 100 ማስታወሻ A6 100',
            'NoteBook A6 Magnet New ማስታወሻ A6 ማግኔት new',
            'NoteBook A6 Ribbon ማስታወሻ A6 ገመድ የድሮ',
            'NoteBook A6 ማስታወሻ A6 ባለ 1 ለእስክርቢቶ',
            'NoteBook B5 Old ማስታወሻ የድሮ',
            'NoteBook B5-2 with pen ማስታወሻ B5-2 ባለ እስክርቢቶ',
            'NoteBook B5-4 Magnet Metal ማስታወሻ B5-4 ማግኔት ብረት',
            'NoteBook ማስታወሻ እንጨት',
            'Office pin',
            'Oil color',
            'Paint Brush የስዕል ብሩሽ',
            'Pan box hello',
            'Paper tray 2 ማይካ',
            'Paper tray 3 ማይካ',
            'Paper tray 3 ብረት 2001',
            'Pencil Bag ሸራ ፔንስል ባግ',
            'Pencil Bag ፔንስል ባግ ማይካ ባለ መቅተጫ',
            'Pencil Bag ፔንስል ባግ ሻራ ጠንካራዉ',
            'Pencil Color 2 sided',
            'Pencil Color እርሳስ ከለር አጭሩ',
            'Pencil Nann እርሳስ',
            'Pencil Vneeds እርሳስ',
            'Pencil እርሳስ ባለ እቃ',
            'Pencil እርሳስ የስዕል ቁጥሩ የተለያየ',
            'Piko ምሳቃ color',
            'Plaster Cutter የእጅ ፕላስተር መቁረጫ ውዱ',
            'Popit',
            'Popit',
            'Price Tag ዋጋ መለጠፊያ',
            'Puncher Small ፓንቸር ትንሹ',
            'Remover',
            'Ring 10 ረንግ 10',
            'Ring 12 ሪንግ 12',
            'Ring 14 ሪንግ 14',
            'Ring 16 ሪንግ 16',
            'Ring 18 ሪንግ 18',
            'Ring 20 ሪንግ 20',
            'Ring 6 ሪንግ 6',
            'Ring 8 ሪንግ 8',
            'Rotring Eraser ሮተሪንግ ላጲስ',
            'Ruler 30 cm normal',
            'Ruler 30 cm ማስመሪያ 30 cm ጠንካራዉ',
            'Ruler 50 cm ማስመሪያ 50 cm',
            'Scissor Big መቀስ ትልቁ ባለክዳን',
            'Scissor Kids የህፃናት መቀስ',
            'Scissor Small ትንሹ መቀስ',
            'Scissors መካከለኝ መቀስ',
            'Set Square 35 cm ሴትእስኩዊር 35 cm',
            'Set Square Yellow ሲትስኬር ቢጫ',
            'Set Square ቢጫ ሴትስኬር ማርከር ያለዉ እና የሌለዉ',
            'Sharpner with a Brush ባለ ቡሩሽ መቅረጫ',
            'Sharpner መቅረጫ',
            'Stapler gold',
            'Stapler ርካሹ',
            'T square 60cm',
            'Ticket ትኬት',
            'Ticket ትኬት',
            'Transparency Color ትራንስፓረንሲ ከለር',
            'Transparency White ትራንስፓረንሲ ነጭ',
            'Triangular ruler 30 cm 144',
            'Triangular ruler 30 cm 288',
            'Water Color ዉሃ ከለር ዉዱ ፍጭጭ የሚለዉ',
            'Water color',
            'White Board Marker',
            'Yuanyuan Marker',
            'ምሳቃ color ተንጠልጣይ',
            'ምሳቃ ከለር piko',
            'ሰፈነግ ( የብር መቁጠሪያ)',
            'ሽት ትፖቴክተር',
            'ቆርቆሮ ኮምፓስ',
            'እርኬል ማስመሪያ',
            'ከተር ትንሹ',
            'ክሊፕቦርድ ርካሹ',
            'ዉሃ ከለር ውዱትልቁ ፕንስል ባግ ሸራ',
            'የስጦታ ማስታወሻ የተሰራ',
            'የውብዳር ከለር',
            'ጥቁር ኮምፓስ',
            'ጥቁር የስዕል እርሳስ',
            'ጥጥ ማስታወሻ',
            'ፓንቸር ትንሹ 520',
            'ፓንቸር ትንቁ 520',






























































            // 'Dispencer big',
            // 'Dispencer small',
            // 'Water color',
            // 'Oil color',
            // '9*7',
            // 'Hard cover',
            // 'Office pin',
            // 'Stapler gold',
            // 'Elastic band',
            // 'Triangular ruler 30 cm 288',
            // 'Triangular ruler 30 cm 144',
            // 'T square 60cm',
            // 'Ruler 30 cm normal',
            // 'Crayon normal',
            // 'Bic Pen Blue ቢክ እስኪብርቶ ሰማያዊ',
            // 'Bic Pen Black ቢክ እስኪብርቶ ጥቁር',
            // '3 subject',
            // '4 subject',
            // '5 subject',
            // '3*3 noteit',
            // '3*4 noteit',
            // '3*5 noteit',




            // 'Set Square ቢጫ ሴትስኬር ማርከር ያለዉ እና የሌለዉ',
            // 'Flexible 20cm',
            // 'Crayon ምሳቃ ከለር በእቃ',
            // 'A4 laola',
            // 'A3 road map',
            // 'A3 laola',
            // 'A5 subject new',




            // 'A4 gold on',
            // 'A5 post',
            // 'B5-2 ባለማግኔት ጌጥ',
            // 'A6 ብልጭልጭ',
            // 'Acleric',

            // 'Magazin Rack ማጋዚን ራክ የሚገጠም',

            // 'Price Tag ዋጋ መለጠፊያ',
            // 'Laminating 76* 106',
            // 'Cilp file',
            // 'Diyer small',
            // 'Fluid normal',
            // 'Laminating 65*95',


            // 'Stapler ርካሹ',

            // 'Fastener',
            // 'White Board Marker',
            // 'ክሊፕቦርድ ርካሹ',
            // 'የውብዳር ከለር',
            // 'ምሳቃ ከለር piko',
            // 'Remover',
            // 'Marker 2 side',
            // 'ከተር ትንሹ',
            // 'ቆርቆሮ ኮምፓስ',
            // 'Agenda አጀንዳ',
            // 'A4 post',


            // 'Ruler 50 cm ማስመሪያ 50 cm',
            // 'ፓንቸር ትንሹ 520',
            // 'ፓንቸር ትንቁ 520',
            // 'Transparency Color ትራንስፓረንሲ ከለር',
            // 'Transparency White ትራንስፓረንሲ ነጭ',
            // 'Atlas Film አትላስ ፌልም',





            // 'B5-5 ቀጭን ሳንቲም',
            // '2025 -1',
            // '2025 ብልጭልጭ',
            // 'Diamond pen ዳይመንድ እስኪብርቶ',
            // 'B5 ባለ ሳንቲም ኖርማል',
            // 'B5-3 ባለማግኔት ብረት',
            // 'B5-1 ባለማግኔት ጫፉ ነጭ',
            // 'A5-5 ባለ ማብኔት ነጭ',
            // 'A6 ባለ ገመድ',


            // 'ጥቁር ኮምፓስ',

            // 'Set Square Yellow ሲትስኬር ቢጫ',
            // 'Set Square 35 cm ሴትእስኩዊር 35 cm',
            // 'NoteBook 32k color',
            // 'A5 - 10 ባለቀለበት',
            // 'A5 - 12 ባለ ፓኬት',
            // '25k- 5 ጨርቅ ማስታወሻ',
            // 'A5 - 9 ባለ ማግኔት ጌጥ',
            // '25k - 1 ፓሪስ',
            // 'A6- 2 ባለ ገመድ',
            // 'A6- 1 ባለቁልፍ',
            // 'A5- 8 ባለሳንቲም ባለእስክርቢቶ',
            // 'A6- 1 ባለ ገመድ',
            // 'A5 - ሳንቲም',
            // 'B5 - ሳንቲም',
            // 'A6- ቁልፍ የድሮ',
            // 'Box file Color',
            // 'Box file Black',
            // 'Ticket ትኬት',
            // 'A6- 2 ባለ ገመድ ብልጭልጭ ያለዉ',
            // 'A6- 3 ባለገመድ',
            // 'Ruler 30 cm ማስመሪያ 30 cm ጠንካራዉ',
            // 'A5 ብልጭልጭ 25k - 9',

            // 'Marshale compass',

            // 'Fixer 0.7 ፊክሰር 7 ቁጥር',
            // 'Fixer 0.5 ፊክሰር 5 ቁጥር',
            // 'እርኬል ማስመሪያ',
            // 'ጥቁር የስዕል እርሳስ',
            // 'Lead 0.7 ሊድ 0.7 ቁጥር',
            // 'Lead 0.5 ሊድ 0.5 ቁጥር',
            // 'Paint Brush የስዕል ብሩሽ',
            // 'Pencil Color 2 sided',
            // 'Yuanyuan Marker',
            // 'Laminating a3',
            // 'Rotring Eraser ሮተሪንግ ላጲስ',
            // 'Coloring Book',
            // 'Document Case',
            // 'Erasor Shaped ላጲስ ባለቅርፅ',
            // 'Coloring book ባለ-ብሪሽ',
            // 'B5 - 1 ሳንቲም',
            // 'B5- ባለ ሳንቲም እስክርቢቶ ማስገቢያ ያለዉ',

            // 'Sharpner መቅረጫ',
            // 'Popit',
            // 'ጥጥ ማስታወሻ',
            // 'Bj ባለ 300 ብር',
            // '6 columns',









            // 'የስጦታ ማስታወሻ የተሰራ',

            // 'Ring 6 ሪንግ 6',
            // 'Ring 8 ሪንግ 8',
            // 'Ring 10 ረንግ 10',
            // 'Ring 12 ሪንግ 12',
            // 'Ring 14 ሪንግ 14',
            // 'Ring 16 ሪንግ 16',
            // 'Ring 18 ሪንግ 18',
            // 'Ring 20 ሪንግ 20',




            // 'Diary Small ዲያሪ ትንሹ',
            // 'Diary Code ዲያሪ ኮድ',
            // 'Diary ዲያሪ ፍሩት',
            // 'Diary ዲያሪ የተለያየ',

            // 'Display book 40',
            // 'Display book 60',
            // 'Display book 80',
            // 'Display book 100',

            // 'Color Bag ክሊር ባግ ርካሹ',
            // 'NoteBook 32k ጥቁር',
            // 'Folder with rough texture ሸካራ ፎልደር',
            // 'A5 -2 ባለ እስክርቢቶ',

            // 'Pencil Bag ፔንስል ባግ ማይካ ባለ መቅተጫ',
            // 'Pencil Bag ሸራ ፔንስል ባግ',
            // 'Pencil Bag ፔንስል ባግ ሻራ ጠንካራዉ',

            // 'Pencil እርሳስ የስዕል ቁጥሩ የተለያየ',
            // 'Pencil Vneeds እርሳስ',
            // 'Pencil Nann እርሳስ',
            // 'Pencil እርሳስ ባለ እቃ',
            // 'Pencil Color እርሳስ ከለር አጭሩ',

            // 'ሽት ትፖቴክተር',
            // 'Business Card ቢዝነስ ካርድ',
            // '335-',
            // 'A5-11-1 ጠንካራ ከቨር ያለዉ',
            // 'Puncher Small ፓንቸር ትንሹ',

            // '435-',
            // 'Water Color ዉሃ ከለር ዉዱ ፍጭጭ የሚለዉ',

            // 'Scissors መካከለኝ መቀስ',
            // 'Scissor Small ትንሹ መቀስ',
            // 'Scissor Kids የህፃናት መቀስ',
            // 'Scissor Big መቀስ ትልቁ ባለክዳን',

            // 'Folder 7 Pockets ባለ 7 ኪስ ፎልደር',

            // 'NoteBook B5-2 with pen ማስታወሻ B5-2 ባለ እስክርቢቶ',
            // 'NoteBook A6 Ribbon ማስታወሻ A6 ገመድ የድሮ',
            // 'NoteBook A5-11 ማስታወሻ A5- 11 ሄሎ subject',
            // 'NoteBook A5-7 Magnet Metal ማስታወሻ A5-7 ብረት ማግኔት',
            // 'NoteBook A5-6 Magnet Metal ማስታወሻ A5- 6 ጫፉ ነጭ ብረት ማግኔት',
            // 'NoteBook B5-4 Magnet Metal ማስታወሻ B5-4 ማግኔት ብረት',
            // 'NoteBook A6 ማስታወሻ A6 ባለ 1 ለእስክርቢቶ',
            // 'NoteBook A5 ማስታወሻ A5 ባለ new ማግኔት',
            // 'NoteBook A5 ማስታወሻ A5 ባለ new ገመድ',
            // 'NoteBook B5 Old ማስታወሻ የድሮ',
            // 'Notebook A5 ማስታወሻ ባለ ዉሃ',
            // 'NoteBook A5 Magnet New ማስታወሻ A5 ማግኔት new',
            // 'NoteBook A5 Paris ማስታወሻ A5 ፓሪስ',
            // 'NoteBook 25k Leather Expensive ማስታወሻ 25k ሌዘር ዉዱ',
            // 'NoteBook A5 Metal Magnet ማስታወሻ A5 ብረት ማግኔት',
            // 'NoteBook A6 Magnet New ማስታወሻ A6 ማግኔት new',
            // 'NoteBook 60k ማስታወሻ 60k',
            // 'NoteBook 32k normal ማስታወሻ 32k normal',
            // 'NoteBook 18k Black ማስታወሻ 18k ጥቁር',
            // 'NoteBook A6 100 ማስታወሻ A6 100',
            // 'NoteBook A5-1 ማስታወሻ A5-1 ባለ ማግኔት',
            // 'NoteBook A4 ማስታወሻ A4 መዝገብ 200',
            // 'NoteBook ማስታወሻ እንጨት',

            // 'Sharpner with a Brush ባለ ቡሩሽ መቅረጫ',
            // 'ሰፈነግ ( የብር መቁጠሪያ)',
            // 'Magazine Rack መጋዘን ራክ የተበተነ',

            // 'Paper tray 2 ማይካ',
            // 'Paper tray 3 ማይካ',
            // 'Paper tray 3 ብረት 2001',


            // 'Globe ግሎብ',
            // 'Marker 1 side',
            // 'Marker 2 side',
            // 'Compass 3009 ማይካ',

            // 'Color Bad 2 pockets ክሊር ባግ ባለ 2 ኪስ',

            // 'Folder 12 pockets ፎልበር 12 ኪስ',

            // 'Cutter Small ከተር ትልቁ',
            // 'Compass ፕላስቲክ 5007',
            // 'Compass 8010',
            // 'Compass color b',
            // 'Compass 8005 ማይካ',
            // 'Plaster Cutter የእጅ ፕላስተር መቁረጫ ውዱ',
            // 'A4 posta',

            // 'ዉሃ ከለር ውዱትልቁ ፕንስል ባግ ሸራ',

            // 'Eyeye pan',
            // 'A5 ገመድ new',
            // 'Dispencer Medium ዲስፔስር መካከለኛ',
            // '2 side colore ዉዱ',
            // '3*4',

            // 'Popit',
            // 'ምሳቃ color ተንጠልጣይ',
            // 'Clipboard Cheap ርካሹ ክሊፕ ቦርድ',

            // 'Pan box hello',
            // 'A4 binding file ዉዱ',
            // 'Piko ምሳቃ color',

            // 'Ticket ትኬት',
            // 'Drawing Book Short የስዕል ደብተር አጭሩ',
            // 'Drawing Book Long የስዕል ደብተር ረጅሙ',
            // 'Hand Writing'

        ];

        $imageUrls = []; // Initialize an empty array for image URLs

        foreach ($productNames as $productName) {



            //$itemId = 1;
            // Generate image URLs for each product (from local storage)
            $image1Path = 'images/product_images/' . str_replace(' ', '_', $productName) . '_1.jpg'; //Example: product_images/Product_A_1.jpg
            $image2Path = 'images/product_images/' . str_replace(' ', '_', $productName) . '_2.jpg'; //Example: product_images/Product_A_2.jpg

            $image1Url = asset($image1Path);
            $image2Url = asset($image2Path);



            $colorImage1Url = asset('images/product_images/' . str_replace(' ', '_', $productName) . '_color_1.jpg'); //Example: product_images/Product_A_color_1.jpg
            $colorImage2Url = asset('images/product_images/' . str_replace(' ', '_', $productName) . '_color_2.jpg'); //Example: product_images/Product_A_color_2.jpg
            $colorImages = [
                $colorImage1Url,
                $colorImage2Url,
            ];

            $images = [
                $image1Url,
                $image2Url,
                $colorImage1Url,
                $colorImage2Url,
            ];

            $colors = [
                ['name' => 'BONE', 'image_path' => '$colorImages', 'disabled' => false],
                ['name' => 'WHITE', 'image_path' => '$colorImages', 'disabled' => false],
                ['name' => 'BLACK', 'image_path' => '$colorImages', 'disabled' => false],
                ['name' => 'PURPLE', 'image_path' => '$colorImages', 'disabled' => false],
                ['name' => 'BUTTER CORN', 'image_path' => '$colorImages', 'disabled' => true],
                ['name' => 'QUARTZ', 'image_path' => '$colorImages', 'disabled' => false],
            ];

            // $colors = [
            //     'Red',
            //     'Blue',
            //     'Green',
            //     'Yellow',
            //     'Black',
            //     'White',
            //     'Purple',
            //     'Orange',
            //     'Pink',
            //     'Brown',
            //     'Gray',
            // ];

            $sizes = [
                'Small',
                'Medium',
                'Large',
                'Extra Large',
            ];



            $packagingTypes = [
                ['name' => 'Piece', 'quantity' => 1],
                ['name' => 'Doz', 'quantity' => 12],
                ['name' => 'Bundle', 'quantity' => 10],
                ['name' => 'Packet', 'quantity' => 50],
                ['name' => 'Bag', 'quantity' => 100],
                ['name' => 'Wrapper', 'quantity' => 1],
                ['name' => 'Bottle', 'quantity' => 1],
                ['name' => 'Case', 'quantity' => 24],
                ['name' => 'Crate', 'quantity' => 1000],
                ['name' => 'Container', 'quantity' => 5000],
            ];





            // // Generate image URLs for each product
            // $images = [
            //     'https://via.placeholder.com/' . rand(150, 250), // Example: Random size
            //     'https://via.placeholder.com/' . rand(250, 400),
            // ];





            // // Add the image URLs to the $imageUrls array
            // $imageUrls[] = $images;

            $item = Item::create([
                'product_images' => json_encode($images), // 1 Example image URLs
                'variation' => fake()->word(),// 2
                'price' => fake()->randomFloat(2, 10, 500), // 3 Price between 10 and 500
                'product_name' => $productName,// 4
                'product_description' => fake()->sentence(),// 5
                'packaging_details' => json_encode($packagingTypes),// 6 $packagingTypes
                'status' => fake()->randomElement(['draft', 'active', 'inactive', 'unavailable']),// 7
                'incomplete' => fake()->boolean(),// 8
                'category_id' => rand(1, 10), // 9 Assuming categories exist
                'item_category_id' => rand(1, 10),// 10
                'selectedCategories' => json_encode(array_rand(range(1, 10), 3)), // 11
                'newCategoryNames' => json_encode([fake()->word(), fake()->word()]), // 12
                'sold_count' => rand(0, 500), // 13 Random sold count
                'discount_price' => fake()->randomFloat(2, 0, 100), // 14 Random discount price
                'discount_percentage' => fake()->randomFloat(2, 0, 100), // 15 Random discount percentage


                'created_at' => now(),
                'updated_at' => now(),

            ]);

            //  // Now, assign different colors for this item
            // //foreach ($colors as $color) {
            //     ItemColor::create([
            //         'item_id' => $itemId, // Assuming the item ID is 1 for this example
            //         'name' => $colors[0]['name'], // Example color name
            //         'image_path' => $colors[0]['image_path'], // Example image path
            //         'disabled' => $colors[0]['disabled'], // Example disabled status
            //     ]);
            // // }
            // $itemId++;

            // Assign all colors to each item

            // foreach ($colors as $color) {
            //     ItemColor::create([
            //         'item_id' => $item->id,
            //         'name' => $color['name'],
            //         'image_path' => $colorImages[0], // Example image path
            //         'disabled' => $color['disabled'],
            //     ]);
            // }


            //   $itemVariation =  ItemVariant::create([
            //         'item_id' => $item->id,
            //         'item_color_id' => 1, // color id you manually choose
            //         'item_size_id' => 1,
            //         'item_packaging_type_id' => 1,
            //         'price' => 1,
            //         'stock' => 10,
            //         'owner_id' => 1,
            //     ]);

                // ItemVariant::create([
                //     'item_id' => $item->id,
                //     'item_color_id' => 2,
                //     'item_size_id' => $size->id,
                //     'item_packaging_type_id' => $packaging->id,
                //     'price' => 2,
                //     'stock' => 20,
                //     'owner_id' => $owner->id,
                // ]);


        }


    }
}
