<?php

namespace Database\Seeders;

use App\Manufacturer;
use App\Printer;
use App\PrinterRentaloption;
use Illuminate\Database\Seeder;

class PrinterRentaloptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            100 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '15.6', 'price' => '12900'],
            200 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '15.6', 'price' => '19900'],
            300 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '', 'price' => '9900'],
            400 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '', 'price' => '12900'],
            500 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '15.6', 'price' => '34900'],
            600 => ['extra_page_price_bw' => '2.6', 'extra_page_price_color' => '', 'price' => '19900'],        ];
        $rentals = [
            ['model_number' => 'MX4141N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '500',  'popularity_index' => '15,1'],
            ['model_number' => 'MX3140N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '200',  'popularity_index' => '18,1'],
            ['model_number' => 'MX2614N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '100',  'popularity_index' => '11,1'],
            ['model_number' => 'MXM564N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '600',  'popularity_index' => '40,1'],
            ['model_number' => 'MXM452N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '600',  'popularity_index' => '33,1'],
            ['model_number' => 'MXM365N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '400',  'popularity_index' => '44,2'],
            ['model_number' => 'MXM364N', 'manufacturer' => 'Sharp', 'rentaloption_id' => '400',  'popularity_index' => '44,3'],
            ['model_number' => 'MXM356NV', 'manufacturer' => 'Sharp', 'rentaloption_id' => '300',  'popularity_index' => '47,7'],
            ['model_number' => 'MXM316NV', 'manufacturer' => 'Sharp', 'rentaloption_id' => '300',  'popularity_index' => '47,8'],
            ['model_number' => 'MXM266NV', 'manufacturer' => 'Sharp', 'rentaloption_id' => '300',  'popularity_index' => '19,1'],
        ];
        $manufacturers = Manufacturer::all()->keyBy('name');
        foreach ($rentals as $rental) {
            $printer = Printer::where([
                'model_number' =>  $rental['model_number'],
                'manufacturer_id' => $manufacturers->get($rental['manufacturer'])->id,
            ])->first();
            if ($printer != null) {
                $dataset = [
                    'extra_page_price_bw' => floatval($prices[$rental['rentaloption_id']]['extra_page_price_bw']),
                    'extra_page_price_color' => floatval($prices[$rental['rentaloption_id']]['extra_page_price_color']),
                    'price' => intval($prices[$rental['rentaloption_id']]['price']),
                    'printer_id' => $printer->id,
                    'rentaloption_id' => $rental['rentaloption_id'],
                    'is_enabled' => 1,
                    'popularity_index' => floatval(str_ireplace(',', '.', $rental['popularity_index'])),
                ];
                PrinterRentaloption::updateOrCreate([
                    'printer_id' => $dataset['printer_id'],
                    'rentaloption_id' => $dataset['rentaloption_id'],
                ], $dataset);
            }
        }
    }
}
