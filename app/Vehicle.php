<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    public function journey(){
        return $this->hasMany('App\Journey', 'id');
    }
}
