<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InformationController;
use App\Http\Controllers\SamsatController;
use App\Http\Controllers\FaqController;

Route::group(['prefix' => 'api'], function () {
Route::get('information', 'InformationController@index');
Route::get('information/{id}', 'InformationController@show');
Route::post('information', 'InformationController@store');
Route::put('information/{id}', 'InformationController@update');
Route::delete('information/{id}', 'InformationController@destroy');

Route::post('information/gambar', 'InformationController@uploadGambar');
Route::get('information/gambar/{filename}', 'InformationController@getGambar');


// Rute untuk Samsat
Route::get('samsat', 'SamsatController@index');
Route::get('samsat/{id}', 'SamsatController@show');
Route::post('samsat', 'SamsatController@store');
Route::put('samsat/{id}', 'SamsatController@update');
Route::delete('samsat/{id}', 'SamsatController@destroy');

// Rute untuk FAQ
Route::get('faq', 'FaqController@index');
Route::get('faq/{id}', 'FaqController@show');
Route::post('faq', 'FaqController@store');
Route::put('faq/{id}', 'FaqController@update');
Route::delete('faq/{id}', 'FaqController@destroy');


});