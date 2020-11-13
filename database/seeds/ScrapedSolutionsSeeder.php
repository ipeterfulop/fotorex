<?php

namespace Database\Seeders;

use App\Article;
use App\Articlecategory;
use App\Scrapers\NewsScraper;
use Illuminate\Database\Seeder;

class ScrapedSolutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serialized = base_path('database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.'solutions.json');
        $category = Articlecategory::findBySlug('megoldasok', false);
        if (file_exists($serialized)) {
            $articles = json_decode(file_get_contents($serialized), true);
        } else {
            die('ez a szett kézzel lett összerakva, kell a fájl');
        }
        $position = 1;
        foreach ($articles as $articleDataset) {
            $dataset = $articleDataset + [
                    'articlecategory_id' => Articlecategory::findBySlug($articleDataset['categoryslug'])->id,
                    'position' => $position++,
                    'is_published' => 1,
                ];
            unset($dataset['categoryslug']);
            $dataset['content'] = str_ireplace('/images/stories', Article::IMAGES_PATH, $dataset['content']);
            if ($dataset['index_image'] != null) {
                $target = public_path('images'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.basename($dataset['index_image']));
                @mkdir(dirname($target), 02777, true);
                if (!file_exists($target)) {
                    $imageContent = file_get_contents($dataset['index_image']);
                    file_put_contents($target, $imageContent);
                }
                $dataset['index_image'] = basename($dataset['index_image']);
            }
            $article = Article::findBySlug($dataset['slug'], false, false);
            if ($article == null) {
                $article = Article::create($dataset);
            } else {
                $article->update($dataset);
            }
        }

    }
}
