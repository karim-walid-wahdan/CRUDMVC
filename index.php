<?php
require __DIR__ . '/vendor/autoload.php';

$router = new App\Routes\Router();
// session_start();
// session_unset();
// session_destroy();
//Define your routes
$router->addRoute('GET', '/', 'Login@index');
$router->addRoute('GET', '/login', 'Login@index');
$router->addRoute('POST', '/login', 'Login@login');

// Dispatch the request to the appropriate controller and method
$router->dispatch();