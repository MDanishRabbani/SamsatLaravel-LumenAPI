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
        Route::post('faq/reorder', 'FaqController@reorder');
    });



    Route::group(['middleware' => 'basic.auth'], function () {
        Route::get('admin', 'AdminController@index');
        Route::get('admin/{id}', 'AdminController@show');
        Route::post('admin', 'AdminController@store');
        Route::put('admin/{id}', 'AdminController@update');
        Route::delete('admin/{id}', 'AdminController@destroy');
    });

    

    Route::group(['middleware' => 'basic.auth'], function () {
        Route::get('userapp', 'UserAppController@index');
        Route::get('userapp/{id}', 'UserAppController@show');
        Route::post('userapp', 'UserAppController@store');
        Route::put('userapp/{id}', 'UserAppController@update');
        Route::delete('userapp/{id}', 'UserAppController@destroy');
    });

    Route::group(['middleware' => 'basic.auth.userapp'], function () {
        Route::get('profile', 'UserAppController@getProfile');
    });

    Route::get('images/{filename}', 'ImageController@show');

    $router->post('/login', 'UserController@login');
    $router->post('/login', 'AuthAppController@login');
    $router->post('/verify-pin', 'AuthAppController@verifyPin');
    $router->post('/register', 'AuthAppController@register');

    $router->get('/test-mail', function () {
        try {
            \Illuminate\Support\Facades\Mail::raw('This is a test email', function ($message) {
                $message->to('danishrabbani1806@gmail.com')
                        ->subject('Test Email');
            });
            return 'Mail sent successfully!';
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });
    

$router->get('/vehicles', 'VehicleController@getVehicles');
$router->get('/vehicles-only', 'VehicleController@getVehiclesOnly');
$router->get('/payment-details', 'PaymentController@getPaymentDetails');
$router->get('/payment-history', 'PaymentController@getPaymentHistory');
$router->get('/payment-detail-history', 'PaymentController@getPaymentDetailHistory');

$router->get('send_email' ,'Mailcontroller@mail');

$router->get('/send', 'EmailController@send');