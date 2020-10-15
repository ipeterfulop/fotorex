<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
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
        $dsManufacturers = $this->getRawDataSet();
        $this->addOrUpdateRecords($dsManufacturers);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'manufacturers';
        $fields = [
            'id',
            'name',
            'position',
            'is_enabled',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    /**
     * @return array[]
     */
    private function getRawDataSet(): array
    {
        $dataSet = [
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

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = \Carbon\Carbon::now();
            $dataRow['updated_at'] = \Carbon\Carbon::now();
        }

        return $dataSet;
    }
}
