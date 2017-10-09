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

Route::get('/developers', function () {
    return view('developers');
});

Route::post('/post/store', 'PostController@store');

Auth::routes();

#Route::get('/createpost', 'PostController@index')->name('createpost');

#Route::get('/profile', 'UserController@index')->name('profile');
