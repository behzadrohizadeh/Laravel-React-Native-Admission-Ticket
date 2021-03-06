<?php

use Illuminate\Http\Request;

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

Route::group(array('prefix' => 'v1'), function () {

  
  Route::post('/login', 'Api\UserController@login')->middleware('token');
  Route::post('/checkticket', 'Api\UserController@checkticket')->middleware('token');
  Route::post('/currentstate', 'Api\UserController@currentstate')->middleware('token');

  


});

