<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oldarticleslug extends Model
{
    protected $fillable = ['slug', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
