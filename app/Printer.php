<?php

namespace App;

use App\Helpers\PriceFormatter;
use App\Helpers\PrinterAttributeValue;
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

    const CALL_FOR_PRICE_LABEL = 'Hívjon az árért!';

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
        'description',
        'slug',
        'html_page_title',
        'html_page_meta_description',
        'is_enabled',
        'price',
        'price_discounted',
        'request_for_price',
        'model_number',
        'model_number_displayed',
    ];

    protected $appends = [
        'manufacturer_name',
        'is_enabled_label',
        'similar_printers_button',
        'printers_viewed_by_others_button',
        'attributes_button',
        'max_papersize',
        'max_papersize_label',
        'color_management',
        'color_management_label',
        'is_multifunctional',
        'is_multifunctional_label',
        'displayname',
        'functions_label',
    ];

    protected $with = [
        'manufacturer',
        'printer_photos',
        'usergroupsize',
        'printerattributevalues',
        'papersizes',
    ];

    protected static function booted()
    {
        static::addGlobalScope(
            'actualprice',
            function (Builder $builder) {
                return $builder->leftJoin(
                    \DB::raw(
                        '(select id as ap_pid, (case when price_discounted is null then price else price_discounted end) actualprice from printers) apjoin'
                    ),
                    'apjoin.ap_pid',
                    '=',
                    'printers.id'
                );
            }
        );
    }

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
            $result[$customized_printer_photo->printer_photo_id][$roles->get(
                $customized_printer_photo->printer_photo_role_id
            )->name] = $customized_printer_photo->getUrl();
        }

        return $result;
    }

    /**
     * @param $modelnumber string
     * @return Printer|null
     */
    public static function findByModelNumber(string $modelnumber)
    {
        return self::where('model_number', $modelnumber)
                   ->get()
                   ->first();
    }

    public function getCustomizedPhotosForRole(PrinterPhotoRole $role)
    {
        return $this->customized_printer_photos->filter(
            function ($cpp) use ($role) {
                return $cpp->printer_photo_role_id == $role->id;
            }
        );
    }

    public function getCustomizedPrinterPhoto($printerPhotoId, PrinterPhotoRole $role = null)
    {
        $all = $this->customized_printer_photos->filter(
            function ($cpp) use ($printerPhotoId, $role) {
                if ($role == null) {
                    return $cpp->printer_photo_id == $printerPhotoId;
                } else {
                    return $cpp->printer_photo_id == $printerPhotoId && $cpp->printer_photo_role_id == $role->id;
                }
            }
        )->keyBy('printer_photo_role_id');
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

    public function printerpapersizes()
    {
        return $this->hasMany(PrinterPapersize::class, 'printer_id');
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

    public function printerattributevalues()
    {
        return $this->hasMany(PrinterAttributeValue::class);
    }

    public function syncPhotos(array $photoIds)
    {
        $created = new Collection();
        \DB::transaction(
            function () use ($photoIds, &$created) {
                foreach (PrinterPhoto::getRemovablePhotos($this->id, $photoIds) as $du) {
                    PrinterPhoto::removePrinterPhoto($du->pp_id);
                }
                foreach (array_values($photoIds) as $index => $photoId) {
                    $du = PrinterPhoto::firstOrCreateWithCustomizedPrinterPhoto($this->id, $photoId, $index + 1);
                    if ($du->wasRecentlyCreated) {
                        $created->push($du);
                    }
                }
            }
        );

        return $created;
    }

    public function syncTechnicalSpecifications(array $tscs)
    {
        foreach ($tscs as $tsc_id => $tsc_value) {
            if ($tsc_value === null) {
                PrinterTechnicalSpecificationCategory::removePrinterTechnicalSpecificationCategory($this->id, $tsc_id);
            } else {
                PrinterTechnicalSpecificationCategory::updateOrCreate(
                    [
                        'printer_id'                          => $this->id,
                        'technical_specification_category_id' => $tsc_id,
                    ],
                    ['html_content' => $tsc_value]
                );
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
            'displayname'                      => 'Név',
            'manufacturer_name'                => 'Gyártó',
            'is_enabled_label'                 => 'Státusz',
            'similar_printers_button'          => 'Hasonló termékek',
            'printers_viewed_by_others_button' => 'Mások által megtekintett termékek',
            'attributes_button'                => 'Tulajdonságok',

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
        $result['manufacturer_id']->setValueSet(
            Manufacturer::orderBy('name', 'asc')->get()->pluck('name', 'id'),
            -1,
            'Összes'
        );
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
        $result = self::where('slug', '=', $slug)->with(
            [
                'manufacturer',
                'papersizes',
                'printer_photos',
                'similarprinters',
                'similarprinters.similarprinter',
                'printersviewedbyothers',
                'printersviewedbyothers.similarprinter',
            ]
        )->withAttributes()->first();

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
        return \DB::transaction(
                function () use ($similarPrinters, $relationtype) {
                    $accessor = self::similarRelations()[$relationtype];
                    $this->$accessor()->delete();
                    $position = 0;
                    foreach ($similarPrinters as $row) {
                        SimilarPrinter::create(
                            [
                                'printer_id'         => $this->id,
                                'similar_printer_id' => \Str::startsWith(
                                    $row['custom_id'],
                                    'x'
                                ) ? null : $row['custom_id'],
                                'position'           => ++$position,
                                'relationtype'       => $relationtype,
                                'label'              => $row['final_label'],
                                'url'                => $row['final_url'],
                            ]
                        );
                    }
                }
            ) === null;
    }

    public function syncPapersizes($ids)
    {
        return \DB::transaction(
                function () use ($ids) {
                    $this->printerpapersizes()->delete();
                    foreach ($ids as $id) {
                        PrinterPapersize::create(
                            [
                                'printer_id'   => $this->id,
                                'papersize_id' => $id,
                            ]
                        );
                    }
                }
            ) === null;
    }

    public function getSimilarPrintersButtonAttribute()
    {
        return 'component::' . json_encode(
                [
                    'component'      => 'related-printers-popup-button',
                    'componentProps' => [
                        'operationsUrl' => route('related_printer_endpoint'),
                        'printerId'     => $this->id,
                        'relationType'  => self::RELATIONTYPE_SIMILAR,
                    ],
                ]
            );
    }

    public function getPrintersViewedByOthersButtonAttribute()
    {
        return 'component::' . json_encode(
                [
                    'component'      => 'related-printers-popup-button',
                    'componentProps' => [
                        'operationsUrl' => route('related_printer_endpoint'),
                        'printerId'     => $this->id,
                        'relationType'  => self::RELATIONTYPE_VIEWED_BY_OTHERS,
                    ],
                ]
            );
    }

    public function getAttributesButtonAttribute()
    {
        return 'component::' . json_encode(
                [
                    'component'      => 'printer-attributes-popup-button',
                    'componentProps' => [
                        'operationsUrl' => route('printer_attribute_endpoints'),
                        'printerId'     => $this->id,
                    ],
                ]
            );
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
        if ($this->request_for_price == 1) {
            return '<div class="printer-price">' . self::CALL_FOR_PRICE_LABEL . '</div>';
        }
        if ($this->price_discounted) {
            return '<div class="printer-original-price">'
                . PriceFormatter::formatToInteger($this->price)
                . '</div><div class="printer-price">'
                . PriceFormatter::formatToInteger($this->price_discounted)
                . '</div>';
        }
        return '<div class="printer-price">'
            . PriceFormatter::formatToInteger($this->price)
            . '</div>';
    }

    public function getPrinterAttributeValue($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues()
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->finalvalue;
    }

    public function getPrinterAttributeAttributeLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues()
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->alabel;
    }

    public function getPrinterAttributeLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues()
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->label;
    }

    public function getPrinterAttributeValueLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues()
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->avlabel;
    }

    public function getColorManagementAttribute()
    {
        if ($this->printing != null) {
            return $this->printing;
        }

        return $this->getPrinterAttributeValue('color_management');
    }

    public function getColorManagementLabelAttribute()
    {
        if ($this->printing_label != null) {
            return $this->printing_label;
        }

        return $this->getPrinterAttributeValueLabel('color_management');
    }

    public function getFunctionsLabelAttribute()
    {
        $data = [];
        if (($this->printing != null) || ($this->copying != null) || ($this->scanning != null)) {
            $data = [$this->printing_attribute_label, $this->copying_attribute_label, $this->scanning_attribute_label];
        } else {
            $data = [
                $this->getPrinterAttributeAttributeLabel('printing'),
                $this->getPrinterAttributeAttributeLabel('copying'),
                $this->getPrinterAttributeAttributeLabel('scanning'),
            ];
        }

        return collect($data)->filter(
            function ($item) {
                return $item != null && $item != '';
            }
        )->implode(' / ');
    }

    public function getMaxPapersizeAttribute()
    {
        return $this->papersizes->first();
    }

    public function getMaxPapersizeLabelAttribute()
    {
        return $this->papersizes->first()->code;
    }

    public function getUsergroupSizeLabelAttribute()
    {
        return $this->usergroupsize->name;
    }

    public function getIsMultifunctionalAttribute()
    {
        if (($this->printing != null) && ($this->scanning != null)) {
            return $this->printing > 0 && $this->scanning > 0 ? 1001 : 1002;
        }
        return $this->getPrinterAttributeValue('printing') > 0
        && $this->getPrinterAttributeValue('scanning') > 0 ? 1001 : 1002;
    }

    public function getIsMultifunctionalLabelAttribute()
    {
        return AttributeValue::find($this->is_multifunctional)->label;
    }

    public function remove()
    {
        return \DB::transaction(
                function () {
                    SimilarPrinter::where('printer_id', '=', $this->id)->delete();
                    PrinterPapersize::where('printer_id', '=', $this->id)->delete();
                    $this->printerattributevalues()->delete();
                    foreach ($this->printer_photos as $printer_photo) {
                        PrinterPhoto::removePrinterPhoto($printer_photo->id);
                    }
                    $this->delete();
                }
            ) === null;
    }

    public function getDisplaynameAttribute()
    {
        return $this->manufacturer_name . ' ' . $this->model_number_displayed . ' ' . $this->name;
    }

    public function setPrinterAttribute(string $variablename, ?string $value, ?string $label): ?PrinterAttribute
    {
        $attribute = Attribute::findByVariableName($variablename);
        if (is_null($attribute)) {
            throw (new \Exception('Invalid attribute variable name \'' . $variablename . '\''));
        }

        if ((is_null($label)) && (is_null($label))) {
            $message = 'To set \'' . $variablename . '\' attribute for the current printer'
                . ' at least a label or a value should be specified';
            throw (new \Exception($message));
        }

        if ($attribute->takesValueFromSet()) {
            return $this->setPrinterAttributeFromSet($variablename, $value, $label);
        } else {
            return $this->setPrinterAttributeWithCustomValue($variablename, $customvalue);
        }
    }


    private function setPrinterAttributeFromSet(string $variablename, ?string $value, ?string $label)
    {
        $attribute = Attribute::findByVariableName($variablename);
        if (is_null($attribute) || (!$attribute->takesValueFromSet())) {
            throw (new \Exception(
                'Invalid attribute variable name \'' . $variablename .
                '\' or attribute does not take value from a set!'
            ));
        }

        $attributevalue = !is_null($value)
            ? $attribute->getAttributeValueFromSetByValue($value)
            : $attribute->getAttributeValueFromSetByLabel($label);

        if (is_null($attributevalue)) {
            throw (new \Exception('Invalid value or label while setting printer attribute from set!'));
        }

        return null;
    }

    private function setPrinterAttributeWithCustomValue(string $variablename, $customvalue, $updateIfFound = false)
    {
        $returnedPrinterAttribute = null;
        $attribute = Attribute::findByVariableName($variablename);
        if (!is_null($attribute)) {
            $printerattribute = PrinterAttribute::where('printer_id', $this->id)
                                                ->where('attribute_id', $attribute->id)
                                                ->get()
                                                ->first();
            if (!is_null($printerattribute)) {
                if ($updateIfFound) {
                    $returnedPrinterAttribute = PrinterAttribute::addOrUpdate($this->id, $variablename, $customvalue);
                }
            } else {
                $returnedPrinterAttribute = PrinterAttribute::addOrUpdate($this->id, $variablename, $customvalue);
            }
        }

        return $returnedPrinterAttribute;
    }
}
