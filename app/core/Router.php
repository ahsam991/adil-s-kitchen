<?php
/**
 * Application Router Class
 * Handles request matching and dispatching
 * Compatible with PHP 7.4+
 */

class Router {
    private $routes = [];

    public function add(string $method, string $pattern, array $handler): void {
        $this->routes[strtoupper($method) . ' ' . $pattern] = $handler;
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

            // Convert placeholders to regex groups
            $regex = str_replace(
                ['[:slug]', '[:id]'],
                ['([a-z0-9_-]+)', '([0-9]+)'],
                $pattern
            );
            $regex = '#^' . $regex . '$#i';

            if (!preg_match($regex, $requestUri, $matches)) {
                continue;
            }

            array_shift($matches); // Remove full match

            list($controllerName, $action) = $handler;

            // Resolve admin namespaced controllers (Admin\FooController → Admin/FooController.php)
            $classToLoad = str_replace('Admin\\', '', $controllerName);
            if (!class_exists($controllerName) && !class_exists($classToLoad)) {
                // Autoloader should have been triggered already; if not, show 404
                $this->notFound($requestUri);
                return;
            }

            // Instantiate correct class
            $instanceClass = class_exists($controllerName) ? $controllerName : $classToLoad;
            $controller    = new $instanceClass();

            if (!method_exists($controller, $action)) {
                $this->notFound($requestUri);
                return;
            }

            call_user_func_array([$controller, $action], $matches);
            return;
        }

        $this->notFound($requestUri);
    }

    private function notFound(string $uri): void {
        http_response_code(404);
        $viewPath = APP_PATH . '/views/' .
            (strpos($uri, '/admin') === 0 ? 'admin' : 'customer') .
            '/errors/404.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo '<h1>404 — Page Not Found</h1><p><a href="/">Return to Home</a></p>';
        }
    }
}
