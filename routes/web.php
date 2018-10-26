<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('/clients', 'ClientController')->except(['edit', 'update']);
    Route::resource('/users', 'UserController');
    Route::get('/my-profile', 'UserController@editMe');

    Route::resource('/projects', 'ProjectController')->except(['edit', 'update']);
    Route::resource('/holidays', 'HolidayController')->except(['edit', 'update']);
    Route::resource('/leaves', 'LeaveController')->except(['edit', 'update']);

    Route::get('/attendance/ping', 'AttendanceController@ping');
    Route::get('/attendance/day/{date}', 'AttendanceController@dailyView')->name('day-attendance');
});