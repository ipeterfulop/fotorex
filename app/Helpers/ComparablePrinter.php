<?php


namespace App\Helpers;


use App\Printer;
use App\PrinterAttribute;
use Illuminate\Database\Eloquent\Builder;

class ComparablePrinter extends Printer
{
    protected $table = 'printers';

    protected $appends = [];

    protected $with = ['manufacturer'];

    protected static function booted()
    {
        static::addGlobalScope('manufacturerName', function(Builder $builder) {
            $builder->select('printers.name', 'printers.model_number_displayed', 'printers.slug', 'manuf.mname as mfname', 'manufacturer_id')
                ->join(
                    \DB::raw('(select name as mname, id as mid from manufacturers) manuf'),
                'manuf.mid',
                '=',
                'printers.manufacturer_id'
                );
        });
        static::addGlobalScope('printerfamily', function(Builder $builder) {
            return $builder->where('productfamily', '=', Productfamily::PRINTERS_ID);
        });

    }

    public function getDisplaynameAttribute()
    {
        return $this->mfname . ' ' . $this->model_number_displayed . ' ' . $this->name;
    }

}