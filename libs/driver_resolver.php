<?php

//database function
function createPdoDriver() {
	echo "connection database using pdo.";
}

function createMysqliDriver() {

}

function resolveDatabaseDriver($driver = null) {
	call_user_func('create' . ucfirst($driver) . 'Driver');
}
