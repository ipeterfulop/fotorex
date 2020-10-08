<?php

namespace App;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use VueCRUDManageable, canBeTurnedIntoKeyValueCollection;

    const SUBJECT_SLUG = 'slider';
    const SUBJECT_NAME = 'Slider';
    const SUBJECT_NAME_PLURAL = 'Sliderek';

    protected $fillable = [
        'name',
        'slide_display_duration',
        'slide_pagination_duration',
    ];

    protected $appends = [
        'slides_label',
    ];

    protected $with = ['slides'];

    public function slides()
    {
        return $this->hasMany(Slide::class)->orderBy('position', 'asc');
    }

    public function getSlidesLabelAttribute()
    {
        return '<a class="underline py-2 hover:bg-transparent text-blue-400" href="'
            .route('vuecrud_slide_index', ['slider_id' => $this->id])
            .'">Diák kezelése</a>';
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'name' => 'Név',
            'slides_label' => 'Diák',
        ];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return ['name' => 'name'];
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
        unset($buttons['delete']);

        return $buttons;
    }

    public function scopeForLocale($query, $localeId = null)
    {
        $localeId = $localeId ?? \App::getLocale();

        return $query->where('locale_id', '=', $localeId);
    }

    public static function shouldVueCRUDAddButtonBeDisplayed()
    {
        return false;
    }

    public static function getForFrontpage()
    {
        return self::first();
    }
}
