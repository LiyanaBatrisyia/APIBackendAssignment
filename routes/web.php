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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//
Route::get('/home', 'User\CsvFile@index');
Route::get('/home/export', 'User\CsvFile@csv_export')->name('export');
Route::post('/home/import', 'User\CsvFile@csv_import')->name('import');

Route::get('/trash', 'User\UserController@indexTrash')->name('trash');
