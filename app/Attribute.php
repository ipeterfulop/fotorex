<?php

namespace App;

use App\Helpers\Productfamily;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'attribute_value_set_id',
        'attributegroup_id',
        'name',
        'label',
        'is_computed',
        'position_at_product_comparison',
        'created_at',
        'updated_at',
    ];


    public function attribute_value_set()
    {
        return $this->belongsTo(AttributeValueSet::class);
    }

    /**
     * @param string $variablename
     * @return Attribute|null
     */
    public static function findByVariableName(string $variablename): ?Attribute
    {
        return Attribute::where('variable_name', $variablename)
                        ->get()
                        ->first();
    }

    public function takesValueFromSet(): bool
    {
        return !is_null($this->attribute_value_set_id);
    }

    public function hasValueInSet($value): bool
    {
        if (!$this->takesValueFromSet()) {
            return false;
        }

        return !is_null(self::getAttributeValueFromSetByValue($value));
    }

    public function hasLabelInSet($label): bool
    {
        if (!$this->takesValueFromSet()) {
            return false;
        }

        return !is_null(self::getAttributeValueFromSetByLabel($label));
    }

    public function getAttributeValueFromSetByValue($value)
    {
        return AttributeValue::where('attribute_value_set_id', $this->attribute_value_set_id)
                             ->where('value', $value)
                             ->get()
                             ->first();
    }

    public function getAttributeValueFromSetByLabel($label)
    {
        return AttributeValue::where('attribute_value_set_id', $this->attribute_value_set_id)
                             ->where('label', $label)
                             ->get()
                             ->first();
    }

    public function getAttributeValuesFromSetWithoutNA()
    {
        if (!$this->takesValueFromSet()) {
            return [];
        }
        return $this->attribute_value_set->attribute_values->filter(function($item) {
            return $item->value != 0;
        });
    }

    public function scopeForProductfamily($query, $productfamily)
    {
        if ($productfamily == Productfamily::PRINTERS_ID) {
            return $query->forPrinters();
        }
        if ($productfamily == Productfamily::DISPLAYS_ID) {
            return $query->forDisplays();
        }
        throw new \Exception('Nincs ilyen termékcsalád: '.$productfamily);
    }

    public function scopeForPrinters($query)
    {
        return $query->whereIn('id', [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36]);
    }

    public function scopeForDisplays($query)
    {
        return $query->whereIn('id', [1,2,3]);
    }
}
