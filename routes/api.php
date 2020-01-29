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

Route::post('longUrl','ServiceController@urlToShortCode')->name('longUrl');

Route::post('shortCode','ServiceController@shortCodeToUrl')->name('shortCode');

Route::post('urlStatistics','ServiceController@urlStatistics')->name('urlStatistics');

Route::post('delteUrl','ServiceController@delteUrl')->name('delteUrl');

