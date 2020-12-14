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
        'is_richtext',
        'productfamily',
        'unit',
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
        return ! is_null($this->attribute_value_set_id);
    }

    public function hasValueInSet($value): bool
    {
        if (! $this->takesValueFromSet()) {
            return false;
        }

        return ! is_null(self::getAttributeValueFromSetByValue($value));
    }

    public function hasLabelInSet($label): bool
    {
        if (! $this->takesValueFromSet()) {
            return false;
        }

        return ! is_null(self::getAttributeValueFromSetByLabel($label));
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
        if (! $this->takesValueFromSet()) {
            return [];
        }
        return $this->attribute_value_set->attribute_values->filter(function ($item) {
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
        return $query->where(function ($query) {
            return $query->where('productfamily', '=', Productfamily::PRINTERS_ID)->orWhere('productfamily', '=', null);
        });
    }

    public function scopeForDisplays($query)
    {
        return $query->where(function ($query) {
            return $query->where('productfamily', '=', Productfamily::DISPLAYS_ID)->orWhere('productfamily', '=', null);
        });
    }
}
