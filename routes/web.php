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

// Home route
Route::get('/test', function(){
	return view('test');
});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Post route
Route::get('/posts', 'PostController@index');
Route::get('post/create', 'PostController@create');
Route::get('post/{url}', 'PostController@show');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/store', 'PostController@store');
Route::post('posts/search/{term}', 'PostController@search');
Route::put('/post/{id}', 'PostController@update');

Route::get('/developer/{name}','UserController@show');

// Comments route
Route::resource('comment', 'CommentController');

// Tags route
Route::get('/tag/{name}', 'TagController@show');

// User rout
Route::get('/user/profile', 'UserController@profile');
Route::post('/user/image', 'UserController@imageUpload');
Route::post('/user/password', 'UserController@changePassword');
Route::post('/user/validate/{name}', 'UserController@validateUserName');

Auth::routes();
