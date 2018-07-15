<?php
if (!function_exists('get_routes')) {

    /**
     * @return mixed
     */
    function get_routes(): array
    {
        global $routeCollections;
        return $routeCollections;
    }
}

if (!function_exists('resolve_routing')) {

    /**
     * @param array $map
     */
    function resolve_routing(array $map)
    {
        //solve for module loader
        $path = service_path($map['module'] . '/' . $map['action'] . '.php');
        $requestSegment = $map['module'] . '/' . $map['action'];

        //check does current route request segment are refined inside routes registration.
        if (!array_key_exists($requestSegment, get_routes())) {
            return abort("route for {$requestSegment} not found.", 404);
        }

        if (!file_exists($path)) {
            return abort();
        }

        require_once $path;
    }
}

if (!function_exists('load_module')) {

    /**
     * @param $path
     */
    function load_module($path)
    {

    }
}

if (!function_exists('load_middleware')) {

    /**
     * @param $path
     */
    function load_middleware($alias)
    {
        return function_exists($alias) ? call_user_func($alias) : false;
    }
}

if (!function_exists('app_path')) {

    /**
     * @param $path
     */
    function app_path($path = null)
    {
        return is_null($path) ? APP_PATH : APP_PATH . '/' . $path;
    }
}

if (!function_exists('config_path')) {

    /**
     * @param $path
     */
    function config_path($path = null)
    {
        return is_null($path) ? CONFIG_PATH : CONFIG_PATH . '/' . $path;
    }
}

if (!function_exists('lib_path')) {

    /**
     * @param $path
     */
    function lib_path($path = null)
    {
        return is_null($path) ? LIB_PATH : LIB_PATH . '/' . $path;
    }
}

if (!function_exists('service_path')) {

    /**
     * @param $path
     */
    function service_path($path = null)
    {
        return is_null($path) ? SERVICE_PATH : SERVICE_PATH . '/' . $path;
    }
}

if (!function_exists('logging_path')) {

    /**
     * @param $path
     */
    function logging_path($path = null)
    {
        return is_null($path) ? LOGGING_PATH : LOGGING_PATH . '/' . $path;
    }
}

if (!function_exists('abort')) {

    /**
     * @param $view
     * @param null    $code
     */
    function abort($view = null, $code = 404)
    {
        return include_once service_path('errors/abort.php');
    }
}

if (!function_exists('environment')) {

    /**
     * @param $view
     * @param null    $code
     */
    function environment()
    {
        return ENV ? ENV : 'local';
    }
}

if (!function_exists('today')) {

    /**
     * @param $view
     * @param null    $code
     */
    function today()
    {
        return date('Y-m-d');
    }
}
