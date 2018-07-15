<?php

// /header('content-type: application/json');

$users = get_users();

var_dump($users);
info(json_encode($_SERVER));
echo json_encode(['_message' => 'request from called services', 'query string accessible from router engine context' => $request_query]);
