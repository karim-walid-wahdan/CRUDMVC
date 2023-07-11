<?php
namespace App\Routes;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $controllerAction)
    {
        $this->routes[$method][$path] = $controllerAction;
    }
    public function dispatch()
    {
        session_start(); // Start the session
        //Check if the session exists or if the user is not logged in
        $method = $_SERVER['REQUEST_METHOD'];
        $path = str_replace('/intCoreMVC', '', parse_url($_SERVER['REQUEST_URI'])['path']);
        //Check if the route exists
        if (isset($this->routes[$method][$path])) {
            $controllerAction = $this->routes[$method][$path];

            // Extract the controller and method
            list($controllerName, $methodName) = explode('@', $controllerAction);
            //Use the controller file
            $className = "App\Controller\\" . $controllerName;
            // Create an instance of the controller
            $controller = new $className();
            // Call the controller method
            $controller->$methodName();
        } else {
            // Handle 404 - Route not found
            echo '404 - Page not found';
        }
    }
}
?>