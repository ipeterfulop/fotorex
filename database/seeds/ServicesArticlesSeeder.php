<?php

namespace Database\Seeders;

use App\Article;
use App\Articlecategory;
use Illuminate\Database\Seeder;

class ServicesArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articlecategory = Articlecategory::where('custom_slug_base', '=', 'szolgaltatasok')->first();

        $dataset = [
            [
                'title' => 'Szervíz konstrukciók',
                'summary' => 'Szervíz-konstrukcióink bemutatása',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'szerviz-konstrukciok',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
            [
                'title' => 'Bérleti csomagok',
                'summary' => 'Bérleti csomagok bemutatása',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'berleti-csomagok',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
            [
                'title' => 'Szaktanácsadás',
                'summary' => 'Tanácsok szakértőinktől',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'szaktanacsadas',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
            [
                'title' => 'Házhozszállítás',
                'summary' => 'Mindent a házhozszállításról',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'hazhozszallitas',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
            [
                'title' => 'Környezetvédelem',
                'summary' => 'Környezetvédelmi tanácsaink',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'kornyezetvedelem',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
            [
                'title' => 'Letöltésközpont',
                'summary' => 'Driverek és kézikönyvek',
                'articlecategory_id' => $articlecategory->id,
                'slug' => 'letolteskozpont',
                'published_at' => now(),
                'is_published' => 1,
                'position' => 1,
            ],
        ];
        $assetBasepath = base_path('database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR);
        foreach ($dataset as $row) {
            $data = $row;

            $data['content'] = file_get_contents($assetBasepath.$row['slug'].'.html');
            if (file_exists($assetBasepath.$row['slug'].'.jpg')) {
                @mkdir(public_path(Article::IMAGES_PATH));
                copy(
                    $assetBasepath.$row['slug'].'.jpg',
                    public_path(Article::IMAGES_PATH.DIRECTORY_SEPARATOR.$row['slug'].'.jpg')
                );
                $data['index_image'] = $row['slug'].'.jpg';
            }
            $article = Article::findBySlug($row['slug'], false);
            if ($article == null) {
                Article::create($data);
            } else {
                $article->update($data);
            }
        }
        @mkdir(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'attachments'), 02777, true);
        foreach(scandir($assetBasepath.DIRECTORY_SEPARATOR.'articleassets') as $asset) {
            if (array_search(mb_substr($asset, -3, 3), ['png', 'jpg', 'gif']) !== false) {
                copy(
                    $assetBasepath.DIRECTORY_SEPARATOR.'articleassets'.DIRECTORY_SEPARATOR.$asset,
                    storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'attachments'.DIRECTORY_SEPARATOR.$asset)
                );
            }
        }
    }
}
