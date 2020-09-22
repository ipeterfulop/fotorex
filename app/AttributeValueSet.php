<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValueSet extends Model
{
    use HasFactory;

    protected $table = 'attribute_value_sets';
    protected $fillable = [
        'id',
        'name',
        'is_enabled',
        'created_at',
        'updated_at',
    ];

    public function attribute_values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
