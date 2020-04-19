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
Route::get('/tasks/filtration', 'TaskController@filtration')->name('tasks.filtration');
Route::resource('tasks', 'TaskController');
Route::resource('statuses', 'StatusController')->except('show');
Route::resource('labels', 'LabelController')->except('show');
Route::resource('users', 'UserController')->only('show', 'edit', 'update');
