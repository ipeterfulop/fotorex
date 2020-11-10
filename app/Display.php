<?php

namespace App;

use App\Helpers\Productfamily;
use App\Traits\hasFiles;
use App\Traits\hasIsEnabledProperty;
use App\Traits\HasSortingOptions;
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


}
