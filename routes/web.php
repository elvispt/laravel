<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/scrapbook/',
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

Route::get('/', 'NoteController@latest');
