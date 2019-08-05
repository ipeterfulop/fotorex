<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oldslug extends Model
{
    protected $fillable = ['slug', 'redirect_to'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
