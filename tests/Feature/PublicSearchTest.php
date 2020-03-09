<?php

namespace Tests\Feature;

use App\Articlecategory;
use App\Dataproviders\SearchDataprovider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $articleData = [
            1 => [
                'title' => 'Első',
                'summary' => 'Első',
                'content' => 'Első',
                'slug' => 'elso',
                'published_at' => now(),
                'is_published' => 1,
                'articlecategory_id' => 1,
                'position' => 1,
                ],
            2 => [
                'title' => 'Második',
                'summary' => 'Második első',
                'content' => 'Második',
                'slug' => 'masodik',
                'published_at' => now(),
                'is_published' => 1,
                'articlecategory_id' => 1,
                'position' => 2,
                ],
            3 => [
                'title' => 'Harmadik',
                'summary' => 'Harmadik',
                'content' => 'Harmadik',
                'slug' => 'harmadik',
                'published_at' => now(),
                'is_published' => 1,
                'articlecategory_id' => 1,
                'position' => 3,
                ],
            4 => [
                'title' => 'Negyedik',
                'summary' => 'Negyedik',
                'content' => 'Negyedik',
                'slug' => 'negyedik',
                'published_at' => now(),
                'is_published' => 1,
                'articlecategory_id' => 1,
                'position' => 4,
                ],
        ];
        foreach ($articleData as $id => $data) {
            \App\Article::create(array_merge(['id' => $id], $data));
        }
        $searchProvider = SearchDataprovider::createFromRequest(collect(['searchText' => 'Első']));
        $this->assertTrue($searchProvider->getResults()->articles->count() == 2);
        $searchProvider = SearchDataprovider::createFromRequest(collect(['searchText' => 'Ilyen tuti nincs']));
        $this->assertTrue($searchProvider->getResults()->articles->count() == 0);
    }
}
