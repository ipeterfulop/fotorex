<?php


namespace App\Scopes;


use App\Attribute;
use App\Helpers\PrinterAttributeValue;
use App\Manufacturer;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterRentaloption;
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
        $selects = $this->getPrinterSelects();
        foreach ($fields as $field) {
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then finalvalue end) '.$field);
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then avlabel end) '.$field.'_label');
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then alabel end) '.$field.'_attribute_label');
            $selects[] = \DB::raw('MAX(case when variable_name="'.$field.'" then finalvalue_or_id end) '.$field.'_value_or_id');
        }

        return $builder->select($selects)
            ->leftJoinSub(PrinterRentaloption::select('printer_id', 'price as rentalprice', 'extra_page_price_bw', 'extra_page_price_color'), 'pr', 'printers.id', '=', 'pr.printer_id')
            ->leftJoinSub(Manufacturer::select('id', 'name as mname'), 'm', 'printers.manufacturer_id', '=', 'm.id')
            ->leftJoinSub(
                PrinterAttributeValue::select('finalvalue', 'finalvalue_or_id', 'alabel')->groupBy(['printer_id', 'variable_name', 'finalvalue', 'avlabel', 'alabel', 'attribute_value_id', 'customvalue', 'finalvalue_or_id']),
                'attr',
                'attr.printer_id',
                '=',
                $model->getTable().'.'.$model->getKeyName()
            )->groupBy('printers.id');
    }

    protected function getPrinterSelects()
    {
        $result = [
            \DB::raw('MIN(pr.rentalprice) as rentalprice'),
            \DB::raw('MIN(pr.extra_page_price_bw) as extra_page_price_bw'),
            \DB::raw('MIN(pr.extra_page_price_color) as extra_page_price_color'),
            \DB::raw('MIN(m.mname) as manufacturername'),
            \DB::raw('MIN(printers.id) as id'),
            \DB::raw('MIN(printers.created_at) as created_at'),
            \DB::raw('MIN(printers.updated_at) as updated_at'),
            \DB::raw('MIN(case when price_discounted is null then price else price_discounted end) as actualprice'),
        ];
        foreach ((new Printer())->getFillable() as $field) {
            $result[] = \DB::raw('MIN(printers.'.$field.') as '.$field);
        }

        return $result;
    }
}