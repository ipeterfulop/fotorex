<?php

namespace App;

use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\hasIsEnabledProperty;

class PrinterTechnicalSpecificationCategory extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty;

    protected $table = 'printer_technical_specification_category';

    protected $fillable = [
        'printer_id',
        'technical_specification_category_id',
        'html_content',
        'is_enabled',
    ];

    protected $with = ['technical_specification_category'];

    public function technical_specification_category()
    {
        return $this->belongsTo(TechnicalSpecificationCategory::class);
    }

    public static function removePrinterTechnicalSpecificationCategory($printer_id, $technical_specification_category_id) {
        $p = self::where([['printer_id', '=', $printer_id], ['technical_specification_category_id', '=', $technical_specification_category_id]]);
        $p->delete();
    }

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
