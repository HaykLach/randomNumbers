<?php declare(strict_types=1);

namespace RandomNumbers\Dispatcher;

use RandomNumbers\Controllers\BaseController;
use RandomNumbers\Router\Router;

class Dispatcher
{
    public static function dispatch(): string|BaseController
    {
        return Router::run();
    }
}