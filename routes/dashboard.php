<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Dashboard" middleware group. Enjoy building your Dashboard!
|
*/
Route::get('app/lang', 'HomeController@lang');


/*
|--------------------------------------------------------------------------
| Dashboard Auth
|--------------------------------------------------------------------------
| Here is where admin auth routes exists for login and log out
*/
Route::group([
    'namespace'  => 'Auth',
], function() {
    Route::get('login', ['uses' => 'LoginController@showLoginForm','as'=>'dashboard.login']);
    Route::post('login', ['uses' => 'LoginController@login']);
    Route::group([
        'middleware' => 'auth.dashboard',
    ], function() {
        Route::post('logout', ['uses' => 'LoginController@logout','as'=>'dashboard.logout']);
    });
});
/*
|--------------------------------------------------------------------------
| Dashboard After login in
|--------------------------------------------------------------------------
| Here is where admin panel routes exists after login in
*/
Route::group([
    'middleware'  => 'auth.dashboard',
], function() {
    Route::get('/', 'HomeController@index');

    /*
    |--------------------------------------------------------------------------
    | Dashboard > App Management
    |--------------------------------------------------------------------------
    | Here is where App Management routes
    */

    Route::group([
        'prefix'=>'app_managements',
        'namespace'=>'AppManagement',
    ],function () {
        Route::group([
            'prefix'=>'employees'
        ],function () {
            Route::get('/','EmployeeController@index');
            Route::get('/create','EmployeeController@create');
            Route::post('/','EmployeeController@store');
            Route::get('/{employee}','EmployeeController@show');
            Route::get('/{employee}/edit','EmployeeController@edit');
            Route::put('/{employee}','EmployeeController@update');
            Route::delete('/{employee}','EmployeeController@destroy');
            Route::patch('/update/password',  'EmployeeController@updatePassword');
            Route::get('/option/export','EmployeeController@export');
            Route::get('/{id}/activation','EmployeeController@activation');
        });
        Route::group([
            'prefix'=>'roles'
        ],function () {
            Route::get('/','RoleController@index');
            Route::get('/create','RoleController@create');
            Route::post('/','RoleController@store');
            Route::get('/{role}','RoleController@show');
            Route::get('/{role}/edit','RoleController@edit');
            Route::put('/{role}','RoleController@update');
            Route::delete('/{role}','RoleController@destroy');
            Route::get('/option/export','RoleController@export');
        });
        Route::group([
            'prefix'=>'permissions'
        ],function () {
            Route::get('/','PermissionController@index');
            Route::get('/create','PermissionController@create');
            Route::post('/','PermissionController@store');
            Route::get('/{permission}','PermissionController@show');
            Route::get('/{permission}/edit','PermissionController@edit');
            Route::put('/{permission}','PermissionController@update');
            Route::delete('/{permission}','PermissionController@destroy');
            Route::get('/option/export','PermissionController@export');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard > App Data
    |--------------------------------------------------------------------------
    | Here is where App Data routes
    */
    Route::group([
        'prefix'=>'app_data',
        'namespace'=>'AppData',
    ],function () {
        Route::group([
            'prefix'=>'settings'
        ],function () {
            Route::get('/','SettingController@index');
            Route::get('/{setting}/edit','SettingController@edit');
            Route::put('/{setting}','SettingController@update');
        });
        Route::group([
            'prefix'=>'images'
        ],function () {
            Route::get('/','ImageController@index');
            Route::get('/create','ImageController@create');
            Route::post('/','ImageController@store');
            Route::get('/{image}','ImageController@show');
            Route::get('/{image}/edit','ImageController@edit');
            Route::put('/{image}','ImageController@update');
            Route::delete('/{image}','ImageController@destroy');
            Route::get('/option/export','ImageController@export');
        });
        Route::group([
            'prefix'=>'tags'
        ],function () {
            Route::get('/','TagController@index');
            Route::get('/create','TagController@create');
            Route::post('/','TagController@store');
            Route::get('/{tag}','TagController@show');
            Route::get('/{tag}/edit','TagController@edit');
            Route::put('/{tag}','TagController@update');
            Route::delete('/{tag}','TagController@destroy');
            Route::get('/option/export','TagController@export');
        });
    });
});
