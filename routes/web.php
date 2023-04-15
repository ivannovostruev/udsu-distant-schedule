<?php

use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GroupController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\Dashboard\ReasonController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Dashboard\TimeslotController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoomHelperController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\UdsuLoginController;
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

//Auth::routes();


Route::get('/', [MainController::class, 'index'])
    ->name('main');



Route::get('room-helper', [RoomHelperController::class, 'getData'])
    ->name('roomHelper');



Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [MainController::class, 'home'])
        ->name('home');

    Route::get('schedule', [ScheduleController::class, 'index'])
        ->name('schedule');
});



/*
|--------------------------------------------------------------------------
| UDSU Auth routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'udsu'], function() {
    Route::post('login', [UdsuLoginController::class, 'login'])
        ->name('udsu.login');
    Route::post('logout', [UdsuLoginController::class, 'logout'])
        ->name('udsu.logout');
});



/*
|--------------------------------------------------------------------------
| Dashboard routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class)
        ->names('dashboard.users');

    Route::resource('colors', ColorController::class)
        ->names('dashboard.colors');

    Route::get('groups/upload', [GroupController::class, 'uploadForm'])
        ->name('dashboard.groups.upload');
    Route::post('groups/upload', [GroupController::class, 'uploadFile'])
        ->name('dashboard.groups.upload');
    Route::resource('groups', GroupController::class)
        ->names('dashboard.groups');

    Route::post('lessons/{lesson}/approve', [LessonController::class, 'approve'])
        ->name('dashboard.lessons.approve');
    Route::get('lessons/fastCreate', [LessonController::class, 'fastCreate'])
        ->name('dashboard.lessons.fastCreate');
    Route::resource('lessons', LessonController::class)
        ->names('dashboard.lessons');

    Route::resource('rooms', RoomController::class)
        ->names('dashboard.rooms');

    Route::get('teachers/upload', [TeacherController::class, 'uploadForm'])
        ->name('dashboard.teachers.upload');
    Route::post('teachers/upload', [TeacherController::class, 'uploadFile'])
        ->name('dashboard.teachers.upload');
    Route::resource('teachers', TeacherController::class)
        ->names('dashboard.teachers');

    Route::resource('timeslots', TimeslotController::class)
        ->names('dashboard.timeslots');

    Route::resource('reasons', ReasonController::class)
        ->names('dashboard.reasons');
});
