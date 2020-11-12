<?php

namespace App;

use App\Helpers\Productfamily;
use App\Helpers\Productsubfamily;
use App\Traits\hasFiles;
use App\Traits\hasIsEnabledProperty;
use App\Traits\HasSortingOptions;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Builder;

class Display extends Printer
{
    use VueCRUDManageable, hasIsEnabledProperty, hasFiles, HasSortingOptions;

    const SUBJECT_SLUG = 'display';
    const SUBJECT_NAME = 'Kijelző';
    const SUBJECT_NAME_PLURAL = 'Kijelzők';

    protected $table = 'printers';
    protected $with = [
        'manufacturer',
        'printer_photos',
        'printerattributevalues',
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
        static::addGlobalScope('displayfamily', function(Builder $builder) {
            return $builder->where('productfamily', '=', Productfamily::DISPLAYS_ID);
        });
    }

    public static function getVueCRUDModellistButtons()
    {
        return [
            'edit' => self::buildButtonFromConfigData('vuecrud.buttons.edit'),
        ];
    }


    public static function findBySlug($slug, $abortWith404IfNotFound = true)
    {
        $result = self::where('slug', '=', $slug)->with(
            [
                'manufacturer',
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
        $result['productsubfamily'] = new SelectVueCRUDIndexfilter('productsubfamily', 'Típus', -1, -1);
        $result['productsubfamily']->setValueSet(
            Productsubfamily::getKeyValueCollection(),
            -1,
            'Összes'
        );
        $result['is_enabled'] = new SelectVueCRUDIndexfilter('is_enabled', 'Státusz', 1, 1);
        $result['is_enabled']->setValueSet(self::getIsEnabledOptions());

        return $result;
    }
}
