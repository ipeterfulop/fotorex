<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateTechnicalSpecificationCategoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateTechnicalSpecificationCategory();
    }

    private function addOrUpdateTechnicalSpecificationCategory()
    {
        $dsTechnicalSpecCatgories = [
            [ 'id' => 11, 'name' => 'Általános', 'position' => '1', 'is_enabled' => 1, ],
            [ 'id' => 12, 'name' => 'Másoló', 'position' => '2', 'is_enabled' => 1, ],
            [ 'id' => 13, 'name' => 'Nyomtató', 'position' => '3', 'is_enabled' => 1, ],
            [ 'id' => 14, 'name' => 'Szkenner', 'position' => '4', 'is_enabled' => 1, ],
            [ 'id' => 15, 'name' => 'Fax', 'position' => '5', 'is_enabled' => 1, ],
            [ 'id' => 16, 'name' => 'Lapadagoló', 'position' => '6', 'is_enabled' => 1, ],
            [ 'id' => 17, 'name' => 'Finishing', 'position' => '7', 'is_enabled' => 1, ],
            [ 'id' => 18, 'name' => 'Dokumentum tárolás', 'position' => '8', 'is_enabled' => 1, ],
        ];

        $tableName = 'technical_specification_categories';
        foreach ($dsTechnicalSpecCatgories as $row) {
            $itemsFound = DB::table($tableName)
                            ->where('id', $row['id'])
                            ->get()
                            ->count();
            if ($itemsFound > 0) {
                DB::table($tableName)->where('id', $row['id'])->update($row);
            } else {
                DB::table($tableName)->insert($row);
            }
        }
    }
}
