<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateAttributeSetsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateAttributeSets();
    }

    private function addOrUpdateAttributeSets()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'attribute_value_sets';
        $fields = [
            'id',
            'name',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    private function getRawDataSet()
    {
        $dataSet = [
            [
                'id'   => 1,
                'name' => 'Igen/Nem lista',
            ],
            [
                'id'   => 2,
                'name' => 'Nyomtatási technológia',
            ],
            [
                'id'   => 3,
                'name' => 'Eszköz funkciójának elérhetősége',
            ],
            [
                'id'   => 4,
                'name' => 'Eszköz funkciójának opciós elérhetősége',
            ],
            [
                'id'   => 5,
                'name' => 'Helyi/hálózatos',
            ],
        ];

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
        }

        return $dataSet;
    }
}
