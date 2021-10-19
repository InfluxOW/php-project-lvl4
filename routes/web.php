<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/tasks/filtration', 'TaskController@filter')->name('tasks.filter');
Route::resource('tasks', 'TaskController');

Route::resource('task_statuses', 'TaskStatusController')->except('show')->parameters(['task_statuses' => 'status']);
Route::resource('labels', 'LabelController')->except('show');
Route::resource('users', 'UserController')->only('show', 'edit', 'update');
