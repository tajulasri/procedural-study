<?php

/**
 * @param array $config
 * @return mixed
 */
function create_pdo_driver($config = [])
{
    try {
        return new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s',
                $config['host'],
                $config['database_name']),

            $config['username'], $config['password']
        );

    } catch (PDOException $e) {

        return $e->getMessage();
    }
}

/**
 * @param array $config
 * @return mixed
 */
function create_mysqli_driver($config = [])
{
    $connection = mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database_name']);

    return $connection;
}

/**
 * @param $name
 * @param array   $data
 */
function create_user_session($name, $data = [])
{
    if (!isset($_SESSION[$name])) {
        $_SESSION[$name] = $data;
        return true;
    }

    return false;
}

/**
 * @param $driver
 * @param array     $config
 */
function database_driver_resolver($driver = null, $config = [])
{
    return call_user_func('create_' . strtolower($driver) . '_driver', $config);
}
