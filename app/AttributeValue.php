<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    const YES_ID = 1001;
    const NO_ID = 1002;

    protected $table = 'attribute_values';
    protected $fillable = [
        "id",
        "attribute_set_id",
        "value",
        "label",
        'created_at',
        'updated_at',
    ];

    public function attribute_value_set(){
        return $this->belongsTo(AttributeValueSet::class);
    }
}
