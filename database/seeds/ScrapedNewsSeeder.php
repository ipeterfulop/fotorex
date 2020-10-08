<?php

namespace Database\Seeders;

use App\Article;
use App\Scrapers\NewsScraper;
use Illuminate\Database\Seeder;

class ScrapedNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serialized = base_path('database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.'news.json');
        if (file_exists($serialized)) {
            $articles = json_decode(file_get_contents($serialized), true);
        } else {
            $articles = NewsScraper::scrapeNews(2);
            file_put_contents($serialized, json_encode($articles));
        }
        $position = 1;
        foreach ($articles as $articleDataset) {
            $dataset = $articleDataset + [
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
            ];
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
