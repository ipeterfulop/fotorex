<?php


namespace App\Factories;


use App\Attribute;
use App\Helpers\Productsubfamily;
use App\Papersize;
use App\PrinterPapersize;
use App\Searching\CheckboxgroupSearchField;
use App\Searching\RadiogroupSearchField;
use App\Searching\RangeSearchField;
use App\Searching\TextSearchField;
use App\UsergroupSize;
use Illuminate\Database\Eloquent\Builder;

abstract class FilterFactory
{
    const MIN_PRICE = 10000;
    const MAX_PRICE = 2000000;

    abstract public static function getAllAvailableFilters();
    abstract public static function getMinPrice();
    abstract public static function getMaxPrice();

    public static function createFilters($ignoreFilters = [])
    {
        $result = [];
        foreach (static::getFilterList($ignoreFilters) as $field) {
            $result[] = static::getFilter($field);
        }

        return static::setValuesFromRequest($result, request());
    }

    protected static function getFilterList($ignore = [])
    {
        return collect(static::getAllAvailableFilters())->except($ignore)->all();
    }

    protected static function setValuesFromRequest($filters, $request)
    {
        foreach ($filters as &$filter) {
            $filter->setValue($request->get($filter->getField(), $filter->getDefaultValue()));
        }

        return $filters;
    }

    protected static function getFilter($field)
    {
        switch ($field) {
            case 'search':
                return (new TextSearchField())->setLabel('Keresés')->setField('search');
            case 'usergroup':
                return (new CheckboxgroupSearchField())->setLabel('Munkakörnyezet')
                    ->setField('usergroup')
                    ->setValueset(UsergroupSize::orderBy('position', 'asc')->enabled()->get()->pluck('name', 'id'));
            case 'productsubfamily':
                return (new RadiogroupSearchField())->setLabel('Típus')
                    ->setField('productsubfamily')
                    ->setValueset(Productsubfamily::getKeyValueCollection());
            case 'printing':
                return (new RadiogroupSearchField())->setLabel('Színkezelés')
                    ->setField('printing')
                    ->setValueset(Attribute::with(['attribute_value_set'])->whereVariableName('printing')->first()->getAttributeValuesFromSetWithoutNA()->pluck('label', 'value'));
            case 'price':
                return (new RangeSearchField(static::getMinPrice(), static::getMaxPrice()))->setLabel('Ár')
                    ->setField('price');
            case 'papersize':
                return (new RadiogroupSearchField())->setLabel('Maximális nyomtatási méret')
                    ->setField('papersize')
                    ->setValueset(Papersize::getAllCurrentlySold()->pluck('label', 'value'));
            case 'networked':
                return (new RadiogroupSearchField())->setLabel('Hálózati csatlakozás')
                    ->setField('networked')
                    ->setValueset(Attribute::with(['attribute_value_set'])->whereVariableName('networked')->first()->getAttributeValuesFromSetWithoutNA()->pluck('label', 'value'));
        }

        throw new \Exception('Nincs ilyen szűrődefiníció: '.$field);
    }

    public static function addFilterToQuery($field, $value, Builder $query)
    {
        if (($value == '') || ($value == null) || ($value == -1)) {
            return $query;
        }
        switch ($field) {
            case 'search':
                return $query->textSearch($value);
            case 'productsubfamily':
                return $query->where('productsubfamily','=', $value);
            case 'usergroup':
                $ids = explode(',', $value);
                return $query->whereIn('usergroup_size_id', $ids);
            case 'price':
                $range = explode('-', $value);
                return $query->inPriceRange($range);
            case 'papersize':
                return $query->whereIn('printers.id', PrinterPapersize::distinct('printer_id')->where('papersize_id', '=', $value)->get()->pluck('printer_id'));
            case 'networked':
                return static::addAttributeFilterToQuery($field, $value, $query);
            case 'printing':
                return static::addAttributeFilterToQuery($field, $value, $query);
        }

        return $query;
    }

    protected static function addAttributeFilterToQuery($field, $value, Builder $query)
    {
        $values = collect(explode(',', $value));
        return $query->having($field, '=', $values->max());
    }
}