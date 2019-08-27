<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(){
        $albums = Album::all();
        return response($albums);
    }

    public function getPhotos($albumId){
        $photos = Album::find($albumId)->photos()->get();
        return response($photos);
    }
}
