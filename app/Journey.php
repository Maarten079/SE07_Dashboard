<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
