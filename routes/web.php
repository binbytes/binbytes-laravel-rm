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
    Route::get('/users/promote/{user}', 'UserController@promote');
    Route::post('/users/promote/{user}', 'UserController@storePromote')->name('store-promote');

    Route::get('/my-profile', 'UserController@editMe');
    Route::get('/experience-letter/{user}', 'UserController@experienceLetter');
    Route::get('/joining-letter/{user}', 'UserController@joiningLetter');
    Route::get('/download/{letter}/{user}', 'UserController@download');

    Route::resource('/projects', 'ProjectController');
    Route::get('/projects/filter/{type}', 'ProjectController@index');
    Route::get('/api-projects', 'ProjectController@getProjectsAPI');

    Route::get('/progress/{project}', 'ProjectController@showProgress');
    Route::post('/progress', 'ProjectController@storeProgress')->name('progress');
    Route::get('/progressView/{progress}', 'ProjectController@viewProgress');

    Route::get('/api-holidays', 'HolidayController@getHolidayAPI');
    Route::resource('/holidays', 'HolidayController');

    Route::resource('/leaves', 'LeaveController')->parameters([
        'leaves' => 'leave'
    ]);
    Route::get('/leave-approval/{leave}/{approve}', 'LeaveController@approved');
    Route::get('/api-leaves', 'LeaveController@getLeaveAPI');

    Route::resource('/designations', 'DesignationController');

    Route::resource('/salaries', 'SalaryController');
    Route::get('/salaries/filter/{month}/{year}', 'SalaryController@filter');
    Route::get('/salary', 'SalaryController@view');
    Route::get('/payslip/{user}', 'SalaryController@payslip');
    Route::get('/download/{user}', 'SalaryController@download');

    Route::resource('/accounts', 'AccountController');

    Route::resource('/transactions', 'TransactionController');
    Route::post('/transactions/import/{account}', 'TransactionController@import')->name('transaction-import');
    Route::get('/transactions/download/{transaction}', 'TransactionController@download')->name('transaction-download');

    Route::resource('/transaction-types', 'TransactionTypeController');

    Route::get('/attendance/ping', 'AttendanceController@ping');
    Route::get('/attendance/day/{user}/{startDate}/{endDate?}', 'AttendanceController@dailyView')->name('day-attendance');

    Route::get('/notifications/recent', 'NotificationController@getRecentNotifications');
    Route::get('/notifications/mark-read/{notificationId}', 'NotificationController@markRead');
    Route::get('/all-notifications', 'NotificationController@viewAll');
});
