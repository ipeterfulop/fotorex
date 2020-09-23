<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterAttribute extends Model
{
    use HasFactory;
    protected $table='printer_attribute';

    protected $fillable = [
        'printer_id',
        'attribute_id',
        'attribute_value_id',
        'customvalue',
    ];

//    protected static function booted()
//    {
//        static::addGlobalScope('values', function(Builder $builder) {
//            $builder->joinSub(
//                Attribute::select(\DB::raw('id as aid'), 'name', \DB::raw('label as alabel'), 'variable_name'),
//                'a',
//                'a.aid',
//                '=',
//                'printer_attribute.attribute_id'
//            )->joinSub(
//                AttributeValue::select(\DB::raw('label as avlabel'), 'value', \DB::raw('id as avid')),
//                'av',
//                'av.avid',
//                '=',
//                'printer_attribute.attribute_value_id'
//            )->select(
//                'printer_attribute.*',
//                'a.name',
//                'a.alabel',
//                'a.variable_name',
//                'av.avlabel',
//                'av.value',
//                \DB::raw('case when attribute_value_id is null then customvalue else value end finalvalue'));
//        });
//    }
}
