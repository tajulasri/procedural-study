<?php

if (!function_exists('get_routes')) {

    /**
     * @return mixed
     */
    function get_stack_traces(): array
    {
        global $stack_traces;
        return $stack_traces;
    }

    /**
     * @return mixed
     */
    function get_routes(): array
    {
        global $routeCollections;
        return $routeCollections;
    }
}

if (!function_exists('get_db_connection')) {

    /**
     * @return mixed
     */
    function get_db_connection()
    {
        //somehow this pattern and solution might have other pro and cons.
        global $database_connection;
        return $database_connection;
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

        $stack_traces = get_stack_traces();

        //trim url routes
        $request_url = $request_path;
        //delegate and initiate from base stack request for middleware use.
        $request_stacks = request_stacks($_SERVER, $_REQUEST);

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

            error_reporting(0);
        }

        $request_route = isset(get_routes()[$request_url]) ? get_routes()[$request_url] : [];
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
            if ($request_route['middleware'] instanceof Closure) {
                //we are not stop and return current request from middleware.
                //we keep proceed and forward our request to next cycle.
                $request_route['middleware']($request_stacks);
            } elseif (is_string($request_route['middleware'])) {

                if (!function_exists($request_route['middleware'])) {
                    //dump to stack traces error
                    $stack_traces[] = [
                        'message'         => 'Middleware function are not found!.',
                        'line'            => __LINE__,
                        'file'            => __FILE__,
                        'invoke_function' => __FUNCTION__,
                    ];
                } else {

                    //forward request to middleware
                    call_user_func_array($request_route['middleware'], [$request_stacks]);
                }
            }
        }

        //build path for load ready services if available and exists
        $path = service_path($request_route['service'].'/'.$request_route['action'].'.php');

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
                error(implode(PHP_EOL, $trace));
                echo json_encode($trace)."<br />";
            }
            exit;
        }

        //render view xontext
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
        return is_null($path) ? APP_PATH : APP_PATH.'/'.$path;
    }
}

if (!function_exists('config_path')) {

    /**
     * @param $path
     */
    function config_path($path = null)
    {
        return is_null($path) ? CONFIG_PATH : CONFIG_PATH.'/'.$path;
    }
}

if (!function_exists('lib_path')) {

    /**
     * @param $path
     */
    function lib_path($path = null)
    {
        return is_null($path) ? LIB_PATH : LIB_PATH.'/'.$path;
    }
}

if (!function_exists('service_path')) {

    /**
     * @param $path
     */
    function service_path($path = null)
    {
        return is_null($path) ? SERVICE_PATH : SERVICE_PATH.'/'.$path;
    }
}

if (!function_exists('logging_path')) {

    /**
     * @param $path
     */
    function logging_path($path = null)
    {
        return is_null($path) ? LOGGING_PATH : LOGGING_PATH.'/'.$path;
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

if (!function_exists('request_stacks')) {

    /**
     * @param $view
     * @param null    $code
     */
    function request_stacks()
    {
        return [
            '_server' => func_get_arg(0),
            '_data'   => func_get_arg(1),
        ];
    }
}
