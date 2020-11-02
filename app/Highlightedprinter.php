<?php

namespace App;

use App\Traits\belongsToPrinter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlightedprinter extends Model
{
    const SUBJECT_SLUG = 'highlightedprinter';
    const SUBJECT_NAME = 'Akciós ajánlat';
    const SUBJECT_NAME_PLURAL = 'Akciós ajánlatok';

    use VueCRUDManageable, hasPosition, belongsToPrinter;

    protected $fillable = [
        'printer_id',
        'position'
    ];

    protected $appends = ['name'];

    protected $with = ['printer'];

    public function getNameAttribute()
    {
        return $this->printer->displayname;
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'name' => 'Név'
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
}
