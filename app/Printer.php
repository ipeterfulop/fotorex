<?php

namespace App;

use App\Helpers\PriceFormatter;
use App\Scopes\PrinterWithAttributesScope;
use App\Traits\hasFiles;
use App\Traits\hasIsEnabledProperty;
use App\Traits\HasSortingOptions;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Builder;
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
        'max_papersize',
        'color_management'
    ];

    protected $with = [
        'manufacturer',
        'printer_photos',
        'technical_specifications',
        'usergroupsize',
        'printerattributes',
        'papersizes',
    ];

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

    public function usergroupsize()
    {
        return $this->belongsTo(UsergroupSize::class, 'usergroup_size_id');
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
        )->orderBy('position', 'asc');
    }

    public function getAllPhotoUrls()
    {
        $result = [];
        $roles = PrinterPhotoRole::all()->keyBy('id');
        $empty = [];
        foreach ($roles as $role) {
            $empty[$role->name] = [];
        }
        foreach ($this->customized_printer_photos as $customized_printer_photo) {
            if (!isset($result[$customized_printer_photo->printer_photo_id])) {
                $result[$customized_printer_photo->printer_photo_id] = $empty;
            }
            $result[$customized_printer_photo->printer_photo_id][$roles->get($customized_printer_photo->printer_photo_role_id)->name] = $customized_printer_photo->getUrl();
        }

        return $result;
    }

    public function getCustomizedPhotosForRole(PrinterPhotoRole $role)
    {
        return $this->customized_printer_photos->filter(function ($cpp) use ($role) {
            return $cpp->printer_photo_role_id == $role->id;
        });
    }

    public function getCustomizedPrinterPhoto($printerPhotoId, PrinterPhotoRole $role = null)
    {
        $all = $this->customized_printer_photos->filter(function ($cpp) use ($printerPhotoId, $role) {
            if ($role == null) {
                return $cpp->printer_photo_id == $printerPhotoId;
            } else {
                return $cpp->printer_photo_id == $printerPhotoId && $cpp->printer_photo_role_id == $role->id;
            }
        })->keyBy('printer_photo_role_id');
        if ($role == null) {
            return $all;
        }

        return $all->get($role->id);
    }

    public function getMainImageUrl($role)
    {
        if ($this->printer_photos->isEmpty()) {
            return null;
        }

        return $this->getCustomizedPrinterPhoto($this->printer_photos->first()->id, $role)
            ->getUrl();
    }

    public function papersizes()
    {
        return $this->hasManyThrough(
            Papersize::class,
            PrinterPapersize::class,
            'printer_id',
            'id',
            'id',
            'papersize_id'
        )->orderBy('width_in_millimetres', 'desc');
    }

    public function technical_specifications()
    {
        return $this->hasMany(PrinterTechnicalSpecificationCategory::class, 'printer_id', 'id');
    }

    public function printerattributes()
    {
        return $this->hasMany(PrinterAttribute::class);
    }

    public function syncPhotos(array $photoIds)
    {
        $created = new Collection();
        \DB::transaction(function () use ($photoIds, &$created) {
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
            } else {
                PrinterTechnicalSpecificationCategory::updateOrCreate([
                    'printer_id'                          => $this->id,
                    'technical_specification_category_id' => $tsc_id,
                ], ['html_content' => $tsc_value]);
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
            'name'                             => 'Név',
            'manufacturer_name'                => 'Gyártó',
            'is_enabled_label'                 => 'Státusz',
            'similar_printers_button'          => 'Hasonló termékek',
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
        $result['manufacturer_id']->setValueSet(Manufacturer::orderBy('name', 'asc')->get()->pluck('name', 'id'), -1,
            'Összes');
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
            self::SORTING_OPTION_PRICE_UP   => 'Ár szerint növekvő',
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
            'papersizes',
            'printer_photos',
            'technical_specifications',
            'similarprinters',
            'similarprinters.similarprinter',
            'printersviewedbyothers',
            'printersviewedbyothers.similarprinter',
        ])->withAttributes()->first();

        if (($result == null) && ($abortWith404IfNotFound)) {
            abort(404);
        }

        return $result;
    }

    public static function similarRelations()
    {
        return [
            self::RELATIONTYPE_SIMILAR          => 'similarprinters',
            self::RELATIONTYPE_VIEWED_BY_OTHERS => 'printersviewedbyothers',
        ];
    }

    public function syncSimilarPrinters($similarPrinters, $relationtype)
    {
        return \DB::transaction(function () use ($similarPrinters, $relationtype) {
                $accessor = self::similarRelations()[$relationtype];
                $this->$accessor()->delete();
                $position = 0;
                foreach ($similarPrinters as $row) {
                    SimilarPrinter::create([
                        'printer_id'         => $this->id,
                        'similar_printer_id' => \Str::startsWith($row['custom_id'], 'x') ? null : $row['custom_id'],
                        'position'           => ++$position,
                        'relationtype'       => $relationtype,
                        'label' => $row['final_label'],
                        'url' => $row['final_url']
                    ]);
                }
            }) === null;
    }

    public function getSimilarPrintersButtonAttribute()
    {
        return 'component::'.json_encode([
                'component'      => 'related-printers-popup-button',
                'componentProps' => [
                    'operationsUrl' => route('related_printer_endpoint'),
                    'printerId'     => $this->id,
                    'relationType'  => self::RELATIONTYPE_SIMILAR,
                ],
            ]);
    }

    public function getPrintersViewedByOthersButtonAttribute()
    {
        return 'component::'.json_encode([
                'component'      => 'related-printers-popup-button',
                'componentProps' => [
                    'operationsUrl' => route('related_printer_endpoint'),
                    'printerId'     => $this->id,
                    'relationType'  => self::RELATIONTYPE_VIEWED_BY_OTHERS,
                ],
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

    public function scopeWithAttributes(Builder $query)
    {
        return $query->withGlobalScope('attr', new PrinterWithAttributesScope);
    }

    public function getPriceLabelAttribute()
    {
        return $this->request_for_price == 1
            ? 'Az árért keressen!'
            : PriceFormatter::formatToInteger($this->price);
    }

    public function getColorManagementAttribute()
    {
        return 1;
    }

    public function getMaxPapersizeAttribute()
    {
        return $this->papersizes->first();
    }
}
