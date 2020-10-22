<?php

namespace App;

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

    public static function findByVariableName($variablename)
    {
    }

    public function attribute_value_set()
    {
        return $this->belongsTo(AttributeValueSet::class);
    }

    public function takesValueFromSet()
    {
        return !is_null($this->attribute_value_set_id);
    }

    public function hasValueInSet($value)
    {
    }

    public function hasLabelInSet($value)
    {
    }

    public function getAttributeValueFromSet()
    {
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
}
