<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateAttributesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateAttributes();
    }

    private function addOrUpdateAttributes()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'attributes';
        $fields = [
            'id',
            'attribute_value_set_id',
            'name',
            'label',
            'is_computed',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    private function getRawDataSet()
    {
        $dataSet = [
            ['id' => 1, 'attribute_value_set_id' => 3, 'name' => 'Nyomtatás', 'label' => 'Print'],
            ['id' => 2, 'attribute_value_set_id' => 3, 'name' => 'Másolás', 'label' => 'Copy'],
            ['id' => 3, 'attribute_value_set_id' => 3, 'name' => 'Szkennelés', 'label' => 'Scan'],
            ['id' => 4, 'attribute_value_set_id' => 1, 'name' => 'Fax', 'label' => null],
            ['id' => 5, 'attribute_value_set_id' => null, 'name' => 'Nyomtatási méret (max)', 'is_computed' => 1],
            ['id' => 6, 'attribute_value_set_id' => null, 'name' => 'Hardveres felbontás'],
            ['id' => 7, 'attribute_value_set_id' => null, 'name' => 'Sebesség fekete-fehér (A4)'],
            ['id' => 8, 'attribute_value_set_id' => null, 'name' => 'Sebesség fekete-fehér (A3)'],
            ['id' => 9, 'attribute_value_set_id' => 5, 'name' => 'Hálózatos / Helyi'],

        ];
        /**
         * @todo Ide további attribútumokat kell felvenni
         */

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
        }

        return $dataSet;
    }
}
