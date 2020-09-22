<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateManufacturersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateManufacturers();
    }

    private function addOrUpdateManufacturers()
    {
        $dsManufacturers = [
            [
                'id'         => 1,
                'name'       => 'Sharp',
                'position'   => 1,
                'is_enabled' => 1,
            ],
            [
                'id'         => 2,
                'name'       => 'Lexmark',
                'position'   => 2,
                'is_enabled' => 1,
            ],
        ];



    }
}
