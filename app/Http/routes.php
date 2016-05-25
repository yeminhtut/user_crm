<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/users', 'UserController@index');

Route::get('/user_profile',['uses' => 'UserController@test_fn'])->name('test_profile_fn');

Route::get('/{user_name}',['uses' => 'UserController@profile'])->name('user_profile');

Route::get('/manage/info',['uses' => 'UserController@edit_profile'])->name('edit_user_info');

//Route::get('/user/{id}', 'UserController@profile');

//Route::get('/user/{id}', ['uses'=>'UserController@profile'])->name('user_profile');
//Route::get('/user/edit/{id}', ['uses'=>'UserController@edit_profile'])->name('user_edit_profile');

Route::any('/register', ['uses'=>'Auth\AuthController@getRegister'])->name('registration_form');
Route::post('/register', ['uses'=>'Auth\AuthController@postRegister'])->name('do_register');