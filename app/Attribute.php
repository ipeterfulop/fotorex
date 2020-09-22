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
        'name',
        'label',
        'is_computed',
        'created_at',
        'updated_at',
    ];

    public function attribute_value_set()
    {
        return $this->belongsTo(AttributeValueSet::class);
    }

}
