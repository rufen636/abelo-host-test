<?php

namespace Framework\Route;

class Route
{
    static $routes = [];

    public static function get($path, $handler)
    {
        self::$routes[] = ['path'
        => $path, 'method' => 'GET', 'handler' => $handler];
    }

    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                echo call_user_func($route['handler']);
            }
        }

    }

}
