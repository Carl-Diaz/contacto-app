<?php
namespace App;

class Router {
    private array $routes = [];

    public function get(string $path, string $controller, string $method) {
        $this->routes['GET'][$path] = [$controller, $method];
    }

    public function post(string $path, string $controller, string $method) {
        $this->routes['POST'][$path] = [$controller, $method];
    }

    public function run() {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = str_replace('/contacto-app/public', '', $uri);

    foreach ($this->routes[$method] as $route => $handler) {
        // Convertir ruta con {id} a patrón regex
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $route);
        $pattern = "#^" . $pattern . "$#";
        
        if (preg_match($pattern, $uri, $matches)) {
            [$controller, $action] = $handler;
            $controllerInstance = new $controller();
            
            // Pasar parámetros (como el id)
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            $controllerInstance->$action(...array_values($params));
            return;
        }
    }

    http_response_code(404);
    echo "404 - Página no encontrada";
}
}
