<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Auto generation of timestamps for created_at and updated_at is forced.
    public $timestamps = true;

    public function journey()
    {
        return $this->hasOne('App\Journey');
    }
}
