<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(){
        return Album::all();
    }

    public function getPhotos($albumId){
        $photos = Cache::remember('albums'.$albumId, Carbon::now()->addMinutes(10), function ($albumId) {
            return Album::find($albumId)->photos;
          });
        return response([ "photos" => $photos, "admin" => Gate::denies("get-favorites")]);
    }

    public function getAlbumTitle($id){
        return Album::find($id)->title;
    } 
}
