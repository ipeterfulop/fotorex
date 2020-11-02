<?php

namespace App;

use App\Traits\belongsToPrinter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlightedbox extends Model
{
    const SUBJECT_SLUG = 'highlightedbox';
    const SUBJECT_NAME = 'Információs doboz';
    const SUBJECT_NAME_PLURAL = 'Információs dobozok';

    const IMAGES_PATH = '/highlights';

    use belongsToPrinter, VueCRUDManageable, hasPosition;

    protected $fillable = [
        'title',
        'subtitle',
        'article_id',
        'printer_id',
        'photo_id',
        'custom_photo_id',
        'position'
    ];

    protected $appends = [
        'targetname'
    ];

    protected $with = ['article', 'printer'];

    public function originalphoto()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'custom_photo_id');
    }

    public function getTargetnameAttribute()
    {
        if ($this->printer_id != null) {
            return $this->printer->displayname;
        }
        if ($this->article_id != null) {
            return $this->article->title;
        }

        return null;
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'title' => 'Cím',
            'subtitle' => 'Alcím',
            'targetname' => 'Hivatkozott elem'
        ];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [];
    }

    public function getVueCRUDDetailsFields()
    {
        return [];
    }

    public static function getVueCRUDIndexFilters()
    {
        return [];
    }

    public static function modifyModellistButtons($buttons)
    {
        unset($buttons['details']);

        return $buttons;
    }

    /**
     * @return array
     * this function returns a list of fields that are used as restrictions when changing position
     * for example if it returns ['role_id'], every non-static positioning function will
     * only look for elements with the same role_id as the subject
     */
    public static function getRestrictingFields()
    {
        return [];
    }

    public static function getVueCRUDAdditionalAjaxFunctions()
    {
        return ['storePublicPicture'];
    }

    public function getImageUrlAttribute()
    {
        return url('/storage'.self::IMAGES_PATH.'/'.$this->photo->name);
    }
}
