<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class PrinterAttribute extends Model
{
    use HasFactory;

    protected $table = 'printer_attribute';

    protected $fillable = [
        'id',
        'printer_id',
        'attribute_id',
        'attribute_value_id',
        'customvalue',
        'created_at',
        'customunit',
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

    public static function addOrUpdateMultipleRecordsFromAttributeArray(int $printerId, array $attributesArr)
    {
        $addedOrUpdatedPrinterAttributes = [];
        foreach (array_keys($attributesArr) as $attributeVariableName) {
            $attributeAdded = self::addOrUpdate(
                $printerId,
                $attributeVariableName,
                $attributesArr[$attributeVariableName]
            );
            if (!is_null($attributeAdded)) {
                $addedOrUpdatedPrinterAttributes[] = $attributeAdded;
            }
        }

        return $addedOrUpdatedPrinterAttributes;
    }

    /**
     * @param int $printerId
     * @param string $attributeVariableName
     * @param $value
     * @return PrinterAttribute|null
     * @throws Exception
     */
    public static function addOrUpdate(int $printerId, string $attributeVariableName, $value): ?PrinterAttribute
    {
        if (false) {
            print "\n Adding/updating printer <#{$printerId}> attribute <{$attributeVariableName}>" .
                " with value <{$value}>";
        }
        $printerattribute = null;
        try {
            if (DB::table('printers')->where('id', $printerId)->count() < 1) {
                throw new Exception(
                    'Error: cannot add or update printer attribute.'
                    . ' Printer with the given id <' . $printerId . '> does not exists.'
                );
            }

            $attribute = Attribute::findByVariableName($attributeVariableName);
            if (is_null($attribute)) {
                throw new Exception(
                    'Error: cannot add or update printer attribute.'
                    . ' Printer with the name <' . $attributeVariableName . '> does not exists.'
                );
            }

            if ($attribute->takesValueFromSet()) {
                if (!$attribute->hasValueInSet($value)) {
                    throw new Exception(
                        'Error: cannot add or update printer attribute.'
                        . ' Invalid value <' . $value . '> for <' . $attributeVariableName . '> attribute '
                    );
                }
            }

            $printerattribute = PrinterAttribute::where('printer_id', $printerId)
                                                ->where('attribute_id', $attribute->id)
                                                ->get()
                                                ->first();
            $printerattributeArr = [
                'id'                 => (is_null($printerattribute) ? null : $printerattribute->id),
                'attribute_id'       => $attribute->id,
                'printer_id'         => $printerId,
                'attribute_value_id' => $attribute->takesValueFromSet()
                    ? $attribute->getAttributeValueFromSetByValue($value)->id
                    : null,
                'customvalue'        => !$attribute->takesValueFromSet()
                    ? $value
                    : null,
                'created_at'         => Carbon::now(),
            ];

            if (is_null($printerattribute)) {
                $printerattribute = PrinterAttribute::create($printerattributeArr);
            } else {
                $printerattribute->update($printerattributeArr);
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
            return null;
        }

        return $printerattribute;
    }
}
