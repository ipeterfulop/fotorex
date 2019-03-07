<?php

namespace App;

use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use VueCRUDManageable;
    const SUBJECT_SLUG = 'article';
    const SLUG_BASE = '/cikkek/';

    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'published_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

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
}
