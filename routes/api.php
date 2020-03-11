<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('user', 'User\UserController@index');
//Route::get('user/{id}', 'User\UserController@show');
//Route::post('user', 'User\UserController@store');
//Route::put('user/{id}', 'User\UserController@update');
//Route::delete('user/{id}', 'User\UserController@destroy');

//BasicAuth
//Route::group(['middleware' => 'auth:api', 'namespace' => 'User'], function(){
//    Route::apiResource('users', 'UserController');
//});

Route::group(['middleware' => 'client'], function(){
    //Route::apiResource('user', 'User\UserController');
    Route::get('user', 'User\UserController@index');
    Route::get('user/{id}', 'User\UserController@show');
    Route::post('user', 'User\UserController@store');
    Route::put('user/{id}', 'User\UserController@update');
    Route::delete('user/{id}', 'User\UserController@destroy');
});
//Route::apiResource('user', 'User\User');


Route::get('index', 'User\CsvFile@index');
Route::get('export', 'User\CsvFile@csv_export')->name('export');
Route::post('import', 'User\CsvFile@csv_import')->name('import');
