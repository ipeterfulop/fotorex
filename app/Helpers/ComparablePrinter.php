<?php


namespace App\Helpers;


use App\Printer;
use App\PrinterAttribute;
use Illuminate\Database\Eloquent\Builder;

class ComparablePrinter extends Printer
{
    protected $table = 'printers';

    protected $appends = [];

    protected $with = [];

    protected static function booted()
    {
        static::addGlobalScope('manufacturerName', function(Builder $builder) {
            $builder->select('printers.name', 'printers.slug', 'manuf.mname as mfname')
                ->join(
                    \DB::raw('(select name as mname, id as mid from manufacturers) manuf'),
                'manuf.mid',
                '=',
                'printers.manufacturer_id'
                );
        });
    }
}