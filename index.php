<?php

/**
 *  This is procedural PHP framework just for my assignment studies.
 */
require_once __DIR__ . '/bootstrap.php';

//suggestion router index.php?url=module/action

if (!isset($_REQUEST['url'])) {
    die("not valid router");
}

//temporary function
function abort_404()
{
    echo "404";
}

$url_segments = explode('/', $_REQUEST['url']);
return count($url_segments) != 2 ? abort_404() : resolve_routing(['module' => $url_segments[0], 'action' => $url_segments[1]]);
