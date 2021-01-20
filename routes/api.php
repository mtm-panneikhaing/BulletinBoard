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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->all();
});

Route::get('post/list', 'Api\PostController@detail');

Route::post('/post/create', 'Api\PostController@confirmPost');

Route::post('/post/create/confirm', 'Api\PostController@insert');

Route::delete('/delete', 'Api\PostController@delete');

//Route::get('/post/update{id}', 'Api\PostController@update');

Route::post('/post/updateConfirm', 'Api\PostController@updateConfirm');

Route::post('/post/update', 'Api\PostController@updatePost');

Route::delete('/post/delete{id}', 'Api\PostController@delete');

Route::get('/download', 'Api\PostController@export');

Route::post('/changePassword', 'Api\UserController@passwordChange');





Route::post('/auth/login', 'Api\LoginController@login');

// Route::post('register', 'Api\LoginController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('get-details', 'Api\LoginController@getDetails');
});

Route::group([
      'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'LoginController@logout');
        Route::get('user', 'LoginController@user');
    });
 /**
  * User
  *
  */
Route::get('user/list', 'Api\UserController@userList');

Route::post('/user/create', 'Api\UserController@userConfirm');

Route::post('/user/create/confirm', 'Api\UserController@userInsert');

Route::delete('/user/delete{id}', 'Api\UserController@userDelete');

Route::post('/user/updateConfirm', 'Api\UserController@updateConfirm');

Route::post('/user/update', 'Api\UserController@update');
