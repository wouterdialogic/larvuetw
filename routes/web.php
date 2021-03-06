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

Route::apiResource('todos', 'TodoController');
Route::get('removeTodo', 'TodoController@destroy');
Route::post('removeTodo', 'TodoController@destroy');

Route::get('/', function () {
    return view('welcome');
});
