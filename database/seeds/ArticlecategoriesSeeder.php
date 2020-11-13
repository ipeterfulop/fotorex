<?php
namespace Database\Seeders;

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
                'id' => 1,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Hírek',
                'custom_slug_base' => 'hirek'
            ],
            [
                'id' => 2,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Cégünkről',
                'custom_slug_base' => 'cegunkrol'
            ],
            [
                'id' => 3,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Szolgáltatások',
                'custom_slug_base' => 'szolgaltatasok'
            ],
            [
                'id' => 4,
                'position' => $position++,
                'show_in_main_menu' => 1,
                'name' => 'Megoldások',
                'custom_slug_base' => 'megoldasok'
            ],
            [
                'id' => 5,
                'position' => $position++,
                'show_in_main_menu' => 0,
                'name' => 'Szaktanácsadás',
                'custom_slug_base' => 'szaktanacsadas'
            ],
            [
                'id' => 6,
                'position' => $position++,
                'show_in_main_menu' => 0,
                'name' => 'Biztonsági megoldások',
                'custom_slug_base' => 'biztonsagi-megoldasok',
                'articlecategory_id' => 4
            ],
            [
                'id' => 7,
                'position' => $position++,
                'show_in_main_menu' => 0,
                'name' => 'Költségszámlálás',
                'custom_slug_base' => 'koltsegszamlalas',
                'articlecategory_id' => 4
            ],
            [
                'id' => 8,
                'position' => $position++,
                'show_in_main_menu' => 0,
                'name' => 'Dokumentumkezelés',
                'custom_slug_base' => 'dokumentumkezeles',
                'articlecategory_id' => 4
            ],
            [
                'id' => 9,
                'position' => $position++,
                'show_in_main_menu' => 0,
                'name' => 'Cégünkről',
                'custom_slug_base' => 'cegismerteto',
                'articlecategory_id' => null
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
