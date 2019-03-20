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
        $dataset = [
            [
                'id' => 1,
                'name' => 'Hírek'
            ],
            [
                'id' => 2,
                'name' => 'Cégünkről'
            ],
            [
                'id' => 3,
                'name' => 'Szolgáltatások'
            ],
            [
                'id' => 4,
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
