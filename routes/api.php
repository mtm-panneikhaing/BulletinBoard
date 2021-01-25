<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//login
Route::post('/auth/login', 'Api\LoginController@login');

//logout
Route::middleware('auth:api')->post('/auth/logout', 'Api\LoginController@logout');

//post List

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/post/list', 'Api\PostController@detail');

    Route::post('/post/create', 'Api\PostController@confirmPost');
        
    Route::post('/post/createConfirm', 'Api\PostController@insert');

    Route::post('/post/updateConfirm', 'Api\PostController@updateConfirm');
        
    Route::post('/post/update', 'Api\PostController@updatePost');
        
    Route::delete("/post/delete/{id}", 'Api\PostController@delete');
        
    Route::post('/post/import', 'Api\PostController@import');
});
  /**
  * User
  *
  */
  Route::group(['middleware' => 'auth:api'], function () {
      Route::get('user/list', 'Api\UserController@userList');

      Route::post('/user/create', 'Api\UserController@userConfirm');

      Route::post('/user/create/confirm', 'Api\UserController@userInsert');

      Route::delete('/user/delete/{id}', 'Api\UserController@userDelete');

      Route::post('/user/updateConfirm', 'Api\UserController@updateConfirm');

      Route::post('/user/update', 'Api\UserController@update');
      Route::post('/changePassword', 'Api\UserController@passwordChange');
  });
