<?php

namespace App;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Illuminate\Database\Eloquent\Model;

class Articlecategory extends Model
{
    use canBeTurnedIntoKeyValueCollection;

    protected $fillable = ['id', 'name', 'position', 'show_in_main_menu'];

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('position', 'asc');
    }

    public static function postProcessKeyValueCollection($keyValueCollection)
    {
        $newResult = [0 => 'Nem adott'];

        return collect($newResult + $keyValueCollection->all());
    }
}
