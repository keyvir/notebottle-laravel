<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->locale('ko')->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->locale('ko')->diffForHumans();
    }
}
