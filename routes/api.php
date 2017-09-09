<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => '/scrapbook/',
    //'middleware' => 'auth:api',
], function () {
    // notes crud
    Route::get('', 'NoteController@index');
    Route::get('{id}', 'NoteController@show');
    Route::post('{id}', 'NoteController@store');
    Route::put('{id}', 'NoteController@update');
    Route::delete('{id}', 'NoteController@destroy');

    // tags crud
    Route::get('tags', 'TagController@index');
});
