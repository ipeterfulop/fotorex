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
                'name' => 'Hírek',
                'custom_slug_base' => 'hirek'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Cégünkről',
                'custom_slug_base' => 'cegunkrol'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Szolgáltatások',
                'custom_slug_base' => 'szolgaltatasok'
            ],
            [
                'id' => $position,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Megoldások',
                'custom_slug_base' => 'megoldasok'
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
