<?php


namespace App\Helpers;


use App\Attribute;
use App\AttributeValue;
use App\PrinterAttribute;
use Illuminate\Database\Eloquent\Builder;

class PrinterAttributeValue extends PrinterAttribute
{
    protected static function booted()
    {
        static::addGlobalScope('values', function(Builder $builder) {
            $builder->joinSub(
                Attribute::select(\DB::raw('id as aid'), 'name', \DB::raw('label as alabel'), 'variable_name'),
                'a',
                'a.aid',
                '=',
                'printer_attribute.attribute_id'
            )->joinSub(
                AttributeValue::select(\DB::raw('label as avlabel'), 'value', \DB::raw('id as avid')),
                'av',
                'av.avid',
                '=',
                'printer_attribute.attribute_value_id'
            )->select(
                'printer_attribute.printer_id',
                'a.alabel',
                'a.variable_name',
                'av.avlabel',
                \DB::raw('case when attribute_value_id is null then customvalue else value end finalvalue'));
        });
    }

}