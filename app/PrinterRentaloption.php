<?php

namespace App;

use App\Dataproviders\PrinterPickerVueCRUDIndexfilter;
use App\Helpers\PriceFormatter;
use App\Traits\belongsToPrinter;
use App\Traits\hasIsEnabledProperty;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class PrinterRentaloption extends Model
{
    use belongsToPrinter, hasIsEnabledProperty, VueCRUDManageable;
    const SUBJECT_SLUG = 'printerrentaloption';
    const SUBJECT_NAME = 'Nyomtatóbérlés';
    const SUBJECT_NAME_PLURAL = 'Nyomtatóbérlések';

    protected $table = 'printer_rentaloption';

    protected $fillable = [
        'printer_id',
        'rentaloption_id',
        'price',
        'extra_page_price',
        'extra_description',
        'is_enabled',
    ];

    protected $with = [
        'printer',
        'rentaloption',
    ];

    protected $appends = [
        'printer_label',
        'rentaloption_label',
        'is_enabled_label',
        'extra_page_price_label',
        'price_label',
    ];

    public function getPrinterLabelAttribute()
    {
        return $this->printer->name;
    }

    public function getRentaloptionLabelAttribute()
    {
        return $this->rentaloption->name;
    }

    public function getPriceLabelAttribute()
    {
        return $this->price === null ? 'N/A' : PriceFormatter::formatToInteger($this->price);
    }

    public function getExtraPagePriceLabelAttribute()
    {
        return PriceFormatter::formatToFloat($this->extra_page_price);
    }

    public function rentaloption()
    {
        return $this->belongsTo(Rentaloption::class);
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'is_enabled_label' => 'Publikus',
            'printer_label' => 'Nyomtató',
            'rentaloption_label' => 'Konstrukció',
            'price_label' => 'Ár',
            'extra_page_price_label' => 'Ft / extra oldal',
        ];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [];
    }

    public function getVueCRUDDetailsFields()
    {
        return [
            'is_enabled_label' => 'Publikus',
            'printer_label' => 'Nyomtató',
            'rentaloption_label' => 'Konstrukció',
            'price_label' => 'Ár',
            'extra_page_price_label' => 'Ft / extra oldal',
            'description' => 'Leírás',
        ];
    }

    public static function getVueCRUDIndexFilters()
    {
        $result = [];
        $result['printer_id'] = (new PrinterPickerVueCRUDIndexfilter('printer_id', 'Készülék', -1));
        $result['printer_id']->setContainerClass('col-7');
        $result['rentaloption_id'] = (new SelectVueCRUDIndexfilter('rentaloption_id', 'Konstrukció', -1, -1));
        $result['rentaloption_id']->setContainerClass('col-5');
        $result['rentaloption_id']->setValueSet(
            Rentaloption::enabled()->get()->pluck('name', 'id'),
            -1,
            'Mind'
        );
        return $result;
    }
}
