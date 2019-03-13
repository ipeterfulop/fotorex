<?php

namespace App;

use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use VueCRUDManageable;
    const SUBJECT_SLUG = 'article';
    const SLUG_BASE = '/cikk/';

    const ITEMS_PER_INDEX_PAGE = 10;

    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'published_at',
        'index_image'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    public static function findBySlug($slug, $abortWith404IfNotFound = true)
    {
        $result = self::where('slug', '=', $slug)->first();
        if (($result === null) && ($abortWith404IfNotFound)) {
            abort(404);
        }

        return $result;
    }

    public function getUrlAttribute()
    {
        return url(self::SLUG_BASE.$this->slug);
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'title' => 'Cím',
            'url' => 'URL',
            'summary' => 'Összefoglaló',
        ];
    }

    public function getVueCRUDDetailsFields()
    {
        return [
            'title' => 'Cím',
            'url' => 'URL',
            'summary' => 'Összefoglaló',
            'content' => 'Tartalom'
        ];
    }

    public static function getVueCRUDIndexFilters()
    {
        $result = [];
        $result[] = new TextVueCRUDIndexfilter(['title', 'summary', 'content'], 'Keresés...', '');

        return $result;
    }

    public static function getArticlesForPublicIndex($page = 1)
    {
        return self::where('published_at', '!=', null)
            ->where('published_at', '<=', now()->format('Y-m-d H:i:s'))
            ->orderBy('published_at', 'desc')
            ->skip(($page - 1) * self::ITEMS_PER_INDEX_PAGE)
            ->take(self::ITEMS_PER_INDEX_PAGE)
            ->get();
    }
}
