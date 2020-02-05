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

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@index'
));
//rutas del controller de videos
Route::get('/crear-video',array(
    'as' => 'createVideo',
    'middleware' => 'auth',
    'uses' => 'videoController@createVideo'
));

Route::post('/guardar-video',array(
    'as' => 'saveVideo',
    'middleware' => 'auth',
    'uses' => 'videoController@saveVideo'
));

Route::post('/update-video/{video_id}',array(
    'as' => 'updateVideo',
    'middleware' => 'auth',
    'uses' => 'videoController@update'
));

Route::get('/miniatura/{filename}', array(
    'as'=>'imageVideo',
    'uses'=>'VideoController@getImage'
));

Route::get('/video/{video_id}',array(
    'as' => 'detailVideo',
    'uses' => 'VideoController@getVideoDetail'
));

Route::get('/video-file/{filename}', array(
    'as' => 'fileVideo',
    'uses' => 'VideoController@getVideo'
));

Route::get('/delete-video/{video_id}', array(
    'as'=>'videoDelete',
    'middleware' => 'auth',
    'uses'=>'VideoController@delete'
));

Route::get('/buscar/{search?}/{filter?}',[
    'as' => 'videoSearch',
    'uses' => 'VideoController@search'
]);

Route::post('/comment', array(
    'as' => 'comment',
    'middleware' => 'auth',
    'uses' => 'CommentController@store'
));

Route::get('/delete-comment/{comment_id}', array(
    'as' => 'commentDelete',
    'middleware' => 'auth',
    'uses' => 'CommentController@delete'
));


Route::get('/editar-video/{video_id}', array(
    'as'=>'videoEdit',
    'middleware' => 'auth',
    'uses'=>'VideoController@edit'
));
//users
Route::get('/canal/{user_id}', array(
    'as'=> 'channel',
    'uses' => 'UserController@channel'
));

//ENDusers

//Ruta para borrar la cache de laravel

Route::get('/clear-cache', function () {
    $code = Artisan::call('cache:clear');
});