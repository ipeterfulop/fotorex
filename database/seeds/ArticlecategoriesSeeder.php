<?php

use Illuminate\Database\Seeder;

class ArticlecategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = 1;
        $dataset = [
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Hírek'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Cégünkről'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Szolgáltatások'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Megoldások'
            ],
        ];
        foreach ($dataset as $row) {
            \App\Articlecategory::updateOrCreate(
                ['id' => $row['id']],
                $row
            );
        }
    }
}
