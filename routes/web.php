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

Route::get('/login', 'UserController@login')->name('login');
Route::post('/authenticate', 'UserController@authenticate')->name('authenticate');

/*Route::group(['middleware' => 'web'], function()
{
    Route::get('/login', [
        'as'        => 'login',
        'uses'      => 'UserController@login'
    ]);

    Route::post('/authenticate', 'UserController@authenticate');

    // Password reset link request routes
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
});*/

// authenticated routes
Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/', [
        'as'        => 'home',
        'uses'      => 'DashboardController@index'
    ]);

    Route::get('/logout', [
        'as'        => 'logout',
        'uses'      => 'UserController@logout'
    ]);
});

// admin and manager routes
Route::group(['middleware' => 'role:admin|manager'], function ()
{
    Route::resource('clients', 'ClientController');
    Route::resource('holidays', 'HolidayController');
    Route::resource('milestones', 'MilestoneController');
    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');

    Route::get('task-user/add', 'TaskUserController@store');
    Route::delete('task-user/delete/{id}', 'TaskUserController@destroy');
});