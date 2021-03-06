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

//EZ two factor auth 
Route::get('approvalRequest',['middleware' => 'auth', 'uses' =>'HomeController@approvalRequest']);
Route::get('qrcode/scan',['middleware' => 'auth', 'uses' =>'UserController@qrCodeScan']);
Route::get('qrcode/activation/status/{credential}',['middleware' => 'auth', 'uses' =>'UserController@checkQCodeActivationStatus']);
Route::get('users/push/request',['middleware' => 'auth', 'uses' =>'UserController@sendPushRequest']);
Route::get('users/push/getrequest/{txRef}',['middleware' => 'auth', 'uses' =>'UserController@getPushStatus']);
Route::get('users/otp/{id}',['middleware' => 'auth', 'uses' =>'UserController@userOTP']);
Route::post('users/otp',['middleware' => 'auth', 'uses' =>'UserController@postuserOTP']);


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
Route::get('getDepartmentUnits/{id}','DepartmentController@getUnits');


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

Route::get('users/details/{id}',['middleware' => 'auth', 'uses' =>'UserController@userPersonalDetails']);
Route::get('users/personal/{id}',['middleware' => 'auth', 'uses' =>'UserController@userPersonal']);
Route::post('users/personal',['middleware' => 'auth', 'uses' =>'UserController@postUserPersonal']);

Route::get('users/department/{id}',['middleware' => 'auth', 'uses' =>'UserController@userDepartment']);
Route::post('users/department',['middleware' => 'auth', 'uses' =>'UserController@postUserDepartment']);

Route::get('users/unit/{id}',['middleware' => 'auth', 'uses' =>'UserController@userUnit']);
Route::post('users/unit',['middleware' => 'auth', 'uses' =>'UserController@postUserUnit']);

Route::get('users/password/{id}',['middleware' => 'auth', 'uses' =>'UserController@userPassword']);
Route::post('users/password',['middleware' => 'auth', 'uses' =>'UserController@postUserPassword']);

Route::get('users/rights/{id}',['middleware' => 'auth', 'uses' =>'UserController@changeUserRights']);
Route::post('users/rights',['middleware' => 'auth', 'uses' =>'UserController@postChangeUserRights']);

Route::get('users/exemption/{id}',['middleware' => 'auth', 'uses' =>'UserController@changeUserExemption']);
Route::post('users/exemption',['middleware' => 'auth', 'uses' =>'UserController@postChangeUserExemption']);

Route::get('profile',['middleware' => 'auth', 'uses' =>'UserController@showProfile']);
Route::post('users/exemption',['middleware' => 'auth', 'uses' =>'UserController@postChangeUserExemption']);

//disabled
Route::get('users/inactive',['middleware' => 'auth', 'uses' =>'UserController@diabledUsers']);

//User import
Route::get('userimport',['middleware' => 'auth', 'uses' =>'UserController@showUserImport']);
Route::post('userimport',['middleware' => 'auth', 'uses' =>'UserController@postUserImport']);
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

