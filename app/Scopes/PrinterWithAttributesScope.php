<?php


namespace App\Scopes;


use App\Attribute;
use App\Helpers\PrinterAttributeValue;
use App\PrinterAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PrinterWithAttributesScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $fields = Attribute::select('variable_name')->where('is_computed', '=', 0)->get()->pluck('variable_name');
        $selects = ['printers.*'];
        foreach ($fields as $field) {
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then finalvalue end) '.$field);
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then avlabel end) '.$field.'_label');
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then alabel end) '.$field.'_attribute_label');
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then finalvalue_or_id end) '.$field.'_value_or_id');
        }
        return $builder->select($selects)
            ->leftJoinSub(
                PrinterAttributeValue::select('finalvalue', 'finalvalue_or_id', 'alabel')->groupBy(['printer_id', 'variable_name', 'finalvalue', 'avlabel', 'alabel', 'attribute_value_id', 'customvalue', 'finalvalue_or_id']),
                'attr',
                'attr.printer_id',
                '=',
                $model->getTable().'.'.$model->getKeyName()
            )->groupBy('printers.id');
    }
}