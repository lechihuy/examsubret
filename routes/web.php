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

Route::prefix('auth')->group(function() {
    Route::get('/outlook/login', 'TeacherController@loginOutlook');
    Route::get('/outlook/callback', 'TeacherController@callbackOutlook');
});

Route::get('/', function() {
    $department = App\Models\Department::find(1);
    $major = App\Models\Major::find(1);

    dump($major->departments);
});