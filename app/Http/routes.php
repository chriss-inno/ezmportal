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

//Process login
Route::get('login','UserController@login');
Route::post('login','UserController@postLogin');


//User modules
Route::get('register','UserController@registration');
Route::post('register','UserController@postRegister');
Route::get('logout',['middleware' => 'auth', 'uses' =>'UserController@logout']);
Route::get('home',['middleware' => 'auth', 'uses' =>'HomeController@index']);

//Branches
Route::get('branches',['middleware' => 'auth', 'uses' =>'BranchController@index']);
Route::get('branches/create',['middleware' => 'auth', 'uses' =>'BranchController@create']);
Route::post('branches/create',['middleware' => 'auth', 'uses' =>'BranchController@store']);
Route::get('branches/remove/{id}',['middleware' => 'auth', 'uses' =>'BranchController@destroy']);
Route::get('branches/edit/{id}',['middleware' => 'auth', 'uses' =>'BranchController@edit']);
Route::post('branches/edit',['middleware' => 'auth', 'uses' =>'BranchController@update']);
Route::get('branches/reports',['middleware' => 'auth', 'uses' =>'BranchController@index']);
Route::get('getDepartment/{id}','BranchController@getDepartment');

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

//Modules
Route::resource('modules','ModuleController');

//Units controller
Route::get('units/{id}','UnitController@index');
Route::get('units/create','UnitController@create');
Route::post('units/create','UnitController@store');
Route::get('units/remove/{id}','UnitController@destroy');
Route::get('units/edit/{id}','UnitController@edit');
Route::post('units/edit','UnitController@update');

//Services
Route::get('services','ServicesController@index');
Route::get('services/create','ServicesController@create');
Route::post('services/create','ServicesController@store');
Route::get('services/list','ServicesController@listService');
Route::post('services/edit','ServicesController@update');
Route::get('services/edit/{id}','ServicesController@edit');

//Service Logs
Route::get('serviceslogs','ServiceLogController@index');
Route::get('serviceslogs/today','ServiceLogController@serviceToday');
Route::get('serviceslogs/create','ServiceLogController@create');
Route::post('serviceslogs/create','ServiceLogController@store');
Route::post('serviceslogs/edit','ServiceLogController@update');
Route::get('serviceslogs/edit/{id}','ServiceLogController@store');
Route::get('serviceslogs/remove/{id}','ServiceLogController@destroy');

