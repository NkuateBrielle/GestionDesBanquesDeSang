<?php
class Router {
    private $routes = [];
    private $currentRoute = [];
    
    public function get($path, $handler, $middleware = []) {
        $this->addRoute('GET', $path, $handler, $middleware);
    }
    
    public function post($path, $handler, $middleware = []) {
        $this->addRoute('POST', $path, $handler, $middleware);
    }
    
    private function addRoute($method, $path, $handler, $middleware) {
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $projectName = 'GestionDesBanquesDeSang';
        if (strpos($requestUri, $projectName) === 0) {
            $requestUri = substr($requestUri, strlen($projectName));
            $requestUri = trim($requestUri, '/');
        }
        
        // Trouver la route correspondante
        $matchedRoute = null;
        
        if (isset($this->routes[$requestMethod])) {
            foreach ($this->routes[$requestMethod] as $path => $route) {
                $pattern = $this->buildPattern($path);

                if (preg_match($pattern, $requestUri, $matches)) {
                    $matchedRoute = $route;
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    break;
                }
            }
        }
        
        if ($matchedRoute) {
            $this->currentRoute = $matchedRoute;
            
            // Appliquer les middlewares
            foreach ($matchedRoute['middleware'] as $middleware) {
                $this->applyMiddleware($middleware);
            }
            
            // Appeler le handler
            list($controller, $method) = explode('@', $matchedRoute['handler']);
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], $params ?? []);
        } else {
            // Route non trouvée - 404
            header("HTTP/1.0 404 Not Found");
            View::render('errors/404');
            exit;
        }
    }
    
    private function buildPattern($path) {
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $path);
        return '@^' . $pattern . '$@i';
    }
    
    private function applyMiddleware($name) {
        switch ($name) {
            case 'auth':
                AuthHelper::checkAuth();
                break;
            case 'donor':
                AuthHelper::checkRole('donor');
                break;
            case 'hospital':
                AuthHelper::checkRole('hospital');
                break;
            case 'admin':
                AuthHelper::checkRole('admin');
                break;
        }
    }
}