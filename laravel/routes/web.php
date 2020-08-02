<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@index');

//TEMPLATE
Route::get('/template','TemplateController@template');
Route::get('/ctemplate','TemplateController@ctemplate');

//PERSONAL PROFILE
Route::get('/pProfile','pProfileController@pProfile');

//CLUB
Route::get('/club','Club\ClubController@club');
Route::get('/club/history','Club\ClubController@history');
Route::get('/club/about','Club\ClubController@about');

//ACTIVITY
Route::get('/club/activity','Club\ActivityController@activity');
Route::get('/club/aActivity','Club\ActivityController@aActivity');
Route::get('/club/pActivity','Club\ActivityController@pActivity');
Route::get('/club/rActivity','Club\ActivityController@rActivity');

//COOPERATE SYSTEM
Route::get('/club/cSystem','Club\cSystemController@cSystem');

//MEDIA
Route::get('/club/media','Club\MediaController@meida');
Route::get('/club/picture','Club\MediaController@picture');
Route::get('/club/video','Club\MediaController@video');
