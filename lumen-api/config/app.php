<?php

return [

    'name' => env('APP_NAME', 'Lumen Application'),

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost'),

    'timezone' => 'UTC',

    'locale' => 'en',

    'key' => env('APP_KEY', ''),

    'providers' => [
        Illuminate\Mail\MailServiceProvider::class,
    ],

    'aliases' => [
        'Mail' => Illuminate\Support\Facades\Mail::class,
    ],

];
