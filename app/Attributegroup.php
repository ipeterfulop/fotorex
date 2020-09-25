<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributegroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'variable_name',
        'created_at',
        'updated_at',
    ];
}
