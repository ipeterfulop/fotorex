<?php

namespace App;

use App\Traits\hasIsEnabledProperty;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class TechnicalSpecificationCategory extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty;
    protected $fillable = [
        'name',
        'position',
    ];

    public static function getVueCRUDIndexColumns()
    {
        return [];
    }

    public static function getVueCRUDDetailsFields()
    {
        return [];
    }

    public static function getVueCRUDIndexFilters()
    {
        return [];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [];
    }

}
