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
        $request_path = preg_replace('/^\//', '', $map['path']);

        $http_method = strtolower($map['method']);
        $request_query = [];

        //trim url routes
        $request_url = $request_path;

        if (strpos($request_path, '?')) {
            //if query string are present
            $seperate_string = explode("?", $request_path);
            $querystring = parse_str($seperate_string[1], $query);
            $request_query = $query;
            $request_url = substr($request_path, 0, strpos($request_path, '?'));
        }

        //check does route are exists
        if (!array_key_exists($request_url, get_routes())) {

            $stack_traces[] = [
                'message'         => "Route with {$request_url} not found.",
                'line'            => __LINE__,
                'file'            => __FILE__,
                'invoke_function' => __FUNCTION__,
            ];
        }

        $request_route = get_routes()[$request_url];
        //check request method does match current defined inside our routes registar.

        if ($http_method !== $request_route['method']) {
            $stack_traces[] = [
                'message'         => "Route with {$request_url} method not allowed.",
                'line'            => __LINE__,
                'file'            => __FILE__,
                'invoke_function' => __FUNCTION__,
            ];
        }

        //check does current registered requested route does has any middleware?

        if (isset($request_route['middleware'])) {
            //forward request to middleware
        }

        //build path for load ready services if available and exists
        $path = service_path($request_route['service'] . '/' . $request_route['action'] . '.php');

        //add one more additional layer to separate logic from our action

        //render action
        if (!file_exists($path)) {
            $stack_traces[] = [
                'message'         => 'Service / view action are not found',
                'line'            => __LINE__,
                'file'            => __FILE__,
                'invoke_function' => __FUNCTION__,
            ];
        }

        //exit request cycle if any stack trace are counted.
        if (count($stack_traces)) {

            foreach (array_reverse($stack_traces) as $trace) {
                echo json_encode($trace) . "<br />";
            }

            exit;
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
