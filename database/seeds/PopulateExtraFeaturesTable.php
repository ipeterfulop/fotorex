<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateExtraFeaturesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateExtraFeatures();
    }

    private function addOrUpdateExtraFeatures()
    {
        $dsExtraFeatures = [
            [ 'id' => 21, 'name' => 'BLI certificat', 'position' => '1', 'is_enabled' => 1, ],
            [ 'id' => 22, 'name' => 'WiFi', 'position' => '2', 'is_enabled' => 1, ],
            [ 'id' => 23, 'name' => 'Adobe', 'position' => '3', 'is_enabled' => 1, ],
            [ 'id' => 24, 'name' => 'SAP', 'position' => '4', 'is_enabled' => 1, ],
            [ 'id' => 25, 'name' => 'GoogleCloud', 'position' => '5', 'is_enabled' => 1, ],
            [ 'id' => 26, 'name' => 'Airprint', 'position' => '6', 'is_enabled' => 1, ],
            [ 'id' => 27, 'name' => 'OSA', 'position' => '7', 'is_enabled' => 1, ],
        ];

        $tableName = 'extra_features';
        foreach ($dsExtraFeatures as $row) {
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
