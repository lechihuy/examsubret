<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {
    Route::prefix('admin')->group(function() {
        Route::post('/login', 'AdminController@login');
        Route::get('/logout', 'AdminController@logout');
        Route::get('/refresh', 'AdminController@refresh');
        Route::get('/is_authenticated', 'AdminController@isAuthenticated');
    });

    Route::prefix('teacher')->group(function() {
        Route::get('/logout', 'TeacherController@logout');
        Route::get('/refresh', 'TeacherController@refresh');
    });
});

Route::prefix('admin')->group(function() {
    Route::prefix('profile')->group(function() {
        Route::get('', 'AdminController@me');
        Route::put('', 'AdminController@updateProfile');
    });
});


