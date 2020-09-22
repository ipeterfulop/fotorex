<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulatePrinterPhotoRoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdatePrinterPhotoRole();
    }

    private function addOrUpdatePrinterPhotoRole()
    {
        $dsPrinterPhotoRoles = [
          [
            'id' => 1,
            'name' => 'Termékkép',
            'preferred_width' => 1200,
            'preferred_height' => 800,
          ],
          [
              'id' => 2,
              'name' => 'Nagy bélyegkép',
              'preferred_width' => 240,
              'preferred_height' => 160,
          ],
          [
              'id' => 3,
              'name' => 'Kis bélyegkép',
              'preferred_width' => 120,
              'preferred_height' => 80,
          ],
        ];

        $tableName = 'printer_photo_roles';
        foreach ($dsPrinterPhotoRoles as $row) {
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
