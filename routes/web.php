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

Route::get('/','Admin\LoginController@index');
Route::get('/permission', 'Admin\LoginController@permission');
Route::get('/login/out', 'Admin\LoginController@logout');
Route::get('/login', 'Admin\LoginController@index');
Route::post('/login', 'Admin\LoginController@check');

Route::middleware(['role'])->group(function () {

Route::get('/profile', 'Admin\Profile@index');

Route::get('/user', 'Admin\Users@index');
Route::get('/user/index/{role}/{id}', 'Admin\Users@index');
Route::get('/user/index/{role}', 'Admin\Users@index');
Route::get('/user/index', 'Admin\Users@index');
Route::get('/user/adduser', 'Admin\Users@create');
Route::get('/user/showuser/{id}', 'Admin\Users@edit');
Route::get('/user/payment/{id}', 'Admin\Users@payment');
Route::get('/user/payment/{id}/{page}', 'Admin\Users@payment');
Route::get('/user/roles', 'Admin\Users@roles');
Route::get('/user/roleedit/{id_role}', 'Admin\Users@roleedit');
Route::get('/user/addrole', 'Admin\Users@addrole');

Route::get('/area', 'Admin\Areas@index');
Route::get('/area/index/{id}', 'Admin\Areas@index');
Route::get('/area/index', 'Admin\Areas@index');
Route::get('/area/addarea', 'Admin\Areas@create');
Route::get('/area/edit/{id}', 'Admin\Areas@edit');

Route::get('/gate', 'Admin\Gates@index');
Route::get('/gate/index/{id}', 'Admin\Gates@index');
Route::get('/gate/index', 'Admin\Gates@index');
Route::get('/gate/addgate', 'Admin\Gates@create');
Route::get('/gate/edit/{id}', 'Admin\Gates@edit');


Route::get('/admission', 'Admin\Admissions@index');
Route::get('/admission/index/{id}', 'Admin\Admissions@index');
Route::get('/admission/index', 'Admin\Admissions@index');
Route::get('/admission/addadmission', 'Admin\Admissions@create');
Route::get('/admission/edit/{id}', 'Admin\Admissions@edit');


Route::get('/ticket', 'Admin\Tickets@index');
Route::get('/ticket/index/{id}', 'Admin\Tickets@index');
Route::get('/ticket/index', 'Admin\Tickets@index');
Route::get('/ticket/addticket', 'Admin\Tickets@create');
Route::get('/ticket/edit/{id}', 'Admin\Tickets@edit');

//posts



Route::post('/user/store', 'Admin\Users@store');
Route::post('/user/update/{id}', 'Admin\Users@update');
Route::post('/user/storerole', 'Admin\Users@storerole');
Route::post('/user/updaterole/{id}', 'Admin\Users@updaterole');

Route::post('/update/delete', 'Admin\Update@delete');
Route::post('/update/udpdatetd', 'Admin\Update@udpdatetd');
Route::post('/update/edittable', 'Admin\Update@edittable');
Route::post('/update/updaterow', 'Admin\Update@updaterow');
Route::post('/upload/files', 'Admin\Upload@files');

Route::post('/area/store', 'Admin\Areas@store');
Route::post('/area/update/{id}', 'Admin\Areas@update');

Route::post('/gate/store', 'Admin\Gates@store');
Route::post('/gate/update/{id}', 'Admin\Gates@update');

Route::post('/admission/store', 'Admin\Admissions@store');
Route::post('/admission/update/{id}', 'Admin\Admissions@update');

Route::post('/ticket/store', 'Admin\Tickets@store');
Route::post('/ticket/update/{id}', 'Admin\Tickets@update');
});