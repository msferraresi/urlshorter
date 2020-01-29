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

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('acortador');
})->name('acortador');

Route::get('acortador', function(){
    return view('acortador');
})->name('acortador');

Route::get('recuperador', function(){
    return view('recuperador');
})->name('recuperador');

Route::get('estadisticas', function(){
    return view('estadisticas');
})->name('estadisticas');

Route::get('borrado', function(){
    return view('borrado');
})->name('borrado');

Route::post('longUrl','ServiceController@urlToShortCode')->name('longUrl');

Route::post('shortCode','ServiceController@shortCodeToUrl')->name('shortCode');

Route::post('urlStatistics','ServiceController@urlStatistics')->name('urlStatistics');

Route::post('delteUrl','ServiceController@delteUrl')->name('delteUrl');
