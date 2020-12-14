<?php


namespace App\Dataproviders;


use App\Attribute;
use App\Helpers\Productfamily;

class ProductAttributeDataprovider
{
    public static function getComparableAttributeKeys($productfamily)
    {
        if ($productfamily == Productfamily::PRINTERS_ID) {
            $result = [
                ['v' => 'usergroup_size_label', 'n' => 'Munkakörnyezet'],
            ];

            return static::buildList(Attribute::forPrinters()->where('position_at_product_comparison', '!=', null)->orderBy('position_at_product_comparison', 'asc')->get(), $result);
        }
        if ($productfamily == Productfamily::DISPLAYS_ID) {
            return static::buildList(Attribute::forDisplays()->where('position_at_product_comparison', '!=', null)->orderBy('position_at_product_comparison', 'asc')->get());
        }
        throw new \Exception('No valid product family provided');
    }

    protected static function buildList($attributes, $default = [])
    {
        $result = $default;
        foreach ($attributes as $attribute) {
            $result[] = [
                'v' => $attribute->variable_name.'_label',
                'n' => $attribute->name
            ];
        }

        return collect($result);
    }
}