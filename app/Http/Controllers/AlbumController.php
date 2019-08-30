<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(){
        return Album::all();
    }

    public function getPhotos($albumId){
        return Album::find($albumId)->photos;
    }

    public function getAlbumTitle($id){
        return Album::find($id)->title;
    } 
}
