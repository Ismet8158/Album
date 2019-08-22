<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = false;

    public function album(){
        return $this->belongsTo('App\Models\Album');
    }
}
