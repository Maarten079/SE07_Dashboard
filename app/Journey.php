<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    public function reviews()
    {
        return $this->hasMany('App\Review', 'id');
    }
    public function vehicle(){
        return $this->hasOne('App\Vehicle', 'vehicle_id');
    }
}
