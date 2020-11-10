<?php


namespace App\Helpers;


use App\Display;
use Illuminate\Database\Eloquent\Builder;

class ComparableDisplay extends Display
{
    protected $table = 'printers';

    protected $appends = [];

    protected $with = [];

    protected static function booted()
    {
        static::addGlobalScope('manufacturerName', function(Builder $builder) {
            $builder->select('printers.name', 'printers.model_number_displayed', 'printers.slug', 'manuf.mname as mfname')
                ->join(
                    \DB::raw('(select name as mname, id as mid from manufacturers) manuf'),
                    'manuf.mid',
                    '=',
                    'printers.manufacturer_id'
                );
        });
        static::addGlobalScope('displayfamily', function(Builder $builder) {
            return $builder->where('productfamily', '=', Productfamily::DISPLAYS_ID);
        });

    }

    public function getDisplaynameAttribute()
    {
        return $this->mfname . ' ' . $this->model_number_displayed . ' ' . $this->name;
    }

}