<?php

namespace App;

use App\Traits\hasFiles;
use App\Traits\hasIsEnabledProperty;
use App\Traits\HasSortingOptions;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Printer extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty, hasFiles, HasSortingOptions;
    const SUBJECT_SLUG = 'printer';
    const SUBJECT_NAME = 'Termék';
    const SUBJECT_NAME_PLURAL = 'Termékek';
    const FILE_PUBLIC_PATH = 'termekek';

    const SORTING_OPTION_PRICE_UP = 'ar_novekvo';
    const SORTING_OPTION_PRICE_DOWN = 'ar_csokkeno';

    protected $fillable = [
        'manufacturer_id',
        'name',
        'usergroup_size_id',
        'color_technology',
        'is_multifunctional',
        'description',
        'slug',
        'html_page_title',
        'html_page_meta_description',
        'printing_mode',
        'copying_mode',
        'scanning_mode',
        'is_enabled',
    ];

    protected $appends = [
        'manufacturer_name',
        'is_enabled_label',
    ];

    protected $with = ['manufacturer', 'printer_photos', 'technical_specifications'];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function printer_photos()
    {
        return $this->hasMany(PrinterPhoto::class, 'printer_id', 'id');
    }

    public function customized_printer_photos()
    {
        return $this->hasManyThrough(
            CustomizedPrinterPhoto::class,
            PrinterPhoto::class,
            'printer_id',
            'printer_photo_id',
            'id',
            'id'
        )->where('printer_photo_role_id', '=', PrinterPhotoRole::ORIGINAL_ID);
    }

    public function technical_specifications()
    {
        return $this->hasMany(PrinterTechnicalSpecificationCategory::class, 'printer_id', 'id');
    }

    public function syncPhotos(array $photoIds)
    {
        $created = new Collection();
        foreach (PrinterPhoto::getRemovablePhotos($this->id, $photoIds) as $du) {
            PrinterPhoto::removePrinterPhoto($du->pp_id);
        }
        foreach ($photoIds as $photoId) {
            $du = PrinterPhoto::firstOrCreateWithCustomizedPrinterPhoto($this->id, $photoId);
            if ($du->wasRecentlyCreated) {
                $created->push($du);
            }
        }

        return $created;
    }

    public function syncTechnicalSpecifications(array $tscs)
    {
        foreach ($tscs as $tsc_id => $tsc_value) {
            if ($tsc_value === null) {
                PrinterTechnicalSpecificationCategory::removePrinterTechnicalSpecificationCategory($this->id, $tsc_id);
            }
            else {
                PrinterTechnicalSpecificationCategory::updateOrCreate(['printer_id' => $this->id, 'technical_specification_category_id' => $tsc_id], ['html_content' => $tsc_value]);
            }
        }
        return true;
    }

    public function getManufacturerNameAttribute()
    {
        return $this->manufacturer->name;
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'name' => 'Név',
            'manufacturer_name' => 'Gyártó',
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
        $result['manufacturer_id'] = new SelectVueCRUDIndexfilter('manufacturer_id', 'Gyártó', -1, -1);
        $result['manufacturer_id']->setValueSet(Manufacturer::orderBy('name', 'asc')->get()->pluck('name', 'id'), -1, 'Összes');
        $result['is_enabled'] = new SelectVueCRUDIndexfilter('is_enabled', 'Státusz', 1, 1);
        $result['is_enabled']->setValueSet(self::getIsEnabledOptions());

        return $result;
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'name' => 'name',
        ];
    }

    public static function getVueCRUDModellistButtons()
    {
        return [
            'edit' => self::buildButtonFromConfigData('vuecrud.buttons.edit'),
        ];
    }

    public static function getSortingOptionsArray()
    {
        return [
            self::SORTING_OPTION_PRICE_UP => 'Ár szerint növekvő',
            self::SORTING_OPTION_PRICE_DOWN => 'Ár szerint csökkenő',
        ];
    }

}
