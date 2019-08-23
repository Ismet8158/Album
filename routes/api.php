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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('albums', 'AlbumController@index');
    Route::get('albums/{id}', 'AlbumController@getPhotos');
    Route::get('album/{id}', 'PhotoController@getAlbum');
});
Route::post('login', 'LoginController@authenticate');
Route::post('check', 'LoginController@isAuthenticated');
Route::post('register', 'RegisterController@create');