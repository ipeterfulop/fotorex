<?php


namespace App\Factories;


use App\Attribute;
use App\ExtraFeature;
use App\Manufacturer;
use App\Searching\CheckboxgroupSearchField;
use App\Searching\RangeSearchField;
use App\Searching\TextSearchField;
use App\UsergroupSize;
use Illuminate\Database\Eloquent\Builder;

class PrinterFilterFactory
{
    public static function createFilters()
    {
        $result = [];
        $result[] = (new TextSearchField())->setLabel('Keresés')->setField('search');
        $result[] = (new CheckboxgroupSearchField())->setLabel('Funkciók')
            ->setField('modes')
            ->setValueset(Attribute::where('attribute_value_set_id', '=', 3)->get()->pluck('name', 'variable_name'));
        $result[] = (new RangeSearchField(0, 500000))->setLabel('Ár')
            ->setField('price');
        $result[] = (new CheckboxgroupSearchField())->setLabel('Gyártók')
            ->setField('manufacturer')
            ->setValueset(Manufacturer::orderBy('name', 'asc')->enabled()->get()->pluck('name', 'id'));
//        $result[] = (new CheckboxgroupSearchField())->setLabel('Csoportméret')
//            ->setField('usergroup')
//            ->setValueset(UsergroupSize::orderBy('position', 'asc')->enabled()->get()->pluck('name', 'id'));
//        $result[] = (new CheckboxgroupSearchField())->setLabel('Extra funkciók')
//            ->setField('extra_features')
//            ->setValueset(ExtraFeature::orderBy('name', 'asc')->enabled()->get()->pluck('name', 'id'));

        return self::setValuesFromRequest($result, request());
    }

    protected static function setValuesFromRequest($filters, $request)
    {
        foreach ($filters as &$filter) {
            $filter->setValue($request->get($filter->getField(), ''));
        }

        return $filters;
    }
}
