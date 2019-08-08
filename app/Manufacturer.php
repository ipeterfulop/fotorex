<?php

namespace App;

use App\Traits\hasFiles;
use App\Traits\hasIsEnabledProperty;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty, hasPosition, hasFiles;
    const SUBJECT_SLUG = 'manufacturer';
    const SUBJECT_NAME = 'Gyártó';
    const SUBJECT_NAME_PLURAL = 'Gyártók';
    const FILE_PUBLIC_PATH = 'gyartok';

    protected $fillable = [
        'name',
        'position',
        'is_enabled',
        'url',
        'logo_photo_id',
    ];

    protected $appends = [
        'name_label',
        'is_enabled_label',
    ];

    protected $with = ['logo'];

    public function logo()
    {
        return $this->hasOne(
            Photo::class,
            'id',
            'logo_photo_id'
        );
    }

    public function getNameLabelAttribute()
    {
        return $this->name;
    }

    public function getLogoUrlAttribute()
    {
        return ($this->logo !== null ? $this->logo->file->public_url : '');
    }

    public static function getIsEnabledOptions()
    {
        return [
            0 => 'Inaktív',
            1 => 'Aktív',
        ];
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'name_label' => 'Név',
            'is_enabled_label' => 'Státusz',
        ];
    }

    public function getVueCRUDDetailsFields()
    {
        return [];
    }

    public static function getVueCRUDIndexFilters()
    {
        $result = [];
        $result['name'] = new TextVueCRUDIndexfilter('name', 'Név', '');
        $result['is_enabled'] = new SelectVueCRUDIndexfilter('is_enabled', 'Státusz', 1, 1);
        $result['is_enabled']->setValueSet(self::getIsEnabledOptions());

        return $result;
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'name_label' => 'name',
        ];
    }

    public static function getVueCRUDModellistButtons()
    {
        return [
            'edit' => self::buildButtonFromConfigData('vuecrud.buttons.edit'),
        ];
    }

    public static function getRestrictingFields()
    {
        return ["is_enabled" => 1];
    }
}
