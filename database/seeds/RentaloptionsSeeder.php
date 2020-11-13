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
            100 => ['number_of_pages_included_bw' => '3000', 'number_of_pages_included_color' => '200',  'color_technology' => \App\Helpers\ColorTechnology::COLOR_ID],
            200 => ['number_of_pages_included_bw' => '3000', 'number_of_pages_included_color' => '1000',  'color_technology' => \App\Helpers\ColorTechnology::COLOR_ID],
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
