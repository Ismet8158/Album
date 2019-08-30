<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;
    public $fillable = [ "photo_id", "user_id" ];

    public function photo(){
        return $this->belongsTo('App\Models\Photo');
    }
}
