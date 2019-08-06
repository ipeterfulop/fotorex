<?php

namespace App;

use App\Traits\hasIsEnabledProperty;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class ExtraFeature extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty, hasPosition;
    const SUBJECT_SLUG = 'extrafeature';
    const SUBJECT_NAME = 'Speciális funkció';
    const SUBJECT_NAME_PLURAL = 'Speciális funkciók';

    protected $fillable = [
        'name',
        'description',
        'position',
        'is_enabled',
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
