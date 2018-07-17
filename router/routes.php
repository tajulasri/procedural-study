<?php

//register all routes
return [

    'users/view'  => [
        'service'    => 'users',
        'action'     => 'view',
        'method'     => 'get',
        'alias'      => 'login_view',
        'middleware' => 'need_login',
    ],

    'users/login' => [
        'service' => 'users',
        'action'  => 'login',
        'method'  => 'get',
        'alias'   => 'login_view',
    ],
];
