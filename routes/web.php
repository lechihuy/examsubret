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
Route::resource('submit-exam-request', 'SubmitExamRequestController')->names([
    'index' => 'subexam.index',
    'create' => 'subexam.create',
    'store' => 'subexam.store',
    'edit' => 'subexam.edit',
    'update' => 'subexam.update',
    'destroy' => 'subexam.destroy'
])->parameters(['submit-exam-request' => 'subexam'])->except(['show']);

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
Route::get('majors', 'TeacherJobController@getMajors')->name('majors');
Route::get('subjects', 'TeacherJobController@getSubjects')->name('subjects');

