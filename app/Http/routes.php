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
Route::get('getModules/{id}','DepartmentController@getModules');


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
Route::get('units/{id}',['middleware' => 'auth', 'uses' =>'UnitController@index']);
Route::get('units/create',['middleware' => 'auth', 'uses' =>'UnitController@create']);
Route::post('units/create',['middleware' => 'auth', 'uses' =>'UnitController@store']);
Route::get('units/remove/{id}',['middleware' => 'auth', 'uses' =>'UnitController@destroy']);
Route::get('units/edit/{id}',['middleware' => 'auth', 'uses' =>'UnitController@edit']);
Route::post('units/edit',['middleware' => 'auth', 'uses' =>'UnitController@update']);

//Services
Route::get('services',['middleware' => 'auth', 'uses' =>'ServicesController@index']);
Route::get('services/create',['middleware' => 'auth', 'uses' =>'ServicesController@create']);
Route::post('services/create',['middleware' => 'auth', 'uses' =>'ServicesController@store']);
Route::get('services/list',['middleware' => 'auth', 'uses' =>'ServicesController@listService']);
Route::post('services/edit',['middleware' => 'auth', 'uses' =>'ServicesController@update']);
Route::get('services/edit/{id}',['middleware' => 'auth', 'uses' =>'ServicesController@edit']);

//Service Logs
Route::get('serviceslogs',['middleware' => 'auth', 'uses' =>'ServiceLogController@index']);
Route::get('serviceslogs/today',['middleware' => 'auth', 'uses' =>'ServiceLogController@serviceToday']);
Route::get('serviceslogs/create',['middleware' => 'auth', 'uses' =>'ServiceLogController@create']);
Route::post('serviceslogs/create',['middleware' => 'auth', 'uses' =>'ServiceLogController@store']);
Route::post('serviceslogs/edit',['middleware' => 'auth', 'uses' =>'ServiceLogController@update']);
Route::get('serviceslogs/edit/{id}',['middleware' => 'auth', 'uses' =>'ServiceLogController@edit']);
Route::get('serviceslogs/remove/{id}',['middleware' => 'auth', 'uses' =>'ServiceLogController@destroy']);
Route::get('serviceslogs/show/{id}',['middleware' => 'auth', 'uses' =>'ServiceLogController@show']);


//Query management
Route::get('queries/create',['middleware' => 'auth', 'uses' =>'TaskQueryController@create']);
Route::post('queries/create',['middleware' => 'auth', 'uses' =>'TaskQueryController@store']);
Route::get('queries/mytask',['middleware' => 'auth', 'uses' =>'TaskQueryController@index']);
Route::get('queries/progress',['middleware' => 'auth', 'uses' =>'TaskQueryController@progress']);
Route::get('queries/history',['middleware' => 'auth', 'uses' =>'TaskQueryController@history']);
Route::get('queries/report',['middleware' => 'auth', 'uses' =>'TaskQueryController@report']);
