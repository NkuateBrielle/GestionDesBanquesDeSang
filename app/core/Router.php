<?php
namespace App\core;
    class Router {
        protected $routes = [];
        protected $params = [];
        protected $basePath = '';

        public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }

        public function addRoute($method, $route, $action) {
            $this->routes[$method][$route] = $action;
            $this->basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        }

        public function get($route, $action) {
            $this->addRoute('GET', $route, $action);
        }

        public function post($route, $action) {
            $this->addRoute('POST', $route, $action);
        }

        public function dispatch() {
            $uri = $this->getCurrentUri();
            $method = $_SERVER['REQUEST_METHOD'];


            error_log("Tentative de routage pour URI: $uri, Méthode: $method");

            foreach ($this->routes[$method] as $route => $action) {
                // Convert route to regex
                $routeRegex = trim(preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z0-9-]+)', $route), '/');
                $routeRegex = "@^" . $routeRegex . "$@i";


                

                if (preg_match($routeRegex, $uri, $matches)) {
                    error_log("Route matchée: $route");
                     
                    // Extract named parameters
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    
                    // Call controller method
                    list($controller, $method) = explode('@', $action);
                    $controllerClass = "App\\controllers\\" . $controller;
                    // $this->getClassesFromDirectory(__DIR__ . '/../controllers', 'App\\controllers');
                    $controllerFile = __DIR__ . '/../controllers/' . $controller . '.php';

                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
                        if (class_exists($controllerClass)) {
                        $controllerInstance = new $controllerClass();
                        if (method_exists($controllerInstance, $method)) {
                            $controllerInstance->$method($params);
                            return;
                        }
                    }
                    }
                }
            }

            // 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
            error_log("404 - Aucune route ne correspond à: $uri");
        }

        protected function getCurrentUri() {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

            // Récupère le chemin jusqu'à /public
            $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

            if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
                $uri = substr($uri, strlen($basePath));
            }

            // Si le chemin commence par /public, on le retire aussi
            if (strpos($uri, '/public') === 0) {
                $uri = substr($uri, strlen('/public'));
            }

            return trim($uri, '/');
        }
        public function getBaseUrl() {
            return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
        }
        public function getRoutes() {
            return $this->routes;
        }

    }