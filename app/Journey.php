<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    public function review()
    {
        return $this->hasMany('App\Review');
    }
}
