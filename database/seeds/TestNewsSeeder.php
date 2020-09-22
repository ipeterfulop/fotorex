<?php
namespace Database\Seeders;

use App\Article;
use Illuminate\Database\Seeder;

class TestNewsSeeder extends Seeder
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
                'title' => 'Cikk 1',
                'summary' => 'Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget nisi felis. Praesent eget pulvinar tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit. Quisque at tincidunt magna, sit amet dictum magna. Suspendisse potenti. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dapibus tellus ut nibh hendrerit vulputate. Nam porttitor tincidunt arcu. Duis suscipit elit sit amet ex pharetra auctor. In ornare magna quis finibus pulvinar. Praesent nibh leo, pulvinar a tellus eu, vulputate dapibus eros. Proin at arcu a nisi maximus semper.',
                'slug' => 'cikk_1',
                'published_at' => now()->subDay(),
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
                'index_image' => '/storage/attachments/1.png'
            ],
            [
                'title' => 'Cikk 2',
                'summary' => 'Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget nisi felis. Praesent eget pulvinar tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit. Quisque at tincidunt magna, sit amet dictum magna. Suspendisse potenti. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dapibus tellus ut nibh hendrerit vulputate. Nam porttitor tincidunt arcu. Duis suscipit elit sit amet ex pharetra auctor. In ornare magna quis finibus pulvinar. Praesent nibh leo, pulvinar a tellus eu, vulputate dapibus eros. Proin at arcu a nisi maximus semper.',
                'slug' => 'cikk_2',
                'published_at' => now()->subDay(),
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
                'index_image' => '/storage/attachments/1.png'
            ],
            [
                'title' => 'Cikk '.$position,
                'summary' => 'Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget nisi felis. Praesent eget pulvinar tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit. Quisque at tincidunt magna, sit amet dictum magna. Suspendisse potenti. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dapibus tellus ut nibh hendrerit vulputate. Nam porttitor tincidunt arcu. Duis suscipit elit sit amet ex pharetra auctor. In ornare magna quis finibus pulvinar. Praesent nibh leo, pulvinar a tellus eu, vulputate dapibus eros. Proin at arcu a nisi maximus semper.',
                'slug' => 'cikk_'.$position,
                'published_at' => now()->subDay(),
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
                'index_image' => '/storage/attachments/1.png'
            ],
            [
                'title' => 'Cikk '.$position,
                'summary' => 'Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget nisi felis. Praesent eget pulvinar tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit. Quisque at tincidunt magna, sit amet dictum magna. Suspendisse potenti. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dapibus tellus ut nibh hendrerit vulputate. Nam porttitor tincidunt arcu. Duis suscipit elit sit amet ex pharetra auctor. In ornare magna quis finibus pulvinar. Praesent nibh leo, pulvinar a tellus eu, vulputate dapibus eros. Proin at arcu a nisi maximus semper.',
                'slug' => 'cikk_'.$position,
                'published_at' => now()->subDay(),
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
                'index_image' => '/storage/attachments/1.png'
            ],
            [
                'title' => 'Cikk '.$position,
                'summary' => 'Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget nisi felis. Praesent eget pulvinar tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio urna, egestas vitae dolor id, hendrerit aliquet tortor. Phasellus in purus aliquam, ullamcorper elit maximus, malesuada velit. Quisque at tincidunt magna, sit amet dictum magna. Suspendisse potenti. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dapibus tellus ut nibh hendrerit vulputate. Nam porttitor tincidunt arcu. Duis suscipit elit sit amet ex pharetra auctor. In ornare magna quis finibus pulvinar. Praesent nibh leo, pulvinar a tellus eu, vulputate dapibus eros. Proin at arcu a nisi maximus semper.',
                'slug' => 'cikk_'.$position,
                'published_at' => now()->subDay(),
                'articlecategory_id' => 1,
                'position' => $position++,
                'is_published' => 1,
                'index_image' => '/storage/attachments/1.png'
            ],
        ];
        \DB::table('articles')->where('articlecategory_id', '=', 1)->delete();
        foreach ($dataset as $row) {
            Article::create($row);
        }

    }
}
