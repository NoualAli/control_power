<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Files Config
    |--------------------------------------------------------------------------
    */
    'paths' => [
        // .env file directory
        'env' => base_path(),
        // backup files directory
        'backupDirectory' => storage_path('env-editor'),
    ],
    // .env file name
    'envFileName' => '.ec69008394c5046c2cd04dd83d0fa8f565bb53f6635f88409d566786708cbbed',

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    */
    'route' => [
        // Prefix url for route Group
        'prefix' => 'env-editor',
        // Routes base name
        'name' => 'env-editor',
        // Middleware(s) applied on route Group
        'middleware' => ['web', 'auth', 'is_root'],
    ],

    /* ------------------------------------------------------------------------------------------------
    |  Time Format for Views and parsed backups
    | ------------------------------------------------------------------------------------------------
    */
    'timeFormat' => 'd/m/Y H:i:s',

    /* ------------------------------------------------------------------------------------------------
     | Set Views options
     | ------------------------------------------------------------------------------------------------
     | Here you can set The "extends" blade of index.blade.php
    */
    'layout' => 'env-editor::layout',
];
