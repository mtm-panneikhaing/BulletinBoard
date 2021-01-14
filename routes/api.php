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
