<?php

namespace Database\Seeders;

use App\Article;
use App\Articlecategory;
use Illuminate\Database\Seeder;

class PrivacyArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Articlecategory::findBySlug('adatvedelem-es-jog', false);
        if ($category == null) {
            $category = Articlecategory::create([
                'id' => 10,
                'position' => Articlecategory::max('position') + 1,
                'show_in_main_menu' => 0,
                'name' => 'Adatvédelem és jog',
                'custom_slug_base' => 'adatvedelem-es-jog',
                'articlecategory_id' => null
            ]);
        }
        $article = Article::updateOrCreate(['slug' => 'adatvedelem-es-jog'], [
            'articlecategory_id' => $category->id,
            'position' => 1,
            'title' => 'Adatvédelem és jog',
            'published_at' => now(),
            'summary' => 'Adatvédelemi Tájékoztató',
            'is_published' => 1,
            'content' => file_get_contents(database_path('seeds'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.'adatvedelem.html')),
        ]);
        $files = scandir(database_path('seeds'.DIRECTORY_SEPARATOR.'articles'));
        $target = public_path('images'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR);
        foreach($files as $file) {
            if (preg_match('/adatvedelem-\d\.png/', $file) === 1) {
                copy(
                    database_path('seeds'.DIRECTORY_SEPARATOR.'articles').DIRECTORY_SEPARATOR.$file,
                    $target.$file
                );
            }
        }
    }
}
