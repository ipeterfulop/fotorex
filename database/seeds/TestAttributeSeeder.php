<?php

namespace Database\Seeders;

use App\Printer;
use App\PrinterAttribute;
use Illuminate\Database\Seeder;

class TestAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Printer::all() as $printer) {
            PrinterAttribute::updateOrCreate([
                'printer_id' => $printer->id,
                'attribute_id' => 6,
                ], [
                'customvalue' => random_int(40, 60),
            ]);
            PrinterAttribute::updateOrCreate([
                'printer_id' => $printer->id,
                'attribute_id' => 16,
                ], [
                'customvalue' => random_int(400, 500),
            ]);
        }
    }
}
