<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],
    // 'allowed_origins' => ['http://localhost'],
    //'allowed_origins' => ['http://localhost:3000', 'http://localhost:8080'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    //Default
    'supports_credentials' => true,
    // A cors támogatja a hitelesítő adatokat a sütiben, egyébként letiltja
    //ilyen esetben nem engedi a 'allowed_origins' => ['*']-ot
    //fejlesztői környezetben: 'allowed_origins' => ['*'],
    //'allowed_origins' => ['http://localhost:*'] beállítás kell
    // 'supports_credentials' => true,
    


];
