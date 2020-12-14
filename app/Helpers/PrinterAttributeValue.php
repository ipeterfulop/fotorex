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
                Attribute::select(\DB::raw('id as aid'), 'name', \DB::raw('label as alabel'), 'variable_name', \DB::raw('unit as aunit')),
                'a',
                'a.aid',
                '=',
                'printer_attribute.attribute_id'
            )->leftJoinSub(
                AttributeValue::select(\DB::raw('label as avlabel'), 'value', \DB::raw('id as avid')),
                'av',
                'av.avid',
                '=',
                'printer_attribute.attribute_value_id'
            )->select(
                'printer_attribute.printer_id',
                'a.alabel',
                'a.variable_name',
                'attribute_value_id',
                \DB::raw('ifnull(attribute_value_id, (case when attribute_value_id is null then customvalue else value end)) finalvalue_or_id'),
                \DB::raw('ifnull(customunit, a.aunit) unit'),
                \DB::raw('case when attribute_value_id is null then concat_ws(" ", customvalue, ifnull(ifnull(customunit, a.aunit), a.aunit)) else concat_ws(" ", value, ifnull(ifnull(customunit, a.aunit), a.aunit)) end finalvalue'),
                //\DB::raw('case when attribute_value_id is null then customvalue else value end finalvalue'),
                \DB::raw('case when av.avlabel is not null then av.avlabel else (case when attribute_value_id is null then concat_ws(" ", customvalue, ifnull(ifnull(customunit, a.aunit), a.aunit)) else concat_ws(" ", value, ifnull(ifnull(customunit, a.aunit), a.aunit)) end) end avlabel')
            );
        });
    }

}