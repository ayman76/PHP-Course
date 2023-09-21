<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;
use Exception;

class Router
{
    protected $routes = [];

    public function add($uri, $controller, $method): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'GET');

    }

    public function post($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'POST');


    }

    public function delete($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'DELETE');

    }

    public function patch($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'PATCH');

    }

    public function only($key): Router
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($uri === $route['uri'] && strtoupper($method) === $route['method']) {

                Middleware::resolve($route['middleware']);

                return require base_path("HTTP/controllers/" . $route['controller']);
            }
        }

        //abort
        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/$code.php");

        die();
    }


}


