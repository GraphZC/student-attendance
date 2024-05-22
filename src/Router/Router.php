<?php
namespace Src\Routers;

use Src\Http\HttpRequest;

class Router {
    private $routes = [];

    private function addRoute($route, $controller, $action, $method) {
        // Convert route to a regular expression to handle parameters
        $routePattern = preg_replace('/\{([\w]+)\}/', '(?P<\1>[^\/]+)', $route);
        $routePattern = '#^' . $routePattern . '$#';

        $this->routes[$method][$routePattern] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function put($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "PUT");
    }

    public function delete($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "DELETE");
    }

    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $route = explode('?', $uri)[0];

        // Find the query
        $query_regex = "/\?(.+)$/";
        preg_match($query_regex, $uri, $query_matches);
        $query_string = $query_matches[1] ?? null;

        // Parse query string into an associative array
        $query_array = [];
        if ($query_string !== null) {
            parse_str($query_string, $query_array);
        }

        foreach ($this->routes[$method] ?? [] as $pattern => $info) {
            if (preg_match($pattern, $route, $matches)) {
                // Filter out full pattern matches and capture only named groups
                $params = array_filter($matches, function($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);


                $controllerInstance = $info['controller'];
                $action = $info['action'];

                $body = json_decode(file_get_contents('php://input'), true);

                $request = new HttpRequest(
                    $route,
                    $method,
                    $query_array,
                    $params,
                    $body,
                );

                return $controllerInstance->$action($request);
            }
        }

        // If no route is found, return a 404 response
        header("HTTP/1.0 404 Not Found");
        echo json_encode([
            'error' => 'Not found'
        ]);
    }
}
