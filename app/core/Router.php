<?php
/**
 * Application Router Class
 * Handles request matching and dispatching
 */

class Router {
    private array $routes = [];

    public function add(string $method, string $pattern, array $handler): void {
        $key = strtoupper($method) . ' ' . $pattern;
        $this->routes[$key] = $handler;
    }

    public function get(string $pattern, array $handler): void {
        $this->add('GET', $pattern, $handler);
    }

    public function post(string $pattern, array $handler): void {
        $this->add('POST', $pattern, $handler);
    }

    public function dispatch(string $requestUri, string $requestMethod): void {
        foreach ($this->routes as $route => $handler) {
            list($method, $pattern) = explode(' ', $route, 2);

            if ($requestMethod !== $method) {
                continue;
            }

            // Convert route pattern to regex
            $regex = str_replace(['[:slug]', '[:id]'], ['([^/]+)', '([0-9]+)'], $pattern);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $requestUri, $matches)) {
                array_shift($matches);
                list($controllerName, $action) = $handler;

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        call_user_func_array([$controller, $action], $matches);
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        if (strpos($requestUri, '/admin') === 0) {
            include __DIR__ . '/../views/admin/errors/404.php';
        } else {
            include __DIR__ . '/../views/customer/errors/404.php';
        }
    }
}
