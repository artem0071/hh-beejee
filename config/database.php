<?php

return [

    'default' => constant('DB_CONNECTION'),

    'connections' => [

        'mysql' => [
            'host' => constant('DB_HOST'),
            'port' => constant('DB_PORT'),
            'database' => constant('DB_DATABASE'),
            'username' => constant('DB_USERNAME'),
            'password' => constant('DB_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ]
];