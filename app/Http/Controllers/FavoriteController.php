<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Jobs\AlbumJob;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index($user_id){
        $favorites = Favorite::where("user_id", $user_id)->get();
        $result = [];
        foreach ($favorites as $favorite) {
           $result[] = Favorite::where("photo_id", $favorite->photo_id)->first()->photo;
        }
        return response($result);
    }

    public function store(Request $request){
        // $favorites = Favorite::create([
        //     "photo_id" => $request->photo_id,
        //     "user_id" => $request->user_id
        // ]);
        $job = (new AlbumJob($request->photo_id, $request->user_id))->delay(Carbon::now()->addSeconds(15));
        dispatch($job);
        return response("added");
    }

    public function delete(Request $request){
        $favorites = Favorite::where("user_id", $request->user_id)->where("photo_id", $request->photo_id);
        $favorites->delete();
        return response("deleted");
    }
}
