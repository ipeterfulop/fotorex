<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateUsergroupSizesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateUsergroupSizes();
    }

    private function addOrUpdateUsergroupSizes()
    {
        $dsUsergroupSizes = [
            [ 'id' => 11, 'name' => 'Egyéni', 'position' => '1', 'is_enabled' => 1, ],
            [ 'id' => 12, 'name' => 'Kis munkacsoportos', 'position' => '2', 'is_enabled' => 1, ],
            [ 'id' => 13, 'name' => 'Közepes munkacsoportos', 'position' => '3', 'is_enabled' => 1, ],
            [ 'id' => 14, 'name' => 'Nagy munkacsoportos', 'position' => '4', 'is_enabled' => 1, ],
        ];

        $tableName = 'usergroup_sizes';
        foreach ($dsUsergroupSizes as $row) {
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
