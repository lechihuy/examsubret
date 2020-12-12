<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'DashboardController')->name('dashboard');

// Submit the exam request
Route::prefix('submit-exam-requests')->name('subexams.')->group(function() {
    Route::delete('/destroy_list', 'SubmitExamRequestController@destroyList')
        ->name('destroy_list');
    Route::put('/switch_status_list', 'SubmitExamRequestController@switchStatusList')
        ->name('switch_status_list');
    Route::put('/switch_status/{subexam}', 'SubmitExamRequestController@switchStatus')
        ->name('switch_status');
    Route::get('/export', 'SubmitExamRequestController@export')
        ->name('export');
    Route::get('/print', 'SubmitExamRequestController@print')
        ->name('print');
});

Route::resource('submit-exam-requests', 'SubmitExamRequestController')->names([
    'index' => 'subexams.index',
    'show' => 'subexams.show',
    'create' => 'subexams.create',
    'store' => 'subexams.store',
    'edit' => 'subexams.edit',
    'update' => 'subexams.update',
    'destroy' => 'subexams.destroy'
])->parameters(['submit-exam-requests' => 'subexam']);

// Profile
Route::prefix('profile')->name('profile.')->group(function() {
    Route::get('/', 'ProfileController@showProfileForm')->name('form');
    Route::put('/', 'ProfileController@update')->name('update');
});

// Authentication
Route::name('auth.')->group(function() {
    Route::prefix('login')->name('login.')->group(function() {
        Route::get('/', 'AuthController@showLoginForm')->name('form');
        Route::post('/', 'AuthController@login')->name('post');
        
        Route::prefix('oauth2')->name('oauth2.')->group(function() {
            Route::get('/', 'AuthController@loginOauth2')->name('redirect');
            Route::get('/callback', 'AuthController@callbackOauth2')->name('callback');
        });
    });

    Route::get('/logout', 'AuthController@logout')->name('logout');
});

// Ajax
Route::prefix('components')->name('components.')->group(function() {
    Route::get('load/view/{view}/handle/{handle}', 'ComponentController@load')->name('load');
});

// Data
Route::prefix('data')->name('data.')->group(function() {
    Route::get('majors', 'DataController@getMajors')->name('majors');
    Route::get('subjects', 'DataController@getSubjects')->name('subjects');
});

// Department
Route::prefix('departments')->name('departments.')->group(function() {
    Route::delete('/destroy_list', 'DepartmentController@destroyList')
        ->name('destroy_list');
});

Route::resource('departments', 'DepartmentController')->except('show');

// Major
Route::prefix('majors')->name('majors.')->group(function() {
    Route::delete('/destroy_list', 'MajorController@destroyList')
        ->name('destroy_list');
});

Route::resource('majors', 'MajorController')->except('show');

// Subject
Route::prefix('subjects')->name('subjects.')->group(function() {
    Route::delete('/destroy_list', 'SubjectController@destroyList')
        ->name('destroy_list');
});

Route::resource('subjects', 'SubjectController')->except('show');