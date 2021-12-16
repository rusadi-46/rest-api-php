<?php

include_once __DIR__ ."../config/env.php";
include_once __DIR__ ."/controllers/PaymentController.php";

$app_url = APP_URL;

// get URL PATH
$current_url = explode("?", $_SERVER['REQUEST_URI']);
$request = $current_url[0];
print_r($request);
$controller = new PaymentController();

if ($request == '/api/create') {
    return $controller->create();
} elseif ($request == '/api/show') {
    return $controller->show();
} else {
  http_response_code(404);
  echo "404";
}