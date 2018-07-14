<?php

if (!function_exists('resolveRouting')) {

	function resolveRouting(array $map): string {

		return http_build_query($map);
	}
}

if (!function_exists('app_path')) {

	function app_path($path = null) {

		return is_null($path) ? APP_PATH : APP_PATH . '/' . $path;
	}
}