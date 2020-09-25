<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateAttributegroupsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateAttributegroups();
    }

    private function addOrUpdateAttributegroups()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'attributegroups';
        $fields = [
            'id',
            'name',
            'variable_name',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    /**
     * @return array
     */
    private function getRawDataSet(): array
    {
        $dataSet = [
            ['id'=>'1', 'name'=>'Kiemelt funkciók', 'variable_name'=>'main_functionalities', ],
            ['id'=>'2', 'name'=>'Alap tulajdonságok', 'variable_name'=>'basic_parameters', ],
            ['id'=>'3', 'name'=>'Letöltések', 'variable_name'=>'downloads', ],
            ['id'=>'4', 'name'=>'Műszaki jellemzők', 'variable_name'=>'technical_specifications', ],
        ];

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
        }

        return $dataSet;
    }
}
