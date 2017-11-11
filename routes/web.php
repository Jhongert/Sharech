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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Post route
Route::get('/posts', 'PostController@index');
Route::get('/post/create', 'PostController@create');
Route::get('/post/{url}', 'PostController@show');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/store', 'PostController@store');
Route::post('/posts/search/{term}', 'PostController@search');
Route::put('/post/{id}', 'PostController@update');
Route::get('/posts/getPosts/{offset}', 'PostController@getPosts');
Route::get('/posts/getPostsByTagName/{tag}/{offset?}', 'PostController@getPostsByTagName');
Route::get('/posts/getPostsByUserName/{tag}/{offset?}', 'PostController@getPostsByUserName');
Route::get('/posts/tag/{name}', 'PostController@getPostsByTagName');
Route::get('/posts/user/{name}','PostController@getPostsByUserName');

// Comments route
Route::resource('comment', 'CommentController');

// User route
Route::get('/user/profile', 'UserController@profile');
Route::post('/user/image', 'UserController@imageUpload');
Route::post('/user/password', 'UserController@changePassword');
Route::post('/user/validate/{name}', 'UserController@validateUserName');


Auth::routes();
