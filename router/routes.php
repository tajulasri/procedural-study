<?php

//register all routes
return [

    'users/view'  => [
        'module' => 'users',
        'action' => 'view',
        'method' => 'get',
        'alias'  => 'login_view',
    ],

    'users/login' => [
        'module' => 'users',
        'action' => 'login',
        'method' => 'get',
        'alias'  => 'login_view',
    ],
];
