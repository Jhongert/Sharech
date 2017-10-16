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

Route::get('/developers', function () {
    return view('developers');
});

Route::post('/post/store', 'PostController@store');

Route::post('posts/search/{term}', 'PostController@search');

// comments route
Route::resource('comment', 'CommentController');
Auth::routes();
