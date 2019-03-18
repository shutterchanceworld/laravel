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
    return 'Hello World';
});

Route::get('/users','UserController@index')
	->name('users.index');

Route::get('/users/details/{user}', 'UserController@show')
	->where('user','\d+')
	->name('users.show');

Route::get('/users/new','UserController@create')
	->name('users.create');

Route::post('/users/', 'UserController@store');	

Route::get('/users/details/{user}/edit','UserController@edit')
	->name('users.edit');

Route::put('/users/details/{user}','UserController@update');

Route::get('/greeting/{name}/{nickname?}', 'WelcomeUserController');

Route::delete('/users/details/{user}','UserController@destroy')
	->name('users.destroy');
