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

Route::post('forgotPassword','UserController@forgotPassword');



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
Route::get('users/query/{id}',['middleware' => 'auth', 'uses' =>'UserController@userQuery']);
Route::post('users/query',['middleware' => 'auth', 'uses' =>'UserController@postUserQuery']);

Route::get('users/query/{id}',['middleware' => 'auth', 'uses' =>'UserController@userQuery']);
Route::post('users/query',['middleware' => 'auth', 'uses' =>'UserController@postUserQuery']);

Route::get('users/personal/{id}',['middleware' => 'auth', 'uses' =>'UserController@userPersonal']);
Route::post('users/personal',['middleware' => 'auth', 'uses' =>'UserController@postUserPersonal']);

Route::get('users/department/{id}',['middleware' => 'auth', 'uses' =>'UserController@userDepartment']);
Route::post('users/department',['middleware' => 'auth', 'uses' =>'UserController@postUserDepartment']);

Route::get('users/password/{id}',['middleware' => 'auth', 'uses' =>'UserController@userPassword']);
Route::post('users/password',['middleware' => 'auth', 'uses' =>'UserController@postUserPassword']);

Route::get('users/rights/{id}',['middleware' => 'auth', 'uses' =>'UserController@changeUserRights']);
Route::post('users/rights',['middleware' => 'auth', 'uses' =>'UserController@postChangeUserRights']);

Route::get('users/exemption/{id}',['middleware' => 'auth', 'uses' =>'UserController@changeUserExemption']);
Route::post('users/exemption',['middleware' => 'auth', 'uses' =>'UserController@postChangeUserExemption']);


//Query exception

//User rights
Route::get('user/rights/reports',['middleware' => 'auth', 'uses' =>'RightsController@index']);
Route::get('user/rights/create',['middleware' => 'auth', 'uses' =>'RightsController@create']);
Route::post('user/rights/create',['middleware' => 'auth', 'uses' =>'RightsController@store']);
Route::get('user/rights',['middleware' => 'auth', 'uses' =>'RightsController@index']);
Route::get('user/rights/edit/{id}',['middleware' => 'auth', 'uses' =>'RightsController@edit']);
Route::post('user/rights/edit',['middleware' => 'auth', 'uses' =>'RightsController@update']);
Route::get('user/rights/remove/{id}',['middleware' => 'auth', 'uses' =>'RightsController@destroy']);
Route::get('user/rights/roles/{id}',['middleware' => 'auth', 'uses' =>'RightsController@rightRoles']);
Route::post('roles/create',['middleware' => 'auth', 'uses' =>'RightsController@rightRolesPost']);


//Oracle support
Route::get('support/oracle/create',['middleware' => 'auth', 'uses' =>'OracleSupportController@create']);
Route::get('support/oracle/show/{id}',['middleware' => 'auth', 'uses' =>'OracleSupportController@show']);
Route::post('support/oracle/create',['middleware' => 'auth', 'uses' =>'OracleSupportController@store']);
Route::get('support/oracle/edit/{id}',['middleware' => 'auth', 'uses' =>'OracleSupportController@edit']);
Route::get('support/oracle/status/{id}',['middleware' => 'auth', 'uses' =>'OracleSupportController@updateStatus']);
Route::post('support/oracle/status',['middleware' => 'auth', 'uses' =>'OracleSupportController@saveStatus']);
Route::post('support/oracle/edit',['middleware' => 'auth', 'uses' =>'OracleSupportController@update']);
Route::get('support/oracle/opened',['middleware' => 'auth', 'uses' =>'OracleSupportController@opened']);
Route::get('support/oracle/closed',['middleware' => 'auth', 'uses' =>'OracleSupportController@closed']);
Route::get('support/oracle/history',['middleware' => 'auth', 'uses' =>'OracleSupportController@index']);
Route::get('support/oracle/report',['middleware' => 'auth', 'uses' =>'OracleSupportController@report']);
Route::get('support/oracle/remove/{id}',['middleware' => 'auth', 'uses' =>'OracleSupportController@destroy']);

//Modules
Route::resource('modules','ModuleController');
Route::get('modules-remove/{id}',['middleware' => 'auth', 'uses' =>'ModuleController@destroy']);

//Query Enables
Route::resource('enablers','EnablerController');
Route::get('enablers-remove/{id}',['middleware' => 'auth', 'uses' =>'ModuleController@destroy']);

//Query Progress status
Route::resource('queriesstatus','QueryStatusController');
Route::get('queriesstatus-remove/{id}',['middleware' => 'auth', 'uses' =>'QueryStatusController@destroy']);

//Inventory
Route::resource('inventory','InventoryController');
Route::get('inventory-reports',['middleware' => 'auth', 'uses' =>'InventoryController@reports']);
Route::get('inventory-remove/{id}',['middleware' => 'auth', 'uses' =>'InventoryController@destroy']);
Route::get('inventory-import',['middleware' => 'auth', 'uses' =>'InventoryController@showImportExcel']);
Route::post('inventory-import',['middleware' => 'auth', 'uses' =>'InventoryController@importExcel']);

//Inventory type
Route::resource('types','InventoryTypeController');
Route::get('types-remove/{id}',['middleware' => 'auth', 'uses' =>'InventoryTypeController@destroy']);


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
Route::get('queries/create',['middleware' => 'auth', 'uses' =>'QueryController@create']);
Route::post('queries/create',['middleware' => 'auth', 'uses' =>'QueryController@store']);
Route::get('queries/mytask',['middleware' => 'auth', 'uses' =>'QueryController@task']);
Route::get('queries/progress',['middleware' => 'auth', 'uses' =>'QueryController@progress']);
Route::get('queries/history',['middleware' => 'auth', 'uses' =>'QueryController@history']);
Route::get('queries/report',['middleware' => 'auth', 'uses' =>'QueryController@report']);
Route::get('queries/show/{id}',['middleware' => 'auth', 'uses' =>'QueryController@show']);
Route::get('queries/message/{id}',['middleware' => 'auth', 'uses' =>'QueryController@message']);
Route::post('queries/message',['middleware' => 'auth', 'uses' =>'QueryController@postMessage']);
Route::post('queries/attend',['middleware' => 'auth', 'uses' =>'QueryController@postQueryAttend']);
Route::get('queries/attend/{id}',['middleware' => 'auth', 'uses' =>'QueryController@queryAttend']);
Route::get('queries/assign',['middleware' => 'auth', 'uses' =>'QueryController@queryAssign']);
Route::get('queries/assign/users/{id}',['middleware' => 'auth', 'uses' =>'QueryController@queryAssignUsers']);
Route::post('queries/assign/users',['middleware' => 'auth', 'uses' =>'QueryController@postQueryAssignUsers']);

//Send emails
Route::get('emails/oracleissues','EmailController@olacle');
