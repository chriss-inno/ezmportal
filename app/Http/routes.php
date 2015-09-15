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
Route::get('logout',['middleware' => 'auth', 'uses' =>'UserController@logout']);
Route::get('home',['middleware' => 'auth', 'uses' =>'HomeController@index']);

//Process login
Route::get('login','UserController@login');
Route::post('login','UserController@postLogin');


//User modules
Route::get('register','UserController@registration');
Route::post('register','UserController@postRegister');


//Branches
Route::get('branches',['middleware' => 'auth', 'uses' =>'BranchController@index']);
Route::get('branches/create',['middleware' => 'auth', 'uses' =>'BranchController@create']);
Route::post('branches/create',['middleware' => 'auth', 'uses' =>'BranchController@store']);
Route::get('branches/remove/{id}',['middleware' => 'auth', 'uses' =>'BranchController@destroy']);
Route::get('branches/edit/{id}',['middleware' => 'auth', 'uses' =>'BranchController@edit']);
Route::post('branches/edit',['middleware' => 'auth', 'uses' =>'BranchController@update']);
Route::get('branches/reports',['middleware' => 'auth', 'uses' =>'BranchController@index']);


//Departments

Route::get('departments/reports',['middleware' => 'auth', 'uses' =>'DepartmentController@index']);
Route::get('departments',['middleware' => 'auth', 'uses' =>'DepartmentController@index']);
Route::get('departments/create',['middleware' => 'auth', 'uses' =>'DepartmentController@create']);
Route::post('departments/create',['middleware' => 'auth', 'uses' =>'DepartmentController@store']);
Route::get('departments/edit/{id}',['middleware' => 'auth', 'uses' =>'DepartmentController@edit']);
Route::post('departments/edit',['middleware' => 'auth', 'uses' =>'DepartmentController@update']);
Route::get('departments/remove/{id}',['middleware' => 'auth', 'uses' =>'DepartmentController@destroy']);
Route::get('departments/show/{id}',['middleware' => 'auth', 'uses' =>'DepartmentController@show']);

//Users
Route::get('users/reports',['middleware' => 'auth', 'uses' =>'UserController@index']);
Route::get('users',['middleware' => 'auth', 'uses' =>'UserController@index']);
Route::get('users/create',['middleware' => 'auth', 'uses' =>'UserController@create']);
Route::post('users/create',['middleware' => 'auth', 'uses' =>'UserController@store']);
Route::get('users/edit/{id}',['middleware' => 'auth', 'uses' =>'UserController@edit']);
Route::post('users/edit',['middleware' => 'auth', 'uses' =>'UserController@update']);
Route::get('users/remove/{id}',['middleware' => 'auth', 'uses' =>'UserController@destroy']);
Route::get('users/show/{id}',['middleware' => 'auth', 'uses' =>'UserController@show']);
