<?php
namespace Database\Seeders;

use App\Manufacturer;
use App\Papersize;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterExtraFeature;
use App\PrinterPapersize;
use App\PrinterTechnicalSpecificationCategory;
use Illuminate\Database\Seeder;

class TestdataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = 1;
        $id = 100;
        $printers = [
            ['manufacturer_id' => 1, 'name' => 'Sharp printer', 'usergroup_size_id' => 11,  'description' => 'Sharp printer', 'slug' => \Str::slug('Sharp printer'), 'html_page_title' => 'Sharp printer', 'html_page_meta_description' => 'Sharp printer'],
            ['manufacturer_id' => 1, 'name' => 'Sharp MFC', 'usergroup_size_id' => 11,  'description' => 'Sharp MFC', 'slug' => \Str::slug('Sharp MFC'), 'html_page_title' => 'Sharp MFC', 'html_page_meta_description' => 'Sharp MFC'],
            ['manufacturer_id' => 2, 'name' => 'Lexmark printer', 'usergroup_size_id' => 11,  'description' => 'Lexmark printer', 'slug' => \Str::slug('Lexmark printer'), 'html_page_title' => 'Lexmark printer', 'html_page_meta_description' => 'Lexmark printer'],
            ['manufacturer_id' => 2, 'name' => 'Lexmark MFC', 'usergroup_size_id' => 11,  'description' => 'Lexmark MFC', 'slug' => \Str::slug('Lexmark MFC'), 'html_page_title' => 'Lexmark MFC', 'html_page_meta_description' => 'Lexmark MFC'],
            ['manufacturer_id' => 2, 'name' => 'Lexmark MFC', 'usergroup_size_id' => 12,  'description' => 'Lexmark MFC', 'slug' => \Str::slug('Lexmark MFC'), 'html_page_title' => 'Lexmark MFC', 'html_page_meta_description' => 'Lexmark MFC'],
            ['manufacturer_id' => 2, 'name' => 'Lexmark lézerprinter', 'usergroup_size_id' => 11,  'description' => 'Lexmark lézerprinter', 'slug' => \Str::slug('Lexmark lézerprinter'), 'html_page_title' => 'Lexmark lézerprinter', 'html_page_meta_description' => 'Lexmark lézerprinter'],
        ];
        PrinterAttribute::query()->delete();
        PrinterPapersize::query()->delete();
        Printer::query()->delete();
        foreach ($printers as $p) {
            $data = $p;
            $data['request_for_price'] = random_int(0,1);
            $data['model_number'] = mb_strtoupper(\Str::random(4));
            $data['model_number_displayed'] = $data['model_number'].'-'.random_int(1,5);
            $data['price'] = random_int(1000,500000);
            $printer = Printer::updateOrCreate([
                'manufacturer_id' => $p['manufacturer_id'],
                'name' => $p['name'],
            ], $data);
            PrinterAttribute::create([
                'printer_id' => $printer->id,
                'attribute_id' => 6,
                'customvalue' => random_int(40, 60),
            ]);
            PrinterAttribute::create([
                'printer_id' => $printer->id,
                'attribute_id' => 16,
                'customvalue' => random_int(400, 500),
            ]);
            PrinterAttribute::create([
                'printer_id' => $printer->id,
                'attribute_id' => 12,
                'attribute_value_id' => random_int(1001,1002),
            ]);
            PrinterAttribute::create([
                'printer_id' => $printer->id,
                'attribute_id' => 1,
                'attribute_value_id' => random_int(3002,3003),
            ]);
            PrinterPapersize::create([
                'printer_id' => $printer->id,
                'papersize_id' => Papersize::query()->inRandomOrder()->first()->id
            ]);
        }
    }
}
