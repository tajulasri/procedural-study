<?php

function get_log_formatname(): string
{
    return environment();
}

function get_log_extension(): string
{
    return ".log";
}

/**
 * @param $type
 * @param $date
 * @param $message
 */
function get_format($type, $date, $message)
{
    return sprintf("[%s][%s:%s] - %s" . PHP_EOL, strtoupper(environment()), strtoupper($type), $date, $message);
}
/**
 * @param $name
 */
function create_file_log($name = null)
{
    if (!file_exists(logging_path($name . get_log_extension()))) {
        @touch(logging_path($name) . get_log_extension());
    }
}

/**
 * @param $message
 */
function info($message = null)
{
    $log_message = get_format("info", today(), $message);
    return file_put_contents(logging_path(get_log_formatname() . get_log_extension()), $log_message, FILE_APPEND);
}

/**
 * @param $message
 */
function debug($message = null)
{
    $log_message = get_format("debug", today(), $message);
    return file_put_contents(logging_path(get_log_formatname() . get_log_extension()), $log_message, FILE_APPEND);
}

/**
 * @param $message
 */
function error($message = null)
{
    $log_message = get_format("error", today(), $message);
    return file_put_contents(logging_path(get_log_formatname() . get_log_extension()), $log_message, FILE_APPEND);
}

/**
 * @param $message
 */
function warning($message = null)
{
    $log_message = get_format("warning", today(), $message);
    return file_put_contents(logging_path(get_log_formatname() . get_log_extension()), $log_message, FILE_APPEND);
}
