<?php


namespace App\Factories;


use App\Attribute;
use App\AttributeValue;
use App\ExtraFeature;
use App\Manufacturer;
use App\Papersize;
use App\Printer;
use App\Searching\CheckboxgroupSearchField;
use App\Searching\RadiogroupSearchField;
use App\Searching\RangeSearchField;
use App\Searching\TextSearchField;
use App\UsergroupSize;
use Illuminate\Database\Eloquent\Builder;

class PrinterFilterFactory
{
    const MIN_PRICE = 10000;
    const MAX_PRICE = 2000000;

    public static function createFilters()
    {
        $result = [];
        $result[] = (new TextSearchField())->setLabel('Keresés')->setField('search');
        $result[] = (new CheckboxgroupSearchField())->setLabel('Munkakörnyezet')
            ->setField('usergroup')
            ->setValueset(UsergroupSize::orderBy('position', 'asc')->enabled()->get()->pluck('name', 'id'));
        $result[] = (new RadiogroupSearchField())->setLabel('Színkezelés')
            ->setField('printing')
            ->setValueset(Attribute::with(['attribute_value_set'])->whereVariableName('printing')->first()->getAttributeValuesFromSetWithoutNA()->pluck('label', 'value'));
        $result[] = (new RangeSearchField(self::getMinPrice(), self::getMaxPrice()))->setLabel('Ár')
            ->setField('price');
        $result[] = (new RadiogroupSearchField())->setLabel('Maximális nyomtatási méret')
            ->setField('papersize')
            ->setValueset(Papersize::getAllCurrentlySold()->pluck('label', 'value'));
        $result[] = (new RadiogroupSearchField())->setLabel('Hálózati csatlakozás')
            ->setField('networked')
            ->setValueset(Attribute::with(['attribute_value_set'])->whereVariableName('networked')->first()->getAttributeValuesFromSetWithoutNA()->pluck('label', 'value'));


        return self::setValuesFromRequest($result, request());
    }

    protected static function setValuesFromRequest($filters, $request)
    {
        foreach ($filters as &$filter) {
            $filter->setValue($request->get($filter->getField(), $filter->getDefaultValue()));
        }

        return $filters;
    }

    public static function getMinPrice()
    {
        $value = Printer::min('actualprice');

        return $value ?? self::MIN_PRICE;
    }

    public static function getMaxPrice()
    {
        $value = Printer::max('actualprice');

        return $value ?? self::MAX_PRICE;
    }
}
