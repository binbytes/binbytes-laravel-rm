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

use App\Bill;

Route::redirect('/', '/dashboard');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('/clients', 'ClientController');
    Route::resource('/users', 'UserController');
    Route::get('/users/promote/{user}', 'UserController@promote');
    Route::post('/users/promote/{user}', 'UserController@storePromote')->name('store-promote');

    Route::get('/my-profile', 'UserController@editMe');
    Route::get('/experience-letter/{user}', 'UserController@experienceLetter');
    Route::get('/joining-letter/{user}', 'UserController@joiningLetter');
    Route::get('/promote-letter/{user}', 'UserController@promoteLetter');
    Route::get('/download/{letter}/{user}', 'UserController@download');

    Route::resource('/projects', 'ProjectController');
    Route::get('/projects/filter/{type}', 'ProjectController@index');
    Route::get('/api-projects', 'ProjectController@getProjectsAPI');
    Route::get('/client-project/{id}', 'ProjectController@getClientProjects');

    Route::get('/progress/{project}', 'ProjectController@showProgress');
    Route::post('/progress', 'ProjectController@storeProgress')->name('progress');
    Route::get('/progressView/{progress}', 'ProjectController@viewProgress');

    Route::get('/api-holidays', 'HolidayController@getHolidayAPI');
    Route::resource('/holidays', 'HolidayController');

    Route::resource('/leaves', 'LeaveController')->parameters([
        'leaves' => 'leave',
    ]);
    Route::get('/leave-approval/{leave}/{approve}', 'LeaveController@approved');
    Route::get('/api-leaves', 'LeaveController@getLeaveAPI');

    Route::resource('/designations', 'DesignationController');

    Route::resource('/salaries', 'SalaryController');
    Route::get('/salaries/filter/{month}/{year}', 'SalaryController@filter');
    Route::get('/salary/{month?}', 'SalaryController@view');
    Route::get('/payslip/{user}', 'SalaryController@payslip');
    Route::get('/download/{user}', 'SalaryController@downloadPayslip');
    Route::get('/paid_salary/download/{month}/{year}', 'SalaryController@downloadPaidSalary');

    Route::resource('/accounts', 'AccountController');
    Route::get('/api-accounts', 'AccountController@getAPI');

    Route::get('/api-transaction', 'TransactionController@getAPI');
    Route::resource('/transactions', 'TransactionController');
    Route::delete('/delete-selected-transaction', 'TransactionController@deleteAll');
    Route::post('/transactions/import/{account}', 'TransactionController@import')->name('transaction-import');
    Route::post('/transaction/export', 'TransactionController@export')->name('transaction-export');
    Route::get('/transactions/download/{transaction}', 'TransactionController@download')->name('transaction-download');

    Route::resource('/transaction-types', 'TransactionTypeController');

    Route::resource('/invoice', 'BillController');
    Route::get('/download-all/invoice', 'BillController@downloadAll');
    Route::get('/download-bill/{bill}', 'BillController@downloadBill')->name('download-bill');

    Route::get('/attendance/ping', 'AttendanceController@ping');
    Route::get('/attendance/day/{user}/{startDate}/{endDate?}', 'AttendanceController@dailyView')->name('day-attendance');
    Route::get('/attendance/request/{sessionUpdate}/{request}', 'AttendanceController@approvedRequest');
    Route::model('sessionUpdate', \App\AttendanceSessionUpdate::class);
    Route::resource('/attendance', 'AttendanceController')->parameters([
        'attendance' => 'attendanceSession',
    ]);

    Route::get('/notifications/recent', 'NotificationController@getRecentNotifications');
    Route::get('/notifications/mark-read/{notificationId}', 'NotificationController@markRead');
    Route::get('/all-notifications', 'NotificationController@viewAll');
});
