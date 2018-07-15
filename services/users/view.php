<?php

header('content-type: application/json');

info(json_encode($_SERVER));
echo json_encode(['_message' => 'request from called services']);
