<?php

require_once __DIR__ . '/bootstrap.php';

var_dump($config['database']['default_driver']);

echo app_path('kambing');

resolveDatabaseDriver($config['database']['default_driver']);

if (!isset($_REQUEST['module']) && !isset($_REQUEST['action'])) {

	die("return to index page");
} else {

	//start resolve and dispatching routing
	echo resolveRouting(['module' => $_REQUEST['module'], 'action' => $_REQUEST['action']]);
}