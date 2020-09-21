<?php

namespace App;

use App\Helpers\RentalPeriodUnit;
use App\Traits\hasIsEnabledProperty;
use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Rentaloption extends Model
{
    use hasIsEnabledProperty, VueCRUDManageable, canBeTurnedIntoKeyValueCollection;
    const SUBJECT_SLUG = 'rentaloption';
    const SUBJECT_NAME = 'Bérleti konstrukció';
    const SUBJECT_NAME_PLURAL = 'Bérleti konstrukciók';

    protected $fillable = [
        'full_operation_included',
        'min_number_of_persons',
        'max_number_of_persons',
        'number_of_pages_included',
        'rental_period_unit',
        'color_technology',
        'printing_included',
        'copying_included',
        'scanning_included',
        'description',
        'is_enabled',
    ];

    protected $appends = ['name'];

    public function getPeriodLabelAttribute()
    {
        return RentalPeriodUnit::getLabelForId($this->rental_period_unit);
    }

    public function getNameAttribute()
    {
        return implode(', ', [
            $this->period_label,
            $this->min_number_of_persons.'-'.$this->max_number_of_persons.' fő',
            $this->number_of_pages_included.' oldal',
            $this->capabilities_label
        ]);
    }

    public function getCapabilitiesLabelAttribute()
    {
        $result = [];
        if ($this->printing_included == 1) {
            $result[] = 'print';
        }
        if ($this->scanning_included == 1) {
            $result[] = 'scan';
        }
        if ($this->copying_included == 1) {
            $result[] = 'copy';
        }

        return implode('/', $result);
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'name' => 'Megnevezés',
            'description' => 'Leírás',
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

}