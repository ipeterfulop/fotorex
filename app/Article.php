<?php

namespace App;

use App\Traits\HasSortingOptions;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use VueCRUDManageable, hasPosition, HasSortingOptions;
    const SUBJECT_SLUG = 'article';
    const SLUG_BASE = 'cikk';
    const SUBJECT_NAME = 'Cikk';
    const SUBJECT_NAME_PLURAL = 'Cikkek';
    const SORTING_OPTION_LATEST = 'friss';
    const SORTING_OPTION_POPULAR = 'nepszeru';
    const IMAGES_PATH = '/images/articles';

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

    protected $with = ['articlecategory'];

    public function articlecategory()
    {
        return $this->belongsTo(Articlecategory::class);
    }

    public function oldarticleslugs()
    {
        return $this->hasMany(Oldslug::class);
    }

    public static function findBySlug($slug, $abortWith404IfNotFound = true, $checkOldSlugs = true)
    {
        $result = self::where('slug', '=', $slug)->first();
        if (($result == null) && ($checkOldSlugs)) {
            $resultRedirect = Oldslug::where('slug', '=', $slug)->first();
            if ($resultRedirect != null) {
                $result = Article::find($resultRedirect->redirect_to);
            }
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
            $slugBase = $this->articlecategory->parentslug == null
                ? $this->articlecategory->custom_slug_base
                : $this->articlecategory->parentslug.'/'.$this->articlecategory->custom_slug_base;
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
            self::SORTING_OPTION_LATEST => 'Legfrissebb elöl',
            self::SORTING_OPTION_POPULAR => 'Legnépszerűbb elöl'
        ];
    }

    public function scopePublished($query, $date = null)
    {
        $date = $date ?? now();

        return $query->where('published_at', '<=', $date->format('Y-m-d H:i:s'))
            ->where('is_published', '=', 1);
    }

    public function scopeTextSearch($query, $searchText)
    {
        if ($searchText == null) {
            return $query;
        }
        return $query->where(function($query) use ($searchText) {
            return $query->where('title', 'like', "%$searchText%")
                ->orWhere('summary', 'like', "%$searchText%")
                ->orWhere('content', 'like', "%$searchText%");
        });
    }

    public static function getForSearchableSelect()
    {
        return self::published()->get()->sortBy('title')->map(function($item) {
            return ['id' => $item->id, 'name' => $item->title];
        })->values()->all();
    }

}
