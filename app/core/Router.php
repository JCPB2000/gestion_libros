<?php
class Router {
    private $routes = [];

    public function add($route, $controller, $method, $httpMethod = "GET") {
        $this->routes[$httpMethod][$route] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($url) {
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$httpMethod][$url])) {
            $controllerName = $this->routes[$httpMethod][$url]['controller'];
            $method = $this->routes[$httpMethod][$url]['method'];

            require_once __DIR__ . "/../controllers/" . $controllerName . ".php";
            $controller = new $controllerName();
            $controller->$method();
        } else {
            http_response_code(404);
            echo "<h1>404 - Página no encontrada</h1>";
        }
    }
}
?>
