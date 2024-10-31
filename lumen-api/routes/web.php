<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route untuk informasi

    // Rute untuk informasi
    Route::get('information', 'InformationController@index');
    Route::get('information/{id}', 'InformationController@show');
    
    Route::group(['middleware' => 'basic.auth'], function () {
        Route::post('information', 'InformationController@store');
        Route::put('information/{id}', 'InformationController@update');
        Route::delete('information/{id}', 'InformationController@destroy');
    });

    // Rute untuk Samsat
    Route::get('samsat', 'SamsatController@index');
    Route::get('samsat/{id}', 'SamsatController@show');

    Route::group(['middleware' => 'basic.auth'], function () {
        Route::post('samsat', 'SamsatController@store');
        Route::put('samsat/{id}', 'SamsatController@update');
        Route::delete('samsat/{id}', 'SamsatController@destroy');
    });

    // Rute untuk FAQ
    Route::get('faq', 'FaqController@index');
    Route::get('faq/{id}', 'FaqController@show');

    Route::group(['middleware' => 'basic.auth'], function () {
        Route::post('faq', 'FaqController@store');
        Route::put('faq/{id}', 'FaqController@update');
        Route::delete('faq/{id}', 'FaqController@destroy');
    });

    // Rute untuk Admin
    Route::get('admin', 'AdminController@index');
    Route::get('admin/{id}', 'AdminController@show');

    Route::group(['middleware' => 'basic.auth'], function () {
        Route::post('admin', 'AdminController@store');
        Route::put('admin/{id}', 'AdminController@update');
        Route::delete('admin/{id}', 'AdminController@destroy');
    });

    Route::get('images/{filename}', 'ImageController@show');

    $router->post('/login', 'UserController@login');
$router->get('/vehicles', 'VehicleController@getVehicles');
$router->get('/payment-details', 'PaymentController@getPaymentDetails');
$router->get('/payment-history', 'PaymentController@getPaymentHistory');
