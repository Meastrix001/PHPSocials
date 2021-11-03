<?php

require 'app.php';

$route = explode('/', strtolower($_SERVER['REQUEST_URI']));
//remove first empty element;
array_shift($route);
$controller = 'Home';
$method = 'index';
$params = [];

if(isset($route[0]) && $route[0] != '') {
    $controller = ucfirst(array_shift($route));

    if(isset($route[0])) {
        $method = array_shift($route);  
    }

    $params = $route;
} 

$controller_path =  BASE_DIR . '/controllers/' . $controller . '.php';
if(!file_exists($controller_path)) {
    echo 'TODO: 404 inladen';
    exit;
} 

// ob_start();

if(isset($_COOKIE['email'])) {
    $loggedIn_user = getUserCookie();
}

require_once $controller_path;

$controller_name = $controller . 'Controller';
$controller = new $controller_name();
$controller->{$method}($params);

// $content = ob_get_contents();
// ob_end_clean();


