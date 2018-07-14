<?php

return [
    'database' => [

        'default_driver' => 'mysqli',
        'pdo'            => [
            'host'          => '127.0.0.1',
            'port'          => '3306',
            'database_name' => 'test',
            'username'      => 'test',
            'password'      => 'password',
            'prefix'        => '',
            'charset'       => '',
            'fetch_mode'    => PDO::FETCH_ASSOC,
        ],

        'mysqli'         => [
            'host'          => '127.0.0.1',
            'port'          => '3306',
            'database_name' => 'test',
            'username'      => 'test',
            'password'      => 'password',
            'prefix'        => '',
            'charset'       => '',
        ],
    ],
    'session'  => [

    ],
];
