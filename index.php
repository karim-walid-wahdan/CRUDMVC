<?php
require __DIR__ . '/vendor/autoload.php';

$router = new App\Routes\Router();
// session_start();
// session_unset();
// session_destroy();
//Define your routes
$router->addRoute('GET', '/', 'Login@index');
$router->addRoute('GET', '/Login', 'Login@index');
$router->addRoute('POST', '/Login', 'Login@login');
$router->addRoute('GET', '/SignUp', 'SignUp@index');
$router->addRoute('POST', '/SignUp', 'SignUp@signUp');
$router->addRoute('GET', '/Home', 'Home@index');
$router->addRoute('POST', '/Home', 'Home@handleHome');

// Dispatch the request to the appropriate controller and method
$router->dispatch();