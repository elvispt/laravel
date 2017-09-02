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

Route::get('/', function () {
    $userModel = new \App\Models\User();
    $user = $userModel->with([
        'notes',
        'tags'
    ])->first();
    return $user;
});

Route::get('/notes', function () {
    $note = new \App\Models\Note();
    return $note->with(['tags'])->first();
});

Route::get('/tags', function () {
    return \App\Models\Tag::all();
});
