<?php

return [
    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SECRET', ''),
        'settings' => [
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'http.ConnectionTimeOut' => 1000,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
        ],
    ],
    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'secret' => env('PAYPAL_LIVE_SECRET', ''),
        'settings' => [
            'mode' => env('PAYPAL_MODE', 'live'),
            'http.ConnectionTimeOut' => 1000,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
        ],
    ],
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ],
];