//Service DeLivery
Route::get('servicedelivery',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@index']);
Route::get('servicedelivery/create',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@create']);
Route::post('servicedelivery/create',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@store']);
Route::get('servicedelivery/edit/{id}',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@edit']);
Route::get('servicedelivery/show/{id}',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@show']);
Route::post('servicedelivery/edit',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@update']);
Route::get('servicedelivery/remove/{id}',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@destroy']);
Route::get('servicedelivery/reports',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@reports']);
Route::get('servicedelivery/settings',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@settings']);
Route::get('servicedelivery/history',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@showHistory']);
Route::post('servicedelivery/history',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@postShowHistory']);


Route::get('servicedelivery/updates/{id}',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@showUpdates']);
Route::post('servicedelivery/updates',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@postUpdates']);

Route::get('servicedelivery/migrate',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@showImportMigrate']);
Route::post('servicedelivery/migrate',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@importMigrate']);

Route::get('servicedelivery/migrate/progress',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@showImportMigrateProgress']);
Route::post('servicedelivery/migrate/progress',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@importMigrateProgress']);
//
//SD I
//SD Customers

Route::get('servicedelivery/customers',['middleware' => 'auth', 'uses' =>'SDCustomerController@index']);
Route::get('servicedelivery/customers/create',['middleware' => 'auth', 'uses' =>'SDCustomerController@create']);
Route::post('servicedelivery/customers/create',['middleware' => 'auth', 'uses' =>'SDCustomerController@store']);
Route::get('servicedelivery/customers/edit/{id}',['middleware' => 'auth', 'uses' =>'SDCustomerController@edit']);
Route::post('servicedelivery/customers/edit',['middleware' => 'auth', 'uses' =>'SDCustomerController@update']);
Route::get('servicedelivery/customers/remove/{id}',['middleware' => 'auth', 'uses' =>'SDCustomerController@destroy']);


//SD REPORTS

Route::get('servicedelivery/report/month',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@getMonthReport']);
Route::get('servicedelivery/report/daily',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@getDayReport']);

Route::get('servicedelivery/report/custom',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@showCustomReports']);
Route::post('servicedelivery/report/custom',['middleware' => 'auth', 'uses' =>'ServiceDeliveryController@postCustomReports']);


//Get customer contact person
Route::get('getsdcontact/{id}',['middleware' => 'auth', 'uses' =>'SDCustomerController@getContactPersonal']);

//SD Emails
Route::get('servicedelivery/email/edit/{id}',['middleware' => 'auth', 'uses' =>'SDEmailController@edit']);
Route::post('servicedelivery/email/edit',['middleware' => 'auth', 'uses' =>'SDEmailController@update']);
Route::get('servicedelivery/email/show/{id}',['middleware' => 'auth', 'uses' =>'SDEmailController@show']);
Route::get('servicedelivery/email/create',['middleware' => 'auth', 'uses' =>'SDEmailController@create']);
Route::post('servicedelivery/email/create',['middleware' => 'auth', 'uses' =>'SDEmailController@store']);
Route::get('servicedelivery/email/remove/{id}',['middleware' => 'auth', 'uses' =>'SDEmailController@destroy']);
Route::get('servicedelivery/email',['middleware' => 'auth', 'uses' =>'SDEmailController@index']);


Route::resource('sdproducts','SDProductController');
Route::get('sdproducts-remove/{id}',['middleware' => 'auth', 'uses' =>'SDProductController@destroy']);
Route::resource('sdreceiptmodes','SDReceiptModeController');
Route::get('sdreceiptmodes-remove/{id}',['middleware' => 'auth', 'uses' =>'SDReceiptModeController@destroy']);
Route::resource('sdstatus','SDStatusController');
Route::get('sdstatus-remove/{id}',['middleware' => 'auth', 'uses' =>'SDStatusController@destroy']);
Route::resource('sdproductdetails','SDProductDetailsController');
Route::get('sdproductdetails-remove/{id}',['middleware' => 'auth', 'uses' =>'SDProductDetailsController@destroy']);

//Query Enables
Route::resource('enablers','EnablerController');

Route::get('enablers-remove/{id}',['middleware' => 'auth', 'uses' =>'EnablerController@destroy']);

//Query Progress status
Route::resource('queriesstatus','QueryStatusController');
Route::get('queriesstatus-remove/{id}',['middleware' => 'auth', 'uses' =>'QueryStatusController@destroy']);

//Inventory
Route::resource('inventory','InventoryController');
Route::get('inventory-reports',['middleware' => 'auth', 'uses' =>'InventoryController@reports']);
Route::get('inventory-remove/{id}',['middleware' => 'auth', 'uses' =>'InventoryController@destroy']);
Route::get('inventory-import',['middleware' => 'auth', 'uses' =>'InventoryController@showImportExcel']);
Route::post('inventory-import',['middleware' => 'auth', 'uses' =>'InventoryController@importExcel']);
Route::get('inventory-download',['middleware' => 'auth', 'uses' =>'InventoryController@showDownloadReport']);
Route::post('inventory-download',['middleware' => 'auth', 'uses' =>'InventoryController@postDownloadReport']);

//Inventory type
Route::resource('types','InventoryTypeController');
Route::get('types-remove/{id}',['middleware' => 'auth', 'uses' =>'InventoryTypeController@destroy']);

//SMS Customers
Route::get('sms/customers',['middleware' => 'auth', 'uses' =>'SMSCustomerController@index']);
Route::get('sms/customers/import',['middleware' => 'auth', 'uses' =>'SMSCustomerController@importCustomers']);
Route::post('sms/customers/import',['middleware' => 'auth', 'uses' =>'SMSCustomerController@postImportCustomers']);
Route::get('sms/customers/create',['middleware' => 'auth', 'uses' =>'SMSCustomerController@create']);
Route::post('sms/customers/create',['middleware' => 'auth', 'uses' =>'SMSCustomerController@store']);
Route::get('sms/customers/edit/{id}',['middleware' => 'auth', 'uses' =>'SMSCustomerController@edit']);
Route::post('sms/customers/edit',['middleware' => 'auth', 'uses' =>'SMSCustomerController@update']);
Route::get('sms/customers/remove/{id}',['middleware' => 'auth', 'uses' =>'SMSCustomerController@destroy']);

Route::get('sms/dispatch',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@index']);
Route::get('sms/dispatch/create',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@create']);
Route::post('sms/dispatch/create',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@store']);
Route::get('sms/dispatch/edit/{id}',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@edit']);
Route::post('sms/dispatch/edit',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@update']);
Route::get('sms/dispatch/remove/{id}',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@destroy']);
Route::get('sms/dispatch/customers/{id}',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@assignCustomers']);
Route::post('sms/dispatch/customers',['middleware' => 'auth', 'uses' =>'SMSDistributionListController@postAssignCustomers']);


Route::get('sms/messages/report',['middleware' => 'auth', 'uses' =>'SMSMessagesController@reports']);
Route::get('sms/messages/history',['middleware' => 'auth', 'uses' =>'SMSMessagesController@history']);
Route::get('sms/messages',['middleware' => 'auth', 'uses' =>'SMSMessagesController@index']);
Route::get('sms/messages/create',['middleware' => 'auth', 'uses' =>'SMSMessagesController@create']);
Route::post('sms/messages/create',['middleware' => 'auth', 'uses' =>'SMSMessagesController@store']);
Route::get('sms/messages/edit/{id}',['middleware' => 'auth', 'uses' =>'SMSMessagesController@edit']);
Route::get('sms/messages/dispatch/{id}',['middleware' => 'auth', 'uses' =>'SMSMessagesController@dispatchLog']);
Route::post('sms/messages/edit',['middleware' => 'auth', 'uses' =>'SMSMessagesController@update']);
Route::get('sms/messages/remove/{id}',['middleware' => 'auth', 'uses' =>'SMSMessagesController@destroy']);

Route::get('sms/reports',['middleware' => 'auth', 'uses' =>'SMSMessagesController@smsReports']);

//Downloads
Route::get('downloads/manage',['middleware' => 'auth', 'uses' =>'DownloadController@index']);
Route::get('downloads/reports',['middleware' => 'auth', 'uses' =>'DownloadController@reports']);
Route::get('downloads/create',['middleware' => 'auth', 'uses' =>'DownloadController@create']);
Route::post('downloads/create',['middleware' => 'auth', 'uses' =>'DownloadController@store']);
Route::get('downloads/edit/{id}',['middleware' => 'auth', 'uses' =>'DownloadController@edit']);
Route::get('downloads/download/{id}',['middleware' => 'auth', 'uses' =>'DownloadController@downloadFile']);
Route::get('downloads/department/{id}',['middleware' => 'auth', 'uses' =>'DownloadController@showDepartmentDownload']);
Route::post('downloads/edit',['middleware' => 'auth', 'uses' =>'DownloadController@update']);
Route::get('downloads-remove/{id}',['middleware' => 'auth', 'uses' =>'DownloadController@destroy']);


//Units controller
Route::get('units',['middleware' => 'auth', 'uses' =>'UnitController@index']);
Route::get('units/show/{id}',['middleware' => 'auth', 'uses' =>'UnitController@show']);
Route::get('units/create',['middleware' => 'auth', 'uses' =>'UnitController@create']);
Route::post('units/create',['middleware' => 'auth', 'uses' =>'UnitController@store']);
Route::get('units/remove/{id}',['middleware' => 'auth', 'uses' =>'UnitController@destroy']);
Route::get('units/edit/{id}',['middleware' => 'auth', 'uses' =>'UnitController@edit']);
Route::post('units/edit',['middleware' => 'auth', 'uses' =>'UnitController@update']);

//Portal Reports
Route::get('portal/reports',['middleware' => 'auth', 'uses' =>'PortalReportController@index']);
Route::get('portal/reports/daily',['middleware' => 'auth', 'uses' =>'PortalReportController@dailyReports']);
Route::get('portal/reports/monthly',['middleware' => 'auth', 'uses' =>'PortalReportController@monthlyReports']);
Route::get('portal/reports/custom',['middleware' => 'auth', 'uses' =>'PortalReportController@customReports']);
Route::get('portal/reports/generate',['middleware' => 'auth', 'uses' =>'PortalReportController@generateReports']);
Route::get('portal/reports/edit/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@edit']);
Route::post('portal/reports/edit',['middleware' => 'auth', 'uses' =>'PortalReportController@update']);
Route::get('portal/reports/show/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@show']);
Route::get('portal/reports/remove/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@destroy']);
Route::get('portal/reports/create',['middleware' => 'auth', 'uses' =>'PortalReportController@create']);
Route::post('portal/reports/create',['middleware' => 'auth', 'uses' =>'PortalReportController@store']);
Route::get('portal/reports/import',['middleware' => 'auth', 'uses' =>'PortalReportController@showImport']);
Route::post('portal/reportsimport',['middleware' => 'auth', 'uses' =>'PortalReportController@importReports']);
Route::get('portal/reports/departments/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@showDepartments']);
Route::post('portal/reports/departments',['middleware' => 'auth', 'uses' =>'PortalReportController@postDepartments']);
Route::get('portal/reports/search',['middleware' => 'auth', 'uses' =>'PortalReportController@searchReport']);
Route::get('dailyreports/{y}/{m}/{d}',['middleware' => 'auth', 'uses' =>'PortalReportController@getDailyReports']);
Route::get('archivedreports/{y}/{m}/{d}',['middleware' => 'auth', 'uses' =>'PortalReportController@getArchivedReports']);
Route::get('portal/reports/setup',['middleware' => 'auth', 'uses' =>'PortalReportController@reportSetup']);
Route::post('portal/reports/setup',['middleware' => 'auth', 'uses' =>'PortalReportController@postReportSetup']);
Route::get('portal/reports/assignment',['middleware' => 'auth', 'uses' =>'PortalReportController@reportAssignment']);
Route::post('portal/reports/assignment',['middleware' => 'auth', 'uses' =>'PortalReportController@postReportAssignment']);

//Download reports
Route::get('download/daily/reports/{dt}/{t}/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@downloadDailyReport']);
Route::get('download/archived/reports/{dt}/{t}/{id}',['middleware' => 'auth', 'uses' =>'PortalReportController@downloadArchivedReport']);

//Services
Route::get('services',['middleware' => 'auth', 'uses' =>'ServicesController@index']);
Route::get('services/create',['middleware' => 'auth', 'uses' =>'ServicesController@create']);
Route::post('services/create',['middleware' => 'auth', 'uses' =>'ServicesController@store']);
Route::get('services/list',['middleware' => 'auth', 'uses' =>'ServicesController@listService']);
Route::post('services/edit',['middleware' => 'auth', 'uses' =>'ServicesController@update']);
Route::get('services/edit/{id}',['middleware' => 'auth', 'uses' =>'ServicesController@edit']);
Route::get('services-remove/{id}',['middleware' => 'auth', 'uses' =>'ServicesController@destroy']);

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
Route::get('queries/assigned/progress',['middleware' => 'auth', 'uses' =>'QueryController@assignedProgress']);
Route::get('queries/history',['middleware' => 'auth', 'uses' =>'QueryController@history']);
Route::get('queries/report',['middleware' => 'auth', 'uses' =>'QueryController@report']);
Route::get('queries/show/{id}',['middleware' => 'auth', 'uses' =>'QueryController@show']);
Route::get('queries/edit/{id}',['middleware' => 'auth', 'uses' =>'QueryController@edit']);
Route::get('queries/message/{id}',['middleware' => 'auth', 'uses' =>'QueryController@message']);
Route::post('queries/message',['middleware' => 'auth', 'uses' =>'QueryController@postMessage']);
Route::post('queries/attend',['middleware' => 'auth', 'uses' =>'QueryController@postQueryAttend']);
Route::get('queries/attend/{id}',['middleware' => 'auth', 'uses' =>'QueryController@queryAttend']);
Route::get('queries/assign',['middleware' => 'auth', 'uses' =>'QueryController@queryAssign']);
Route::get('queries/assign/users/{id}',['middleware' => 'auth', 'uses' =>'QueryController@queryAssignUsers']);
Route::post('queries/assign/users',['middleware' => 'auth', 'uses' =>'QueryController@postQueryAssignUsers']);
Route::get('queries/download',['middleware' => 'auth', 'uses' =>'QueriesReportsController@showDownloadReport']);
Route::post('queries/download',['middleware' => 'auth', 'uses' =>'QueriesReportsController@postDownloadReport']);
Route::get('queries/message/composer/{id}',['middleware' => 'auth', 'uses' =>'QueryController@messageComposer']);
Route::post('queries/message/composer/{id}',['middleware' => 'auth', 'uses' =>'QueryController@postMessageComposer']);

//Query reports
Route::get('queries/report/month',['middleware' => 'auth', 'uses' =>'QueryController@getMonthReports']);
Route::get('queries/report/daily',['middleware' => 'auth', 'uses' =>'QueryController@getDailyReports']);

Route::get('queries/report/custom',['middleware' => 'auth', 'uses' =>'QueryController@showCustomReport']);
Route::post('queries/report/custom',['middleware' => 'auth', 'uses' =>'QueryController@postCustomReport']);

Route::get('queries/report/excel',['middleware' => 'auth', 'uses' =>'QueryController@getReportExcel']);

//Query attachment download
Route::get('queries/download/{id}',['middleware' => 'auth', 'uses' =>'QueryController@downloadAttachment']);
Route::get('queries/getattchment/{id}',['middleware' => 'auth', 'uses' =>'QueryController@downloadQueryAttachment']);

//Query emails
Route::resource('queryemails','QueryEmailController');
Route::get('queryemails-remove/{id}',['middleware' => 'auth', 'uses' =>'QueryEmailController@destroy']);
//Queries reports controller

//Service monitoring downtime
Route::resource('smemails','SMEmailsController');
Route::get('smemails-remove/{id}',['middleware' => 'auth', 'uses' =>'SMEmailsController@destroy']);

//System setting

Route::get('systemsetups',['middleware' => 'auth', 'uses' =>'SystemSetupController@index']);
Route::post('systemsetups',['middleware' => 'auth', 'uses' =>'SystemSetupController@store']);

//EOD import files
Route::get('eod/create',['middleware' => 'auth', 'uses' =>'EODReportController@create']);
Route::post('eod/create',['middleware' => 'auth', 'uses' =>'EODReportController@store']);

//Forex deal slips
Route::get('forex/customers',['middleware' => 'auth', 'uses' =>'ForexCustomerController@index']);
Route::get('forex/customers/create',['middleware' => 'auth', 'uses' =>'ForexCustomerController@create']);
Route::post('forex/customers/create',['middleware' => 'auth', 'uses' =>'ForexCustomerController@store']);
Route::get('forex/customers/show/{id}',['middleware' => 'auth', 'uses' =>'ForexCustomerController@show']);
Route::get('forex/customers/edit/{id}',['middleware' => 'auth', 'uses' =>'ForexCustomerController@edit']);
Route::post('forex/customers/edit',['middleware' => 'auth', 'uses' =>'ForexCustomerController@update']);
Route::get('forex/customers/remove/{id}',['middleware' => 'auth', 'uses' =>'ForexCustomerController@destroy']);

Route::get('forex/dealslip',['middleware' => 'auth', 'uses' =>'ForexDealslipController@reports']);
Route::get('forex/dealslip/create',['middleware' => 'auth', 'uses' =>'ForexDealslipController@create']);
Route::post('forex/dealslip/create',['middleware' => 'auth', 'uses' =>'ForexDealslipController@store']);
Route::get('forex/dealslip/show/{id}',['middleware' => 'auth', 'uses' =>'ForexDealslipController@show']);
Route::get('forex/dealslip/edit/{id}',['middleware' => 'auth', 'uses' =>'ForexDealslipController@edit']);
Route::post('forex/dealslip/edit',['middleware' => 'auth', 'uses' =>'ForexDealslipController@update']);
Route::get('forex/dealslip/remove/{id}',['middleware' => 'auth', 'uses' =>'ForexDealslipController@destroy']);
Route::get('forex/dealslip/reports',['middleware' => 'auth', 'uses' =>'ForexDealslipController@reports']);
Route::get('forex/dealslip/view',['middleware' => 'auth', 'uses' =>'ForexDealslipController@index']);
Route::get('forex/dealslip/import',['middleware' => 'auth', 'uses' =>'ForexDealslipController@importShow']);
Route::post('forex/dealslip/import',['middleware' => 'auth', 'uses' =>'ForexDealslipController@importPost']);

//Reports
Route::get('forex/dealslip/today/report',['middleware' => 'auth', 'uses' =>'ForexDealslipController@reportsToday']);
Route::get('forex/dealslip/month/report',['middleware' => 'auth', 'uses' =>'ForexDealslipController@monthToday']);
Route::get('forex/dealslip/generate/report',['middleware' => 'auth', 'uses' =>'ForexDealslipController@reportsGenerate']);
//Send emails

//Reminders routing
Route::get('reminders',['middleware' => 'auth', 'uses' =>'ReminderController@index']);
Route::get('reminders/create',['middleware' => 'auth', 'uses' =>'ReminderController@create']);
Route::post('reminders/create',['middleware' => 'auth', 'uses' =>'ReminderController@store']);
Route::get('reminders/show/{id}',['middleware' => 'auth', 'uses' =>'ReminderController@show']);
Route::get('reminders/edit/{id}',['middleware' => 'auth', 'uses' =>'ReminderController@edit']);
Route::post('reminders/edit',['middleware' => 'auth', 'uses' =>'ReminderController@update']);
Route::get('reminders/remove/{id}',['middleware' => 'auth', 'uses' =>'ReminderController@destroy']);

Route::get('reminders/active/list',['middleware' => 'auth', 'uses' =>'ReminderController@getActiveList']);
Route::get('reminders/history/list',['middleware' => 'auth', 'uses' =>'ReminderController@getHistoryList']);


Route::get('emails/oracleissues','EmailController@olacle');
Route::get('portal/cronejob','EmailController@cronejob');

