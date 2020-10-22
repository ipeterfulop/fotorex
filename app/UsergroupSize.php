<?php

namespace App;

use App\Traits\hasIsEnabledProperty;
use Illuminate\Database\Eloquent\Model;

class UsergroupSize extends Model
{
    use hasIsEnabledProperty;

    protected $appends = ['value', 'label'];

    public function getValueAttribute()
    {
        return $this->id;
    }

    public function getLabelAttribute()
    {
        return $this->name;
    }

}
