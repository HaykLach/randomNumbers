<?php declare(strict_types=1);

namespace RandomNumbers\Router;

use Closure;
use RandomNumbers\Controllers\BaseController;

class Router
{
    private static array $routes = [
        'retrieve' => [
            'class' => 'RandomNumbers\Controllers\RandomNumberGenerator',
            'method' => 'getNumberById',
            'requiresParameter' => true
        ],
        'generate' => [
            'class' => 'RandomNumbers\Controllers\RandomNumberGenerator',
            'method' => 'generateNumber',
            'requiresParameter' => false
        ]
    ];

    public static function run(): string|BaseController
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = rtrim($uri, '/');
        $uri = explode('/', $uri);

        $route = $uri[1] ?? '404';
        $id = $uri[2] ?? null;
        if (!isset(self::$routes[$route])) {
            http_response_code(404);
            echo "404";
            die;
        }

        $class = self::$routes[$route]['class'];
        $method = self::$routes[$route]['method'];

        if (self::$routes[$route]['requiresParameter']) {
            if (!$id) {
                http_response_code(404);
                echo "404";
                die;
            }

            return (new $class)->$method($id);
        }
        return (new $class)->$method();
    }
}