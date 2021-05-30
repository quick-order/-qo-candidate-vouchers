<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Versions
    |--------------------------------------------------------------------------
    |
    | Remember to define new api versions below in descending order so the fallback works as expected.
    | Example: 'versions' => ['v3', 'v2', 'v1.1', 'v1']
    |
    */
    'header' => env('API_TOKEN_HEADER', 'X-QUICK-ORDER-API-TOKEN'),
    'token' => env('API_TOKEN'),

    'versions' => [
        'v1.1',
        'v1',
    ],

    'default_version' => 'v1',

    'prefix' => '/api/',
];
