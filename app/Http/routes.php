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
Route::get('login','UserController@login');
Route::get('branches','BranchController@index');

