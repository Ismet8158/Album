<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('albums', 'AlbumController@index');
    Route::get('albums/{id}', 'AlbumController@getPhotos');
    Route::get('album/{id}', 'AlbumController@getAlbumTitle');
    Route::group(['middleware' => 'role:admin'], function(){
        Route::get('favorites/{id}', 'FavoriteController@index');
        Route::post('addfavorites', 'FavoriteController@store');
        Route::post('favorites', 'FavoriteController@delete');
    }
    );
});
Route::post('login', 'LoginController@authenticate');
Route::post('register', 'RegisterController@create');