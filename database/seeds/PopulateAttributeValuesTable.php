<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateAttributeValuesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateAttributeValues();
    }

    private function addOrUpdateAttributeValues()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'attribute_values';
        $fields = [
            'id',
            'attribute_value_set_id',
            'value',
            'label',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    private function getRawDataSet()
    {
        $dataSet = [
            ['id' => 1001, 'attribute_value_set_id' => 1, 'value' => 1, 'label' => 'Igen'],
            ['id' => 1002, 'attribute_value_set_id' => 1, 'value' => 2, 'label' => 'Nem'],
            ['id' => 2001, 'attribute_value_set_id' => 2, 'value' => 1, 'label' => 'Fekete-fehér'],
            ['id' => 2002, 'attribute_value_set_id' => 2, 'value' => 2, 'label' => 'Színes'],
            ['id' => 3001, 'attribute_value_set_id' => 3, 'value' => 0, 'label' => 'Nem elérhető'],
            ['id' => 3002, 'attribute_value_set_id' => 3, 'value' => 1, 'label' => 'Fekete-fehér'],
            ['id' => 3003, 'attribute_value_set_id' => 3, 'value' => 2, 'label' => 'Színes'],
            ['id' => 4001, 'attribute_value_set_id' => 4, 'value' => 1, 'label' => 'Nem elérhető'],
            ['id' => 4002, 'attribute_value_set_id' => 4, 'value' => 2, 'label' => 'Alap'],
            ['id' => 4003, 'attribute_value_set_id' => 4, 'value' => 3, 'label' => 'Opció'],
            ['id' => 5001, 'attribute_value_set_id' => 5, 'value' => 1, 'label' => 'Helyi'],
            ['id' => 5002, 'attribute_value_set_id' => 5, 'value' => 2, 'label' => 'Hálózatos'],
            ['id' => 5003, 'attribute_value_set_id' => 5, 'value' => 3, 'label' => 'Opciónálisan hálózatos'],
            ['id' => 6001, 'attribute_value_set_id' => 6, 'value' => 1, 'label' => 'Lézer'],
            ['id' => 6002, 'attribute_value_set_id' => 6, 'value' => 2, 'label' => 'Tintasugaras'],
        ];

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
        }

        return $dataSet;
    }
}
