<?php

require_once __DIR__ . '/../controller/controller.php';


class Router {
    private $routes = [];
    
    public function addRoute($path, $controller, $action = 'index') {
        $this->routes[$path] = [
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        
        $uri = strtok($uri, '?');
        
        $basePath = '/milk_tea';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
            $uri = ltrim($uri, '/');
        }
        
        $uri = trim($uri, '/');
        
        if (empty($uri)) {
            $uri = '';
        }
        
        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];
            $controllerName = $route['controller'];
            $action = $route['action'];
            
            $controllerFile = __DIR__ . '/../controller/' . str_replace('\\', '/', $controllerName) . '.php';
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                
                $fullControllerName = '\\' . $controllerName;
                
                $controller = new $fullControllerName();
                
                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    die("Không tìm thấy action '{$action}' trong controller '{$controllerName}'.");
                }
            } else {
                die("Không tìm thấy file controller: {$controllerFile}.");
            }
        } else {
            http_response_code(404);
            die(
                "Không tìm thấy trang yêu cầu. URI: '{$uri}'. " .
                "Các route hiện có: " . implode(', ', array_keys($this->routes))
            );
        }
    }
}