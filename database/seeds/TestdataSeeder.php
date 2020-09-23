<?php
namespace Database\Seeders;

use App\Manufacturer;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterExtraFeature;
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
        $manufacturers = [
            ['id' => $id++, 'name' => 'Sharp', 'position' => $position++, 'is_enabled' => 1, 'url' => 'www.sharp.com'],
            ['id' => $id++, 'name' => 'Conica', 'position' => $position++, 'is_enabled' => 0, 'url' => 'www.conica.com'],
            ['id' => $id++, 'name' => 'HP', 'position' => $position++, 'is_enabled' => 1, 'url' => 'www.hp.com'],
            ['id' => $id++, 'name' => 'Canon', 'position' => $position++, 'is_enabled' => 1, 'url' => 'www.canon.com'],
        ];
        $printers = [
            ['manufacturer_id' => 100, 'name' => 'Sharp printer', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'Sharp printer', 'slug' => \Str::slug('Sharp printer'), 'html_page_title' => 'Sharp printer', 'html_page_meta_description' => 'Sharp printer', 'printing_mode' => 1, 'copying_mode' => 0, 'scanning_mode' => 0],
            ['manufacturer_id' => 100, 'name' => 'Sharp MFC', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'Sharp MFC', 'slug' => \Str::slug('Sharp MFC'), 'html_page_title' => 'Sharp MFC', 'html_page_meta_description' => 'Sharp MFC', 'printing_mode' => 1, 'copying_mode' => 1, 'scanning_mode' => 1],
            ['manufacturer_id' => 101, 'name' => 'Conica printer', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'Conica printer', 'slug' => \Str::slug('Conica printer'), 'html_page_title' => 'Conica printer', 'html_page_meta_description' => 'Conica printer', 'printing_mode' => 1, 'copying_mode' => 0, 'scanning_mode' => 0],
            ['manufacturer_id' => 101, 'name' => 'Conica MFC', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'Conica MFC', 'slug' => \Str::slug('Conica MFC'), 'html_page_title' => 'Conica MFC', 'html_page_meta_description' => 'Conica MFC', 'printing_mode' => 1, 'copying_mode' => 1, 'scanning_mode' => 1],
            ['manufacturer_id' => 102, 'name' => 'HP printer', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'HP printer', 'slug' => \Str::slug('HP printer'), 'html_page_title' => 'HP printer', 'html_page_meta_description' => 'HP printer', 'printing_mode' => 1, 'copying_mode' => 0, 'scanning_mode' => 0],
            ['manufacturer_id' => 102, 'name' => 'HP MFC', 'usergroup_size_id' => 13, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'HP MFC', 'slug' => \Str::slug('HP MFC'), 'html_page_title' => 'HP MFC', 'html_page_meta_description' => 'HP MFC', 'printing_mode' => 1, 'copying_mode' => 1, 'scanning_mode' => 1],
            ['manufacturer_id' => 102, 'name' => 'HP scanner', 'usergroup_size_id' => 11, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'HP scanner', 'slug' => \Str::slug('HP scanner'), 'html_page_title' => 'HP scanner', 'html_page_meta_description' => 'HP scanner', 'printing_mode' => 0, 'copying_mode' => 0, 'scanning_mode' => 1],
            ['manufacturer_id' => 103, 'name' => 'Canon MFC', 'usergroup_size_id' => 12, 'color_technology' => 1, 'is_multifunctional' => 0, 'description' => 'Canon MFC', 'slug' => \Str::slug('Canon MFC'), 'html_page_title' => 'Canon MFC', 'html_page_meta_description' => 'Canon MFC', 'printing_mode' => 1, 'copying_mode' => 1, 'scanning_mode' => 1],
            ['manufacturer_id' => 103, 'name' => 'Canon lézerprinter', 'usergroup_size_id' => 11, 'color_technology' => 0, 'is_multifunctional' => 0, 'description' => 'Canon lézerprinter', 'slug' => \Str::slug('Canon lézerprinter'), 'html_page_title' => 'Canon lézerprinter', 'html_page_meta_description' => 'Canon lézerprinter', 'printing_mode' => 1, 'copying_mode' => 0, 'scanning_mode' => 0],
        ];
        PrinterAttribute::query()->delete();
        PrinterTechnicalSpecificationCategory::query()->delete();
        Printer::query()->delete();
        foreach ($manufacturers as $manufacturer) {
            Manufacturer::updateOrCreate([
                'id' => $manufacturer['id'],
                'name' => $manufacturer['name'],
            ], $manufacturer);
        }
        foreach ($printers as $p) {
            $data = $p;
            $data['request_for_price'] = random_int(0,1);
            $data['price'] = random_int(1000,500000);
            $printer = Printer::updateOrCreate([
                'manufacturer_id' => $p['manufacturer_id'],
                'name' => $p['name'],
            ], $data);
        }
    }
}
