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
        $articles = NewsScraper::scrapeNews(2);
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
