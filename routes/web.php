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


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/posts', 'PostController@index');

Route::get('post/create', 'PostController@create');

Route::get('post/{url}', 'PostController@show');

Route::get('/developer/{name}','UserController@show');

Route::post('/post/store', 'PostController@store');

Route::post('posts/search/{term}', 'PostController@search');

// Tomments route
Route::resource('comment', 'CommentController');

// Tags route
Route::get('/tag/{name}', 'TagController@show');

// User rout
Route::get('/user/profile', 'UserController@profile');
Route::post('/user/image', 'UserController@imageUpload');

Auth::routes();
