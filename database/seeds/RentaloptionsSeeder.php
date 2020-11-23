<?php

namespace Database\Seeders;

use App\Rentaloption;
use Illuminate\Database\Seeder;

class RentaloptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaults = [
            'full_operation_included' => 1,
            'min_number_of_persons' => 1,
            'max_number_of_persons' => 5,
            'printing_included' => 1,
            'copying_included' => 1,
            'scanning_included' => 1,
            'description' => '',
        ];
        $dataset = [
            100 => ['number_of_pages_included_bw' => '2000', 'number_of_pages_included_color' => '200',  'color_technology' => 2],
            200 => ['number_of_pages_included_bw' => '3000', 'number_of_pages_included_color' => '500',  'color_technology' => 2],
            300 => ['number_of_pages_included_bw' => '1000', 'number_of_pages_included_color' => '0',  'color_technology' => 1],
            400 => ['number_of_pages_included_bw' => '3000', 'number_of_pages_included_color' => '0',  'color_technology' => 1],
            500 => ['number_of_pages_included_bw' => '5000', 'number_of_pages_included_color' => '1000',  'color_technology' => 2],
            600 => ['number_of_pages_included_bw' => '5000', 'number_of_pages_included_color' => '0',  'color_technology' => 1],
        ];
        foreach ($dataset as $id => $row) {
            $rentaloption = Rentaloption::find($id);
            if ($rentaloption == null) {
                Rentaloption::create($defaults + $row + ['id' => $id]);
            } else {
                $rentaloption->update($defaults + $row);
            }
        }
    }
}
