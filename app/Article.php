<?php

namespace App;

use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use VueCRUDManageable, hasPosition;
    const SUBJECT_SLUG = 'article';
    const SLUG_BASE = 'cikk';

    const SORTING_OPTION_LATEST = 'friss';
    const SORTING_OPTION_POPULAR = 'nepszeru';


    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'published_at',
        'index_image',
        'articlecategory_id',
        'position',
        'is_published'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    protected $appends = [
        'url',
        'published_at_label'
    ];

    public function articlecategory()
    {
        return $this->belongsTo(Articlecategory::class);
    }

    public function oldarticleslugs()
    {
        return $this->hasMany(Oldarticleslug::class);
    }

    public static function findBySlug($slug, $abortWith404IfNotFound = true)
    {
        $result = self::where('slug', '=', $slug)->first();
        if ($result == null) {
            $result = optional(Oldarticleslug::with('article')->where('slug', '=', $slug)->first())->article;
        }
        if (($result === null) && ($abortWith404IfNotFound)) {
            abort(404);
        }

        return $result;
    }

    public function getUrlAttribute()
    {
        $slugBase = null;
        if ($this->articlecategory_id != null) {
            $slugBase = $this->articlecategory->custom_slug_base;
        }
        if ($slugBase == null) {
            $slugBase = self::SLUG_BASE;
        }

        return url('/'.$slugBase.'/'.$this->slug);
    }

    public function getPublishedAtLabelAttribute()
    {
        return $this->published_at->format('Y-m-d H:i:s');
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'title' => 'Cím',
            'url' => 'URL',
            'summary' => 'Összefoglaló',
            'published_at_label' => 'Publikálva'
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
        $result[SelectVueCRUDIndexfilter::buildPropertyName('articlecategory_id')] = new SelectVueCRUDIndexfilter('articlecategory_id', 'Kategória', -1, -1);
        $result[SelectVueCRUDIndexfilter::buildPropertyName('articlecategory_id')]->setValueSet([-1 => 'Mind'] + Articlecategory::getKeyValueCollection()->all());
        $result[TextVueCRUDIndexfilter::buildPropertyName(['title', 'summary', 'content'])] = new TextVueCRUDIndexfilter(['title', 'summary', 'content'], 'Keresés...', '');

        return $result;
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'title' => 'title',
            'url' => 'slug',
            'published_at_label' => 'published_at'
        ];
    }

    /**
     * @return array
     * this function returns a list of fields that are used as restrictions when changing position
     * for example if it returns ['role_id'], every non-static positioning function will
     * only look for elements with the same role_id as the subject
     */
    public static function getRestrictingFields()
    {
        return ['articlecategory_id'];
    }

    public static function getSortingOptionsArray()
    {
        return [
            self::SORTING_OPTION_LATEST,
            self::SORTING_OPTION_POPULAR
        ];
    }

    public static function validateSortingOption($option, $abortWith404IfNotFound = true)
    {
        if (array_search($option, self::getSortingOptionsArray()) !== false) {
            return true;
        }
        if ($abortWith404IfNotFound) {
            abort(404);
        }

        return false;

    }
}
