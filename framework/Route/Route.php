<?php

namespace Framework\Route;

class Route
{
    static $routes = [];

    public static function get($path, $handler)
    {
        self::$routes[] = [
            'path' => $path,
            'method' => 'GET',
            'handler' => $handler,
        ];
    }

    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = self::buildPattern($route['path']);
            $params = [];

            if (preg_match($pattern, $uri, $params)) {
                $callback = $route['handler'];

                if (is_array($callback)) {
                    $reflection = new \ReflectionMethod($callback[0], $callback[1]);
                } else {
                    $reflection = new \ReflectionFunction($callback);
                }

                $args = [];
                foreach ($reflection->getParameters() as $param) {
                    $name = $param->getName();
                    if (isset($params[$name])) {
                        $args[] = $params[$name];
                    } elseif ($param->isDefaultValueAvailable()) {
                        $args[] = $param->getDefaultValue();
                    } else {
                        $args[] = null;
                    }
                }

                echo call_user_func_array($callback, $args);
            }
        }
    }

    private static function buildPattern(string $path): string
    {
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^\/]+)', $path);
        return '#^' . $pattern . '$#u';
    }
}