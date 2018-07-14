<?php
declare (strict_types = 1);

require_once 'vendor/autoload.php';

require_once 'libs/application.php';
require_once 'libs/driver_resolver.php';
$config = require_once 'config/app_config.php';
$routeCollections = require_once 'router/routes.php';

session_start();

//define all constant
const DS = DIRECTORY_SEPARATOR;
const APP_PATH = __DIR__;
const LIB_PATH = APP_PATH . DS . 'libs';
const CONFIG_PATH = APP_PATH . DS . 'config';
const ROUTE_PATH = APP_PATH . DS . 'router';
const SERVICE_PATH = APP_PATH . DS . 'services';
const BIN_PATH = APP_PATH . DS . 'bin';

//boot and start database driver
$db = database_driver_resolver($config['database']['default_driver'], $config['database']['mysqli']);
