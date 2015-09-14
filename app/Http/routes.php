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

Route::get('/','UserController@login');
Route::get('logout','UserController@logout');
Route::get('home',['middleware' => 'auth', 'uses' =>'HomeController@index']);

//Process login
Route::get('login','UserController@login');
Route::post('login','UserController@postLogin');


//User modules
Route::get('register','UserController@registration');
Route::post('register','UserController@postRegister');
Route::resource('users','UserController');


//Branches
Route::get('branches','BranchController@index');
Route::get('branches/create','BranchController@create');
Route::post('branches/create','BranchController@update');
Route::get('branches/edit/{id}','BranchController@edit');
Route::post('branches/edit','BranchController@update');

//Departments

Route::get('departments','DepartmentController@index');
Route::get('departments/create','DepartmentController@create');
Route::get('departments/edit/{id}','DepartmentController@edit');
Route::post('departments/edit','DepartmentController@update');
Route::get('departments/remove/{id}','DepartmentController@destroy');
Route::get('departments/show/{id}','DepartmentController@show');