<?php

namespace Database\Seeders;

use App\Article;
use App\Highlightedbox;
use App\Photo;
use App\Printer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TestHighlightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('hu');
        Highlightedbox::where('title', '=', 'Tesztelési célú cím')->delete();
        for ($t = 1; $t <= 7; $t++) {
            $random = random_int(0,1);
            $dataset = [
                'title' => 'Tesztelési célú cím',
                'subtitle' => $faker->text(45),
                'article_id' => $random == 0 ? Article::inRandomOrder()->first()->id : null,
                'printer_id' => $random == 1 ? Printer::inRandomOrder()->first()->id : null,
                'custom_photo_id' => random_int(0,2) == 1 ? Photo::inRandomOrder()->first()->id : null,
                'position' => $t
            ];
            Highlightedbox::create($dataset);
        }
    }
}
