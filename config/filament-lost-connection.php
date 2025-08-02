<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Ping URL
    |--------------------------------------------------------------------------
    |
    | The URL to ping for checking internet connectivity.
    | By default, it will use the current domain's favicon.
    | You can set a custom URL here if needed.
    |
    */
    'ping_url' => env('FILAMENT_LOST_CONNECTION_PING_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Check Interval
    |--------------------------------------------------------------------------
    |
    | The interval (in milliseconds) to check for internet connectivity.
    | Default is 3000ms (3 seconds).
    |
    */
    'check_interval' => env('FILAMENT_LOST_CONNECTION_CHECK_INTERVAL', 3000),

    /*
    |--------------------------------------------------------------------------
    | Position
    |--------------------------------------------------------------------------
    |
    | The position where the connection indicator should appear.
    | Options: 'top' or 'bottom'
    |
    */
    'position' => env('FILAMENT_LOST_CONNECTION_POSITION', 'bottom'),

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    |
    | Customize the messages shown when connection is lost or restored.
    |
    */
    'messages' => [
        'lost_connection' => env('FILAMENT_LOST_CONNECTION_MESSAGE', 'You are disconnected.'),
        'connected' => env('FILAMENT_CONNECTED_MESSAGE', 'You are back online.'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Colors
    |--------------------------------------------------------------------------
    |
    | Customize the background colors for different connection states.
    |
    */
    'colors' => [
        'lost_connection' => env('FILAMENT_LOST_CONNECTION_COLOR', '#991b1b'),
        'connected' => env('FILAMENT_CONNECTED_COLOR', '#065f46'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    |
    | The icon to display in the connection indicator.
    | You can use any Heroicon or custom icon component.
    |
    */
    'icon' => env('FILAMENT_LOST_CONNECTION_ICON', 'heroicon-o-exclamation-triangle'),
];
