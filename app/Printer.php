<?php

namespace App;

use App\Dataproviders\Filters\ProductcategoryVueCRUDIndexFilter;
use App\Helpers\PriceFormatter;
use App\Helpers\PrinterAttributeValue;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
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
use Illuminate\Support\Str;

class Printer extends Model
{
    use VueCRUDManageable, hasIsEnabledProperty, hasFiles, HasSortingOptions;

    const CALL_FOR_PRICE_LABEL = 'Hívjon az árért!';

    const SUBJECT_SLUG = 'printer';
    const SUBJECT_NAME = 'Nyomtató';
    const SUBJECT_NAME_PLURAL = 'Nyomtatók';
    const FILE_PUBLIC_PATH = 'termekek';

    const SORTING_OPTION_PRICE_UP = 'ar_novekvo';
    const SORTING_OPTION_PRICE_DOWN = 'ar_csokkeno';

    const SORTING_OPTION_POPULARITY_UP = 'nepszeruseg_novekvo';
    const SORTING_OPTION_POPULARITY_DOWN = 'nepszeruseg_csokkeno';

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
        'popularity_index',
        'productfamily',
        'productsubfamily',
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
        'popularity_index_label',
        'displayname',
        'shortdisplayname',
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
        return $this->hasMany(SimilarPrinter::class, 'printer_id', 'id')
                    ->where('relationtype', '=', self::RELATIONTYPE_SIMILAR)
                    ->orderBy('position', 'asc');
    }

    public function printersviewedbyothers()
    {
        return $this->hasMany(SimilarPrinter::class, 'printer_id', 'id')
                    ->where('relationtype', '=', self::RELATIONTYPE_VIEWED_BY_OTHERS)
                    ->orderBy('position', 'asc');
    }

    public function printerrentaloptions()
    {
        return $this->hasMany(PrinterRentaloption::class, 'printer_id', 'id')->setEagerLoads([])->with(['rentaloption']);
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

    public function getMainImageUrl($role = null)
    {
        $role = $role ?? PrinterPhotoRole::getByName('original');
        if ($this->printer_photos->isEmpty()) {
            return null;
        }

        return $this->getCustomizedPrinterPhoto($this->printer_photos->first()->id, $role)
                    ->getUrl();
    }

    public function getMainImageThumbnailUrl()
    {
        return $this->getMainImageUrl(PrinterPhotoRole::getByName('thumbnail'));
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
        return $this->hasMany(PrinterAttributeValue::class, 'printer_id', 'id');
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
            'popularity_index_label'                 => 'Népszerűségi index',
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
        $searchedProperties = ['name', 'model_number', 'model_number_displayed'];
        $result[TextVueCRUDIndexfilter::buildPropertyName($searchedProperties)] = new TextVueCRUDIndexfilter($searchedProperties, 'Név', '');
        $result['manufacturer_id'] = new SelectVueCRUDIndexfilter('manufacturer_id', 'Gyártó', -1, -1);
        $result['manufacturer_id']->setValueSet(
            Manufacturer::orderBy('name', 'asc')->get()->pluck('name', 'id'),
            -1,
            'Összes'
        );
        $result['productcategory'] = new ProductcategoryVueCRUDIndexFilter('productcategory', 'Kategória', -1, -1);
        $result['is_enabled'] = new SelectVueCRUDIndexfilter('is_enabled', 'Státusz', 1, 1);
        $result['is_enabled']->setValueSet(self::getIsEnabledOptions());

        return $result;
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'popularity_index_label' => 'popularity_index',
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
            self::SORTING_OPTION_POPULARITY_DOWN => 'Népszerűség szerint csökkenő',
            self::SORTING_OPTION_POPULARITY_UP   => 'Népszerűség szerint növekvő',
            self::SORTING_OPTION_PRICE_DOWN => 'Ár szerint csökkenő',
            self::SORTING_OPTION_PRICE_UP   => 'Ár szerint növekvő',
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

    public function getPopularityIndexLabelAttribute()
    {
        return 'component::' . json_encode(
                [
                    'component'      => 'ajax-editable-value',
                    'componentProps' => [
                        'question' => $this->shortdisplayname.' népszerűségi indexe:',
                        'operationsUrl' => route('printer_popularity_index_update'),
                        'value' => $this->popularity_index,
                    ],
                ]
            );
    }

    public function scopeWithAttributes(Builder $query)
    {
        return $query->withGlobalScope('attr', new PrinterWithAttributesScope);
    }

    public function getPriceLabelAttribute()
    {
        if ($this->request_for_price == 1) {
            return '<div class="printer-discounted-price flex flex-row items-center">' . self::CALL_FOR_PRICE_LABEL . '<span class=" h-6 ml-3" style="width: 3rem">'.config('heroicons.solid.phone').'</span></div>';
        }
        if ($this->price_discounted) {
            return '<div class="printer-original-price">'
                . PriceFormatter::formatToInteger($this->price)
                . '</div><div class="printer-discounted-price">'
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
            $this->printerattributevalues
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->finalvalue;
    }

    public function getPrinterAttributeAttributeLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->alabel;
    }

    public function getPrinterAttributeLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues
                 ->where('variable_name', '=', $attributeVariableName)
                 ->first()
        )->label;
    }

    public function getPrinterAttributeValueLabel($attributeVariableName)
    {
        return optional(
            $this->printerattributevalues
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
        $data = [];
        if (($this->printing != null) || ($this->copying != null) || ($this->scanning != null)) {
            $data = [
                $this->printing_attribute_label => $this->printing_label,
                $this->copying_attribute_label => $this->copying_label,
                $this->scanning_attribute_label => $this->scanning_label
            ];
        } else {
            $data = [
                $this->getPrinterAttributeAttributeLabel('printing') => $this->getPrinterAttributeValueLabel('printing'),
                $this->getPrinterAttributeAttributeLabel('copying') => $this->getPrinterAttributeValueLabel('copying'),
                $this->getPrinterAttributeAttributeLabel('scanning') => $this->getPrinterAttributeValueLabel('scanning'),
            ];
        }
        return collect($data)->map(
            function ($item, $key) {
                return $key.': '.$item;
            }
        )->implode('<br>');
    }

    public function getFunctionsLabelAttribute()
    {
        $data = [];
        if (($this->printing != null) || ($this->copying != null) || ($this->scanning != null)) {
            $data = [
                $this->printing_attribute_label => $this->printing,
                $this->copying_attribute_label => $this->copying,
                $this->scanning_attribute_label => $this->scanning
            ];
        } else {
            $data = [
                $this->getPrinterAttributeAttributeLabel('printing') => $this->getPrinterAttributeValue('printing'),
                $this->getPrinterAttributeAttributeLabel('copying') => $this->getPrinterAttributeValue('copying'),
                $this->getPrinterAttributeAttributeLabel('scanning') => $this->getPrinterAttributeValue('scanning'),
            ];
        }

        return collect($data)->filter(
            function ($item) {
                return $item > 0;
            }
        )->keys()->implode(' / ');
    }

    public function getMaxPapersizeAttribute()
    {
        return $this->papersizes->first();
    }

    public function getMaxPapersizeLabelAttribute()
    {
        return optional($this->papersizes->first())->code;
    }

    public function getUsergroupSizeLabelAttribute()
    {
        return optional($this->usergroupsize)->name;
    }

    public function getIsMultifunctionalAttribute()
    {
        if (($this->printing != null) && ($this->scanning != null)) {
            return $this->printing > 0 && $this->scanning > 0 ? AttributeValue::YES_ID : AttributeValue::NO_ID;
        }
        return $this->getPrinterAttributeValue('printing') > 0
        && $this->getPrinterAttributeValue('scanning') > 0 ? AttributeValue::YES_ID : AttributeValue::NO_ID;
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

    public function getShortdisplaynameAttribute()
    {
        return $this->manufacturer_name . ' ' . $this->model_number_displayed;
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

    public static function getForSearchableSelect()
    {
        return self::enabled()->get()->sortBy('displayname')->map(
            function ($item) {
                return ['id' => $item->id, 'name' => $item->displayname];
            }
        )->values()->all();
    }

    public function getBasePhotoFilename($separator = '_')
    {
        return
            str_replace(
                ' ',
                $separator,
                strtolower($this->manufacturer->name)
                . $separator
                . strtolower($this->model_number)
                . $separator
                . 'image'
                . $separator
            );
    }

    public static function getProductfamily($printerId)
    {
        return \DB::table('printers')->select('productfamily')
            ->where('id', '=', $printerId)
            ->first()
            ->productfamily;
    }

    public function scopeForSale($query)
    {
        return $query->where(function($query) {
            return $query->where('request_for_price', '=', 1)
                ->orWhere('price', '!=', null)
                ->orWhere('price_discounted', '!=', null);
        });
    }

    public function scopeMultifunctionals($query)
    {
        //only applicable with the PrinterWithAttributes scope
        return $query->having('printing', '>', 0)
            ->having('copying', '>', 0);
    }

    public function scopeOnlyPrinters($query)
    {
        //only applicable with the PrinterWithAttributes scope
        return $query->having('printing', '>', 0)
            ->having('copying', '=', 0);
    }

    public function scopeTextSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $manufacturerIds = Manufacturer::where('name', 'like', '%'.$search.'%')->get()->pluck('id');
            return $query->where('description', 'like', '%'.$search.'%')
                ->orWhereIn('manufacturer_id', $manufacturerIds)
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('model_number', 'like', '%'.$search.'%')
                ->orWhere('model_number_displayed', 'like', '%'.$search.'%');
        });
    }

    public function scopeInPriceRange($query, $range)
    {
        return $query->where(function($query) use ($range) {
            return $query->where('request_for_price', '=', 1)
                ->orWhere('actualprice', '=', null)
                ->orWhereBetween('actualprice', $range);
        });
    }

    public function scopeSorted($query, $sortingOption)
    {
        switch ($sortingOption) {
            case self::SORTING_OPTION_POPULARITY_DOWN:
                return $query->orderBy('popularity_index', 'asc');
            case self::SORTING_OPTION_POPULARITY_UP:
                return $query->orderBy('popularity_index', 'desc');
            case self::SORTING_OPTION_PRICE_UP:
                return $query->orderBy('price', 'asc');
            case self::SORTING_OPTION_PRICE_DOWN:
                return $query->orderBy('price', 'desc');
        }
        return $query;
    }

    public function scopeSortedRental($query, $sortingOption)
    {
        switch ($sortingOption) {
            case self::SORTING_OPTION_POPULARITY_DOWN:
                return $query->orderBy('popularity_index', 'asc');
            case self::SORTING_OPTION_POPULARITY_UP:
                return $query->orderBy('popularity_index', 'desc');
            case self::SORTING_OPTION_PRICE_UP:
                return $query->orderBy('rentalprice', 'asc');
            case self::SORTING_OPTION_PRICE_DOWN:
                return $query->orderBy('rentalprice', 'desc');
        }
        return $query;
    }

    public function scopePrinter($query)
    {
        return $query->where('productfamily', '=', Productfamily::PRINTERS_ID);
    }

    public function getProductfamilyData()
    {
        $result = [
            'slug' => Productfamily::getProductfamilySlug($this->productfamily),
            'familyslug' => Productfamily::getProductfamilyUrlSlug($this->productfamily),
            'label' => Productfamily::getProductfamilyLabel($this->productfamily)
        ];
        if (($result['slug'] == Productfamily::PRINTERS_SLUG) && ($this->is_multifunctional == AttributeValue::YES_ID)) {
            $result['slug'] = Productfamily::MFP_SLUG;
            $result['familyslug'] = Productcategory::MFP_ID;
            $result['label'] = Productfamily::MFP_LABEL;
        }

        return $result;
    }

    public function getDetailsUrl()
    {
        $data = $this->getProductfamilyData();

        return route('category_details', ['slug' => $this->slug, 'familyslug' => $data['familyslug']]);
    }

    public function getBreadcrumbData()
    {
        $data = $this->getProductfamilyData();
        return collect([
            ['url' => '/', 'label' => 'Főoldal'],
            ['url' => route('printer_category_index', ['productcategoryId' => $data['familyslug']]), 'label' => $data['label']],
            ['url' => route('category_details', $data), 'label' => $this->shortdisplayname],
        ]);
    }

    public static function generateUniqueSlug($name, $manufacturerName, $modelNumber)
    {
        $baseSlug = Str::slug($manufacturerName.' '.$modelNumber.' '.$name);
        $slug = $baseSlug;
        $prefix = 1;
        while (static::findBySlug($slug, false) != null) {
            $slug = $baseSlug.'-'.$prefix++;
        }

        return $slug;
    }

    public static function scopeForRent($query)
    {
        //return $query->whereIn('printers.id', PrinterRentaloption::select('printer_id')->distinct()->get()->pluck('printer_id')->all());
        return $query->join(
            \DB::raw('(select printer_id as rpid, price as rentalprice from printer_rentaloption) pro'),
            'pro.rpid',
            '=',
            'printers.id'
        );
    }
}

