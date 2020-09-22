<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PopulatePapersizesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdatePapersizes();
    }

    private function addOrUpdatePapersizes()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords($dataSet)
    {
        $table = 'papersizes';
        $fields = [
            'id',
            'code',
            'width_in_millimetres',
            'height_in_millimetres',
            'width_in_inches',
            'height_in_inches',
        ];
        \App\DatabaseSeedingAction::insertOrUpdateMultipleRecords(
            $table,
            $dataSet,
            $fields
        );
    }

    private function getRawDataSet(): array
    {
        $dataSet = [
            ['id'=>1,'code'=>'A0', 'width_in_millimetres'=>841, 'height_in_millimetres'=>1189, 'width_in_inches'=>33.1, 'height_in_inches'=>46.8, ],
            ['id'=>2,'code'=>'A1', 'width_in_millimetres'=>594, 'height_in_millimetres'=>841, 'width_in_inches'=>23.4, 'height_in_inches'=>33.1, ],
            ['id'=>3,'code'=>'A2', 'width_in_millimetres'=>420, 'height_in_millimetres'=>594, 'width_in_inches'=>16.5, 'height_in_inches'=>23.4, ],
            ['id'=>4,'code'=>'A3', 'width_in_millimetres'=>297, 'height_in_millimetres'=>420, 'width_in_inches'=>11.7, 'height_in_inches'=>16.5, ],
            ['id'=>5,'code'=>'A4', 'width_in_millimetres'=>210, 'height_in_millimetres'=>297, 'width_in_inches'=>8.3, 'height_in_inches'=>11.7, ],
            ['id'=>6,'code'=>'A5', 'width_in_millimetres'=>148, 'height_in_millimetres'=>210, 'width_in_inches'=>5.8, 'height_in_inches'=>8.3, ],
            ['id'=>7,'code'=>'A6', 'width_in_millimetres'=>105, 'height_in_millimetres'=>148, 'width_in_inches'=>4.1, 'height_in_inches'=>5.8, ],
            ['id'=>8,'code'=>'A7', 'width_in_millimetres'=>74, 'height_in_millimetres'=>105, 'width_in_inches'=>2.9, 'height_in_inches'=>4.1, ],
            ['id'=>9,'code'=>'A8', 'width_in_millimetres'=>52, 'height_in_millimetres'=>74, 'width_in_inches'=>2, 'height_in_inches'=>2.9, ],
            ['id'=>10,'code'=>'A9', 'width_in_millimetres'=>37, 'height_in_millimetres'=>52, 'width_in_inches'=>1.5, 'height_in_inches'=>2, ],
            ['id'=>11,'code'=>'A10', 'width_in_millimetres'=>26, 'height_in_millimetres'=>37, 'width_in_inches'=>1, 'height_in_inches'=>1.5, ],
            ['id'=>12,'code'=>'B0', 'width_in_millimetres'=>1000, 'height_in_millimetres'=>1414, 'width_in_inches'=>39.4, 'height_in_inches'=>55.7, ],
            ['id'=>13,'code'=>'B1', 'width_in_millimetres'=>707, 'height_in_millimetres'=>1000, 'width_in_inches'=>27.8, 'height_in_inches'=>39.4, ],
            ['id'=>14,'code'=>'B2', 'width_in_millimetres'=>500, 'height_in_millimetres'=>707, 'width_in_inches'=>19.7, 'height_in_inches'=>27.8, ],
            ['id'=>15,'code'=>'B3', 'width_in_millimetres'=>353, 'height_in_millimetres'=>500, 'width_in_inches'=>13.9, 'height_in_inches'=>19.7, ],
            ['id'=>16,'code'=>'B4', 'width_in_millimetres'=>250, 'height_in_millimetres'=>353, 'width_in_inches'=>9.8, 'height_in_inches'=>13.9, ],
            ['id'=>17,'code'=>'B5', 'width_in_millimetres'=>176, 'height_in_millimetres'=>250, 'width_in_inches'=>6.9, 'height_in_inches'=>9.8, ],
            ['id'=>18,'code'=>'B6', 'width_in_millimetres'=>125, 'height_in_millimetres'=>176, 'width_in_inches'=>4.9, 'height_in_inches'=>6.9, ],
            ['id'=>19,'code'=>'B7', 'width_in_millimetres'=>88, 'height_in_millimetres'=>125, 'width_in_inches'=>3.5, 'height_in_inches'=>4.9, ],
            ['id'=>20,'code'=>'B8', 'width_in_millimetres'=>62, 'height_in_millimetres'=>88, 'width_in_inches'=>2.4, 'height_in_inches'=>3.5, ],
            ['id'=>21,'code'=>'B9', 'width_in_millimetres'=>44, 'height_in_millimetres'=>62, 'width_in_inches'=>1.7, 'height_in_inches'=>2.4, ],
            ['id'=>22,'code'=>'B10', 'width_in_millimetres'=>31, 'height_in_millimetres'=>44, 'width_in_inches'=>1.2, 'height_in_inches'=>1.7, ],
            ['id'=>23,'code'=>'C0', 'width_in_millimetres'=>917, 'height_in_millimetres'=>1297, 'width_in_inches'=>36.1, 'height_in_inches'=>51.5, ],
            ['id'=>24,'code'=>'C1', 'width_in_millimetres'=>648, 'height_in_millimetres'=>917, 'width_in_inches'=>25.5, 'height_in_inches'=>36.1, ],
            ['id'=>25,'code'=>'C2', 'width_in_millimetres'=>458, 'height_in_millimetres'=>648, 'width_in_inches'=>18, 'height_in_inches'=>25.5, ],
            ['id'=>26,'code'=>'C3', 'width_in_millimetres'=>324, 'height_in_millimetres'=>458, 'width_in_inches'=>12.8, 'height_in_inches'=>18, ],
            ['id'=>27,'code'=>'C4', 'width_in_millimetres'=>229, 'height_in_millimetres'=>324, 'width_in_inches'=>9, 'height_in_inches'=>12.8, ],
            ['id'=>28,'code'=>'C5', 'width_in_millimetres'=>162, 'height_in_millimetres'=>229, 'width_in_inches'=>6.4, 'height_in_inches'=>9, ],
            ['id'=>29,'code'=>'C6', 'width_in_millimetres'=>114, 'height_in_millimetres'=>162, 'width_in_inches'=>4.5, 'height_in_inches'=>6.4, ],
            ['id'=>30,'code'=>'C7', 'width_in_millimetres'=>81, 'height_in_millimetres'=>114, 'width_in_inches'=>3.2, 'height_in_inches'=>4.5, ],
            ['id'=>31,'code'=>'C8', 'width_in_millimetres'=>57, 'height_in_millimetres'=>81, 'width_in_inches'=>2.2, 'height_in_inches'=>3.2, ],
            ['id'=>32,'code'=>'C9', 'width_in_millimetres'=>40, 'height_in_millimetres'=>57, 'width_in_inches'=>1.6, 'height_in_inches'=>2.2, ],
            ['id'=>33,'code'=>'C10', 'width_in_millimetres'=>28, 'height_in_millimetres'=>40, 'width_in_inches'=>1.1, 'height_in_inches'=>1.6, ],
        ];

        return $dataSet;
    }


}
