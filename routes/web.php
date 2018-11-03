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

Route::redirect('/', '/dashboard');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('/clients', 'ClientController');
    Route::resource('/users', 'UserController');
    Route::get('/my-profile', 'UserController@editMe');
    Route::get('/exp-latter/{user}', 'UserController@latter');
    Route::get('/payslip/{user}', 'UserController@payslip');

    Route::resource('/projects', 'ProjectController');
    Route::resource('/holidays', 'HolidayController');
    Route::resource('/leaves', 'LeaveController')->parameters([
        'leaves' => 'leave'
    ]);
    Route::get('/leave-approval/{leave}/{approve}', 'LeaveController@approved');

    Route::resource('/departments', 'DepartmentController');
    Route::resource('/designations', 'DesignationController');

    Route::get('/attendance/ping', 'AttendanceController@ping');
    Route::get('/attendance/day/{date}', 'AttendanceController@dailyView')->name('day-attendance');

    Route::get('/notifications/recent', 'NotificationController@getRecentNotifications');
    Route::get('/notifications/mark-read/{notificationId}', 'NotificationController@markRead');
    Route::get('/all-notifications', 'NotificationController@viewAll');
});
