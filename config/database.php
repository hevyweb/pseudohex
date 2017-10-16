<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', MYSQL_HOST),
            'port' => env('DB_PORT', MYSQL_PORT),
            'database' => env('DB_DATABASE', MYSQL_DB),
            'username' => env('DB_USERNAME', MYSQL_USER),
            'password' => env('DB_PASSWORD', MYSQL_PASSWORD),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]
    ]
];
