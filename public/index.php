<?php

/**
 *  This is procedural PHP framework just for my assignment studies.
 */
require_once '../bootstrap.php';

//suggestion router index.php?url=module/action
//temporary function
function abort_404()
{
    echo "404";
}

$request_url = preg_replace('/\s+/', '', $_SERVER['REQUEST_URI']);

//start routing handler
resolve_routing([
    'path'   => $request_url,
    'method' => $_SERVER['REQUEST_METHOD'],
]);
