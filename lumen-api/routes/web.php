<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InformationController;
use App\Http\Controllers\SamsatController;
use App\Http\Controllers\FaqController;

Route::group(['prefix' => 'api'], function () {
Route::get('informasi', 'InformationController@index');
Route::get('informasi/{id}', 'InformationController@show');
Route::post('informasi', 'InformationController@store');
Route::put('informasi/{id}', 'InformationController@update');
Route::delete('informasi/{id}', 'InformationController@destroy');

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