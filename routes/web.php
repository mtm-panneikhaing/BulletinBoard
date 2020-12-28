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

Route::get('/','PostController@detail');

Route::get('/posts','PostController@detail');

Route::get('/posts/create','PostController@create');

Route::get('/posts/add','PostController@add');

Route::post('/posts/add/confirm','PostController@confirmPost');

Route::post('/posts/add/confirm/insert','PostController@insert');

Route::get('/posts/update/{id}','PostController@update');

Route::post('/posts/update/confirm','PostController@updateConfirm');

Route::post('/posts/update/confirm/modify','PostController@updatePost');

Route::post('/posts/delete', 'PostController@delete');

Route::post('/posts/search', 'PostController@search');

Route::get('/posts/download', 'PostController@export');

Route::post('/posts/upload', 'PostController@import');

//users
Route::get('/users/list','UserController@userList');

Route::get('/users/profile','UserController@userProfile');

Route::get('/users/create','UserController@create');

Route::post('/users/create/confirm','UserController@userConfirm');

Route::post('users/create/confirm/insert','UserController@userInsert');

Route::get('/users/detail','UserController@userDetail');

Route::get('/users/update','UserController@userUpdate');

// Route::get('/users/update','UserController@userUpdate');

Route::post('/users/update','UserController@userUpdate');

Route::post('/users/update/confirm','UserController@updateConfirm');

Route::get('/users/edit','UserController@editProfile');

Route::get('/changePassword','UserController@changePassword');

Route::post('/users/password/change','UserController@passwordChange');

Route::get('/changePassword/confirm','UserController@passwordConfirm');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
