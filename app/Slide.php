<?php

namespace App;

use App\Helpers\ReadOnlyVueCRUDIndexFilter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use VueCRUDManageable, hasPosition;

    const SUBJECT_SLUG = 'slide';
    const SUBJECT_NAME = 'Dia';
    const SUBJECT_NAME_PLURAL = 'Diák';

    const PHOTO_URL_BASE = '/images/slides/';

    protected $fillable = [
        'slider_id',
        'url',
        'image',
        'open_in',
        'position'
    ];

    protected $appends = [
        'url_label',
        'image_label'
    ];

    public function getImageUrlAttribute()
    {
        return url(self::PHOTO_URL_BASE.'/'.$this->image);
    }

    public function getUrlLabelAttribute()
    {
        return '<span style="max-width: 25rem; word-break: break-word; white-space: normal"><a target="_blank" href="'
            .$this->url
            .'">'
            .$this->url
            .'</a></span>';
    }

    public function getImageLabelAttribute()
    {
        return '<img style="width: 10rem" src="'
            .$this->image_url
            .'">';
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'image_label' => 'Kép',
            'url_label' => 'URL'
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
        $result = [];
        if (request()->has('slider_id')) {
            $result['slider_id'] = new ReadOnlyVueCRUDIndexFilter(
                'slider_id',
                'Slider: '.Slider::find(request()->get('slider_id'))->name,
                -1
            );
        }

        return $result;
    }

    /**
     * @return array
     * this function returns a list of fields that are used as restrictions when changing position
     * for example if it returns ['role_id'], every non-static positioning function will
     * only look for elements with the same role_id as the subject
     */
    public static function getRestrictingFields()
    {
        return ['slider_id'];
    }


    public static function getVueCRUDAdditionalAjaxFunctions()
    {
        return [
            'storePublicPicture',
            'removePublicPicture'
        ];
    }

    public static function modifyModellistButtons($buttons)
    {
        unset($buttons['details']);

        return $buttons;
    }
}
