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

Route::get('/', 'HomeController@index');
Route::get('/unrealgen', 'HomeController@unrealgen');
Route::get('/anopegen', 'HomeController@anopegen');
Route::get('/eggdroplgen', 'HomeController@eggdroplgen');
Route::post('/unrealgen', 'HomeController@unrealgenr');
Route::post('/anopegen', 'HomeController@anopegenr');
Route::post('/eggdroplgen', 'HomeController@eggdroplgenr');