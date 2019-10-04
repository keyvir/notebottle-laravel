<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    //
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
