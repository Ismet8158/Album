<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function getAlbum($id){
        $album = Photo::find($id,'album_id')->album()->get();
        return response($album);
    }
}
