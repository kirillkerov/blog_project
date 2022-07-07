<?php

namespace App;

use App\Exception\NotFoundException;

class Router
{
    private array $routes = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function get(string $path, array $callback)
    {
        $this->addRoute('get', $path, $callback);
    }
    
    public function post(string $path, array $callback)
    {
        $this->addRoute('post', $path, $callback);
    }
    
    private function addRoute(string $method, string $path, array $callback)
    {
        $this->routes[] = new Route($method, $path, $callback);
    }

    public function dispatch(string $url, string $method)
    {
        $uri = trim(strtok($url, '?'), '/');
        $method = strtolower($method);

        foreach ($this->routes as $route) {
            if ($route->match($uri, $method)) {
                return $route->run($uri);
            }
        }

        throw new NotFoundException();
    }
}
