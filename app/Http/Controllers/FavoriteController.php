<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(){
        $favorites = Favorite::all();
        foreach ($favorites as $favorite) {
           $result[] = Favorite::find($favorite->photo_id, "id")->favorite()->get();
        }
        return response($result);
    }

    public function store(Request $request){
        $favorites = Favorite::create([
            "photo_id" => $request->photo_id,
            "user_id" => $request->user_id
        ]);
        return response($favorites);
    }
}
