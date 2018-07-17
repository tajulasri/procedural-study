<?php

return [
    'database'    => [

        'default_driver' => 'mysqli',
        'pdo'            => [
            'host'          => '127.0.0.1',
            'port'          => '3306',
            'database_name' => 'test',
            'username'      => 'root',
            'password'      => 'password',
            'prefix'        => '',
            'charset'       => '',
            'fetch_mode'    => PDO::FETCH_ASSOC,
        ],

        'mysqli'         => [
            'host'          => '127.0.0.1',
            'port'          => '3306',
            'database_name' => 'test',
            'username'      => 'root',
            'password'      => 'password',
            'prefix'        => '',
            'charset'       => '',
        ],
    ],
    'session'     => [
        'path' => 'logs/sessions',
    ],
    'middlewares' => [
        //alias => 'function_string'
        'auth' => 'need_login',
    ],
];
