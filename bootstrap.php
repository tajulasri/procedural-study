<?php
declare (strict_types = 1);
session_start();

//register all dependencies
require_once 'vendor/autoload.php';
require_once 'libs/application.php';
require_once 'libs/driver_resolver.php';
require_once 'libs/logging.php';
//require_once 'libs/mysqli_repository.php';

$config = require_once 'config/app_config.php';
$routeCollections = require_once 'router/routes.php';

$stack_traces = [];

//define all constant
const DS = DIRECTORY_SEPARATOR;
const APP_PATH = __DIR__;
const LIB_PATH = APP_PATH . DS . 'libs';
const CONFIG_PATH = APP_PATH . DS . 'config';
const ROUTE_PATH = APP_PATH . DS . 'router';
const SERVICE_PATH = APP_PATH . DS . 'services';
const LOGGING_PATH = APP_PATH . DS . 'logs/';
const BIN_PATH = APP_PATH . DS . 'bin';

//check environment
const ENV = 'local';

//boot and start database driver
$database_connection = database_driver_resolver($config['database']['default_driver'], $config['database']['mysqli']);
$repository = database_repository_resolver($config['database']['default_driver']);

//maybe move to bootstrapping procedure
create_file_log(environment());
info("testing logger");
