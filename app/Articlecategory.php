<?php

namespace App;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Illuminate\Database\Eloquent\Model;

class Articlecategory extends Model
{
    use canBeTurnedIntoKeyValueCollection;

    protected $fillable = [
        'id',
        'name',
        'position',
        'show_in_main_menu',
        'custom_slug_base'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('position', 'asc');
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
}
