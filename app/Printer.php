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

    const RELATIONTYPE_SIMILAR = 1;
    const RELATIONTYPE_VIEWED_BY_OTHERS = 2;

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
        'price',
        'request_for_price',
    ];

    protected $appends = [
        'manufacturer_name',
        'is_enabled_label',
        'similar_printers_button',
        'printers_viewed_by_others_button',
    ];

    protected $with = ['manufacturer', 'printer_photos', 'technical_specifications'];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function similarprinters()
    {
        return $this->hasMany(SimilarPrinter::class)
            ->where('relationtype', '=', self::RELATIONTYPE_SIMILAR)
            ->orderBy('position', 'asc');
    }

    public function printersviewedbyothers()
    {
        return $this->hasMany(SimilarPrinter::class)
            ->where('relationtype', '=', self::RELATIONTYPE_VIEWED_BY_OTHERS)
            ->orderBy('position', 'asc');
    }

    public function printer_photos()
    {
        return $this->hasMany(PrinterPhoto::class, 'printer_id', 'id')->orderBy('position', 'asc');
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

    public function papersize()
    {
        return $this->hasOneThrough(
            Papersize::class,
            PrinterPapersize::class,
            'printer_id',
            'id',
            'id',
            'papersize_id'
        );
    }

    public function technical_specifications()
    {
        return $this->hasMany(PrinterTechnicalSpecificationCategory::class, 'printer_id', 'id');
    }

    public function syncPhotos(array $photoIds)
    {
        $created = new Collection();
        \DB::transaction(function() use ($photoIds, &$created) {
            foreach (PrinterPhoto::getRemovablePhotos($this->id, $photoIds) as $du) {
                PrinterPhoto::removePrinterPhoto($du->pp_id);
            }
            foreach (array_values($photoIds) as $index => $photoId) {
                $du = PrinterPhoto::firstOrCreateWithCustomizedPrinterPhoto($this->id, $photoId, $index + 1);
                if ($du->wasRecentlyCreated) {
                    $created->push($du);
                }
            }
        });

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
            'similar_printers_button' => 'Hasonló termékek',
            'printers_viewed_by_others_button' => 'Mások által megtekintett termékek',

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

    public static function getVueCRUDAdditionalAjaxFunctions()
    {
        return ['storePublicPicture'];
    }


    public static function findBySlug($slug, $abortWith404IfNotFound = true)
    {
        $result = self::where('slug', '=', $slug)->with([
            'manufacturer',
            'printer_photos',
            'technical_specifications',
            'similarprinters',
            'similarprinters.similarprinter',
            'printersviewedbyothers',
            'printersviewedbyothers.similarprinter',
        ])->first();

        if (($result == null) && ($abortWith404IfNotFound)) {
            abort(404);
        }

        return $result;
    }

    public static function similarRelations()
    {
        return [
            self::RELATIONTYPE_SIMILAR => 'similarprinters',
            self::RELATIONTYPE_VIEWED_BY_OTHERS => 'printersviewedbyothers'
        ];
    }

    public function syncSimilarPrinters($ids, $relationtype)
    {
        return \DB::transaction(function() use ($ids, $relationtype) {
            $accessor = self::similarRelations()[$relationtype];
            $this->$accessor()->delete();
            $position = 0;
            foreach ($ids as $id) {
                SimilarPrinter::create([
                    'printer_id' => $this->id,
                    'similar_printer_id' => $id,
                    'position' => ++$position,
                    'relationtype' => $relationtype
                ]);
            }
        }) === null;
    }

    public function getSimilarPrintersButtonAttribute()
    {
        return 'component::'.json_encode([
                'component' => 'related-printers-popup-button',
                'componentProps' => [
                    'operationsUrl' => route('related_printer_endpoint'),
                    'printerId' => $this->id,
                    'relationType' => self::RELATIONTYPE_SIMILAR
                ]
            ]);
    }

    public function getPrintersViewedByOthersButtonAttribute()
    {
        return 'component::'.json_encode([
                'component' => 'related-printers-popup-button',
                'componentProps' => [
                    'operationsUrl' => route('related_printer_endpoint'),
                    'printerId' => $this->id,
                    'relationType' => self::RELATIONTYPE_VIEWED_BY_OTHERS
                ]
            ]);
    }

    public function mainPhotoUrl()
    {
        return optional(optional($this->printer_photos->first())->original)->public_url;
    }

    public function mainPhotoThumbnailUrl()
    {
        return optional(optional($this->printer_photos->first())->thumbnail)->public_url;
    }
}
