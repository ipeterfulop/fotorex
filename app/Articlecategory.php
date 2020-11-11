<?php

namespace App;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Articlecategory extends Model
{
    use canBeTurnedIntoKeyValueCollection;

    protected $fillable = [
        'id',
        'name',
        'position',
        'show_in_main_menu',
        'custom_slug_base',
        'icon_url',
        'photo_id',
        'articlecategory_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(
            'parents',
            function (Builder $builder) {
                return $builder->select('articlecategories.*', 'acjoin.parentslug', 'acjoin.parentname', 'acjoin.parentid')
                ->leftJoin(
                    \DB::raw(
                        '(select custom_slug_base as parentslug, name as parentname, id as parentid from articlecategories) acjoin'
                    ),
                    'acjoin.parentid',
                    '=',
                    'articlecategories.articlecategory_id'
                );
            }
        );
    }


    protected $with = ['subcategories'];

    public function subcategories()
    {
        return $this->hasMany(self::class)->orderBy('position', 'asc');
    }

    public static function findBySlug($slug, $abortWith404IfNotFound = true)
    {
        $result = self::where('custom_slug_base', '=', $slug)->first();
        if (($result === null) && ($abortWith404IfNotFound)) {
            abort(404);
        }

        return $result;
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('position', 'asc');
    }

    public function publishedarticles()
    {
        return $this->articles()
            ->where('is_published', '=', 1)
            ->where('published_at', '<=', now()->format('Y-m-d H:i:s'));
    }

    public static function postProcessKeyValueCollection($keyValueCollection)
    {
        $newResult = [0 => 'Nem adott'];

        return collect($newResult + $keyValueCollection->all());
    }

    public static function getAvailableCustomSlugBases()
    {
        return self::setEagerLoads([])
            ->select('custom_slug_base')
            ->distinct()
            ->get()
            ->pluck('custom_slug_base');
    }

    public function getUrlAttribute()
    {
        if ($this->parentslug != null) {
            return route('list_articles', ['categorySlug' => $this->parentslug, 'subcategorySlug' => $this->custom_slug_base]);
        }
        return route('list_articles', ['categorySlug' => $this->custom_slug_base]);
    }
}
