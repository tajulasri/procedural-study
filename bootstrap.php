<?php
declare (strict_types = 1);

require_once 'vendor/autoload.php';

require_once 'libs/application.php';
require_once 'libs/driver_resolver.php';
$config = require_once 'config/app_config.php';
$routeCollections = require_once 'router/routes.php';

//define
if (!defined('APP_PATH')) {

	define('APP_PATH', __DIR__);
}
