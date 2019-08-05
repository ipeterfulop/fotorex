<?php

namespace App;

use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use VueCRUDManageable;
    const SUBJECT_SLUG = 'manufacturer';
    const SUBJECT_NAME = 'Gyártó';
    const SUBJECT_NAME_PLURAL = 'Gyártók';

    protected $fillable = [
        'name',
        'position',
        'is_enabled',
        'url',
    ];

    protected $appends = [
        'name_label',
        'is_enabled_label',
    ];

    public function getNameLabelAttribute()
    {
        return $this->name;
    }

    public static function getIsEnabledOptions()
    {
        return [
            0 => 'Inaktív',
            1 => 'Aktív',
        ];
    }

    public function getIsEnabledLabel()
    {
        return self::getIsEnabledOptions()[$this->is_enabled];
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

}
